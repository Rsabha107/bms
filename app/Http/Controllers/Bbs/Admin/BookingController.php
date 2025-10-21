<?php

namespace App\Http\Controllers\Bbs\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bbs\BroadcastBooking;
use App\Models\Bbs\BroadcastService;
use App\Models\Bbs\Event;
use App\Models\Bbs\Venue;
use App\Models\Mds\DeliveryBooking;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $eventId = session()->get('EVENT_ID');
        $bookings = BroadcastBooking::with('service')
            ->where('event_id', $eventId)
            ->get();
        $venues = Venue::all();
        $events = Event::all();
        $broadcasters = Auth::user()->name;
        $matches = BroadcastBooking::all();
        $services = BroadcastBooking::all();

        return view('bbs.admin.booking.list', compact('bookings', 'venues', 'events', 'broadcasters', 'services', 'matches'));
    }

    public function list()
    {
        Log::info('BookingController::list request: ' . json_encode(request()->all()));
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $ops = BroadcastBooking::orderBy($sort, $order);

        if ($search) {
            $ops = $ops->where(function ($q) use ($search) {
                $q->whereHas('created_by_user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('event', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('venue', function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('service', function ($query) use ($search) {
                        $query->where('title', 'like', '%' . $search . '%');
                    });
            });
        }

        $total = $ops->count();
        $limit = request("limit");
        $limit = max(1, min($limit, 100)); // min=1, max=100
        $ops = $ops->paginate($limit)->through(function ($op) {

            // $location = Location::find($op->location_id);
            // auth()->user()->hasRole('SuperAdmin') ? $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' " style="cursor: pointer;" id="editDriverStatus" data-id="' . $op->id . '" data-table="drivers_table"><span class="badge-label">' . $op->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>' : 
            //                                      $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' "><span class="badge-label">' . $op->status->title . '</span></span>';

            $image = '<img src="' . asset('storage/upload/service/images/' . $op->image) . '" width="53" height="53" alt="...">';
            // Log::info('image: ' . $image);
            $update_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="editEvents" data-id=' . $op->id .
                ' data-table="event_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="bookings_table" data-id="' .
                $op->id .
                '" id="deleteBooking" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';

            $actions = $delete_action;
            return  [
                'id' => $op->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' .$op->id. '</div>',
                'ref_number' => '<div class="align-middle text-wrap fs-9 ps-3 ps-1">' . $op->ref_number . '</div>',
                'organization_name' => '<div class="align-middle text-wrap fs-9 ps-3 ps-1">' . $op->created_by_user?->organization_name . '</div>',
                'created_by' => '<div class="align-middle text-wrap fs-9 ps-3 ps-1">' . $op->created_by_user?->name . '</div>',
                'event_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->event?->name . '</div>',
                'venue_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->venue?->title . '</div>',
                'match_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->match?->match_code . '</div>',
                'service_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->service?->title . '</div>',
                'quantity' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->quantity . '</div>',
                // 'image' => '<div class="align-middle  fs-9 ps-3">' . $op->image . '</div>',
                // 'status' => '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $venue->status->color . ' " style="cursor: pointer;" id="editDriverStatus" data-id="' . $venue->id . '" data-table="drivers_table"><span class="badge-label">' . $venue->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>',
                'actions' => $actions,
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $ops->items(),
            "total" => $total,
        ]);
    }

    public function dashboard()
    {
        return view('mds.admin.dashboard.index');
    }

    public function delete($id)
    {
        // LOG::info('inside delete');
        DB::beginTransaction();
        try {
            $op = BroadcastBooking::find($id);
            $service = BroadcastService::find($op->service_id);
            $groupKey = $service->group_key;
            $current_booking_quantity = $op->quantity;

            Log::info('service available_slots before delete: ' . $current_booking_quantity);

            // sync all items in the same group
            Log::info('groupKey: ' . $groupKey);
            Log::info('broadcast service id: ' . $id);

            if ($groupKey) {
                BroadcastService::where('group_key', $groupKey)
                    ->where('id', '!=', $service->id)
                    ->update(['available_slots' => DB::raw('available_slots + ' . $current_booking_quantity), 'used_slots' => DB::raw('used_slots - ' . $current_booking_quantity)]);
            }
            
            $service->increment('available_slots', intval($current_booking_quantity));
            $service->decrement('used_slots', intval($current_booking_quantity));


            // $service->save();

            $op->delete();

            DB::commit();
            $error = false;
            $message = 'Reservation deleted succesfully.';

            $notification = array(
                'message'       => 'Reservation deleted successfully',
                'alert-type'    => 'success'
            );

            return response()->json(['error' => $error, 'message' => $message]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting reservation: ' . $e->getMessage());
            $error = true;
            $message = 'An error occurred while deleting the reservation. Please try again.';
            return response()->json(['error' => $error, 'message' => $message]);
            // return redirect()->route('tracki.setup.workspace')->with($notification);
        } // delete
    }


    /**
     * Remove the specified resource from storage.
     */


    public function switch($id)
    {
        if ($id) {
            if (Event::findOrFail($id)) {
                Log::info('Event ID: ' . $id);

                session()->put('EVENT_ID', $id);
                Log::info('Event ID: ' . session()->get('EVENT_ID'));
                // return redirect()->route('tracki.project.show.card')->with('message', 'Workspace switched successfully.');
                return redirect()->route('mds.admin.booking')->with('message', 'Event Switched.');
                // return back()->with('message', 'Event Switched.');
            } else {
                // return back()->with('error', 'Workspace not found.');
                // return redirect()->route('tracki.project.show.card')->with('error', 'Workspace not found.');
                return back()->with('error', 'Event not found.');
            }
        } else {
            session()->forget('EVENT_ID');
            // return redirect()->route('tracki.project.show.card')->with('message', 'Workspace switched successfully. now showing all workspace data');
            return back()->withInput();
        }
    }

    public function pickEvent(Request $request)
    {
        // $events = MdsEvent::all();
        // $this->switch($request->event_id);
        // return view('mds.admin.booking.pick', compact('events'));
        if ($request->event_id) {
            Log::info('Event ID: ' . $request->event_id);
            if (Event::findOrFail($request->event_id) && !session()->has('EVENT_ID')) {
                Log::info('Inside if statement Event ID: ' . $request->event_id);

                session()->put('EVENT_ID', $request->event_id);
                Log::info('session EVENT_ID: ' . session()->get('EVENT_ID'));
                Log::info('before redirect');
                // return redirect()->route('tracki.project.show.card')->with('message', 'Workspace switched successfully.');
                return redirect()->route('bbs.admin.booking')->with('message', 'Event Switched.');
                // return back()->with('message', 'Event Switched.');
            }
        }
        //  else {
        // return back()->with('error', 'Workspace not found.');
        // return redirect()->route('tracki.project.show.card')->with('error', 'Workspace not found.');
        Log::info('event_id is null');
        return redirect()->route('bbs.admin.booking')->with('error', 'Event not found.');
        // }
    }
}

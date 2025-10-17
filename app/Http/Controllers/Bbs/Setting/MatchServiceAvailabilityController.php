<?php

namespace App\Http\Controllers\Bbs\Setting;

use App\Http\Controllers\Controller;
use App\Models\Bbs\BroadcastService;
use App\Models\Bbs\Event;
use App\Models\Bbs\Matches;
use App\Models\Bbs\MatchServiceAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Laravel\Facades\Image;


// use Illuminate\Support\Facades\Redirect;

class MatchServiceAvailabilityController extends Controller
{
    //
    public function index()
    {
        Log::info('MatchServiceAvailabilityController@index');
        $match_services_availability = MatchServiceAvailability::all();
        $matches = Matches::all();
        $broadcast_services = BroadcastService::all();
        // $menus = MenuItem::whereNotNull('parent_id')->with('children')->orderBy('order_number')->get();
        return view('bbs.setting.match-service-availability.list', compact('match_services_availability', 'broadcast_services', 'matches'));
    }

    public function switch($id = null)
    {
        if ($id) {
            $event = Event::find($id);

            if ($event) {
                Log::info('Event ID: ' . $id);

                session()->put('EVENT_ID', $id);
                Log::info('Event ID: ' . session()->get('EVENT_ID'));

                return redirect()->route('bbs.admin.booking')->with('message', 'Event switched.');
            } else {
                return back()->with('error', 'Event not found.');
            }
        } else {
            session()->forget('EVENT_ID');
            return back()->withInput();
        }
    }

    public function get($id)
    {
        $op = BroadcastService::findOrFail($id);
        return response()->json(['op' => $op]);
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $ops = MatchServiceAvailability::orderBy($sort, $order);

        if ($search) {
            $ops = $ops->where(function ($query) use ($search) {
                $query->WhereHas(
                    'match',
                    function ($match) use ($search) {
                        $match->where('match_code', 'like', '%' . $search . '%');
                    }
                )->orWhereHas('service', function ($service) use ($search) {
                    $service->where('title', 'like', '%' . $search . '%');
                });
            });
        }
        $total = $ops->count();
        $ops = $ops->paginate(request("limit"))->through(function ($op) {

            // $location = Location::find($op->location_id);
            // auth()->user()->hasRole('SuperAdmin') ? $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' " style="cursor: pointer;" id="editDriverStatus" data-id="' . $op->id . '" data-table="drivers_table"><span class="badge-label">' . $op->status->title . '</span><span class="ms-1 uil-edit-alt" style="height:12.8px;width:12.8px;cursor: pointer;"></span></span>' : 
            //                                      $status = '<span class="badge badge-phoenix fs--2 ms-3 badge-phoenix-' . $op->status->color . ' "><span class="badge-label">' . $op->status->title . '</span></span>';

            $image = '<img src="' . asset('storage/upload/service/images/' . $op->image) . '" width="53" height="53" alt="...">';
            // Log::info('image: ' . $image);
            return  [
                'id' => $op->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' .$op->id. '</div>',
                'match' => $op->match->match_code,
                'service' => $op->service->title,
                'group_key' => '<div class="align-middle text-wrap fs-9 ps-3">' . $op->group_key . '</div>',
                'max_slots' => '<div class="align-middle text-wrap fs-9 ps-3">' . $op->max_slots . '</div>',
                'available_slots' => '<div class="align-middle text-wrap fs-9 ps-3">' . $op->available_slots . '</div>',
                'used_slots' => '<div class="align-middle text-wrap fs-9 ps-3">' . $op->used_slots . '</div>',
                'reservation_limit' => '<div class="align-middle text-wrap fs-9 ps-3">' . $op->reservation_limit . '</div>',
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $ops->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user = Auth::user();
        $op = new MatchServiceAvailability();

        $rules = [
            'match_id' => ['required'],
            'service_id' => ['required'],
            'max_slots' => ['required'],
            'available_slots' => ['required'],
            'used_slots' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
            return response()->json(['error' => $error, 'message' => $message]);
        }

        try {

            $error = false;
            $message = 'Match service availability created succesfully.' . $op->id;

            $op->match_id = $request->match_id;
            $op->service_id = $request->service_id;
            $op->max_slots = $request->max_slots;
            $op->available_slots = $request->available_slots;
            $op->used_slots = $request->used_slots;
            $op->group_key = $request->group_key;
            $op->reservation_limit = $request->reservation_limit;

            $op->save();

            return response()->json(['error' => $error, 'message' => $message]);
        } catch (\Exception $e) {
            Log::error('Error creating match service availability: ' . $e->getMessage());
            $error = true;
            $message = 'An error occurred while creating the match service availability.';
            return response()->json(['error' => $error, 'message' => $message]);
        }
    }

    public function update(Request $request)
    {
        //
        // dd($request);
        Log::info('update');
        Log::info($request->all());

        $user = Auth::user();

        $rules = [
            'match_id' => ['required'],
            'service_id' => ['required'],
            'max_slots' => ['required'],
            'available_slots' => ['required'],
            'used_slots' => ['required'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
            return response()->json(['error' => $error, 'message' => $message]);
        }

        try {
            $op = MatchServiceAvailability::find($request->id);

            $error = false;
            $message = 'Match service availability updated succesfully.' . $op->id;

            $op->match_id = $request->match_id;
            $op->service_id = $request->service_id;
            $op->max_slots = $request->max_slots;
            $op->available_slots = $request->available_slots;
            $op->used_slots = $request->used_slots;
            $op->group_key = $request->group_key;
            $op->reservation_limit = $request->reservation_limit;

            $op->save();

            return response()->json(['error' => $error, 'message' => $message]);
        } catch (\Exception $e) {
            Log::error('Error updating match service availability: ' . $e->getMessage());
            $error = true;
            $message = 'An error occurred while updating the match service availability.';
            return response()->json(['error' => $error, 'message' => $message]);
        }
    }

    public function delete($id)
    {
        $op = MatchServiceAvailability::findOrFail($id);
        $op->delete();

        $error = false;
        $message = 'Match Service Availability deleted succesfully.';

        $notification = array(
            'message'       => 'Match Service Availability deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

    public function getView($id)
    {
        $match_service_availability = MatchServiceAvailability::find($id);
        $matches = Matches::all();
        $services = BroadcastService::all();


        $view = view('/bbs/setting/match-service-availability/mv/edit', [
            'match_service_availability' => $match_service_availability,
            'matches' => $matches,
            'services' => $services,
        ])->render();

        return response()->json(['view' => $view]);
    }  // End function getProjectView

}

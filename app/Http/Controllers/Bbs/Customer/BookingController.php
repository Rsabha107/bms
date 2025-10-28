<?php

namespace App\Http\Controllers\Bbs\Customer;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewBookingEmailJob;
use App\Models\Bbs\BroadcastBooking;
use App\Models\Mds\BookingSlot;
use App\Models\Mds\FunctionalArea;
use App\Models\Mds\DeliveryBooking;
use App\Models\Mds\DeliveryCargoType;
use App\Models\Mds\DeliveryRsp;
// use App\Models\Mds\DeliverySchedule;
// use App\Models\Mds\DeliverySchedulePeriod;
use App\Models\Mds\DeliveryType;
use App\Models\Mds\DeliveryVehicle;
use App\Models\Mds\DeliveryVehicleType;
use App\Models\Mds\DeliveryVenue;
use App\Models\Bbs\BroadcastService;
use App\Models\Bbs\Event;
use App\Models\Bbs\Matches;
use App\Models\Bbs\MatchServiceAvailability;
use App\Models\Bbs\MenuItem;
use App\Models\Bbs\MmcSpace;
use App\Models\Bbs\MmcSpaceMatch;
use App\Models\Mds\DeliveryZone;
use App\Models\Mds\MdsDriver;
use App\Models\Mds\MdsEvent;
use App\Models\Bbs\Venue;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info('CustomerBookingController::index');

        // You said you don't want to use DeliveryBooking (old project),
        // so we'll just return an empty collection to keep things safe.
        // $bookings = collect();
        // $bookings = BroadcastBooking::with('service')->where('created_by', Auth::user()->id)
        //     ->where('event_id', session()->get('EVENT_ID'))
        //     // ->where('venue_id', session()->get('VENUE_ID'))
        //     ->get();
        $services = BroadcastService::all();
        $menus = MenuItem::whereNull('parent_id')
            ->with('children.children') // recursive depth
            ->orderBy('order_number')
            ->get();
        // Log::info('menus: ' . json_encode($menus, JSON_PRETTY_PRINT));
        $venues = Venue::all();
        $matches = Matches::all();
        $mmc_spaces = MmcSpace::all();

        return view(
            'bbs.customer.booking.list',
            compact('services', 'menus', 'venues', 'matches', 'mmc_spaces')
        );
    }

    public function list()
    {
        // Log::info('BookingController::list request: ' . json_encode(request()->all()));
        // Log::info('session()->all(): ' . json_encode(session()->all()));
        // Log::info('session()->get(EVENT_ID): ' . session()->get('EVENT_ID'));
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $ops = BroadcastBooking::orderBy($sort, $order);
        $ops = $ops->where('created_by', Auth::user()->id);
        $ops = $ops->where('event_id', session()->get('EVENT_ID'));

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

        // if ($search) {
        //     $ops = $ops->where(function ($query) use ($search) {
        //         $query->where('first_name', 'like', '%' . $search . '%')
        //             ->orWhere('last_name', 'like', '%' . $search . '%')
        //             ->orWhere('mobile_number', 'like', '%' . $search . '%')
        //             ->orWhere('national_identifier_number', 'like', '%' . $search . '%')
        //             ->orWhere('id', 'like', '%' . $search . '%');
        //     });
        // }
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
                'ref_number' => '<div class="align-middle text-wrap fs-9 ps-3 ps-1">' . $op->ref_number . '</div>',
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' .$op->id. '</div>',
                'organization_name' => '<div class="align-middle text-wrap fs-9 ps-3 ps-1">' . $op->created_by_user?->organization_name . '</div>',
                'created_by' => '<div class="align-middle text-wrap fs-9 ps-3 ps-1">' . $op->created_by_user?->name . '</div>',
                'event_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->event?->name . '</div>',
                'venue_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . ($op->venue?->title ?? $op->studio?->title) . '</div>',
                // 'venue_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->venue?->title . '</div>',
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

    public function getServiceAvailability(Request $request)
    {
        Log::info('BookingController::getServiceAvailability request: ' . json_encode($request->all()));
        $service = MatchServiceAvailability::where('service_id', $request->service_id)
            ->where('match_id', $request->match_id)
            ->get();

        return response()->json(['service' => $service]);
    }

    public function showServices($id)
    {
        Log::info('CustomerBookingController::showServices id: ' . $id);

        // You said you don't want to use DeliveryBooking (old project),
        // so we'll just return an empty collection to keep things safe.
        // $bookings = collect();
        // $bookings = BroadcastBooking::with('service')->where('created_by', Auth::user()->id)
        //     ->where('event_id', session()->get('EVENT_ID'))
        //     // ->where('venue_id', session()->get('VENUE_ID'))
        //     ->get();
        forget_menu_session();
        $selected_menu_db = MenuItem::find($id);
        $selected_menu_title = $selected_menu_db->title;
        // get the parent menu title if exists
        // $selected_menu_display = ($selected_menu_db->parent) ? $selected_menu_db->parent->title . '/' . $selected_menu_title : $selected_menu_title;
        $selected_menu_display = $selected_menu_title;
        if ($selected_menu_db->parent) {
            $breadcrumb = [
                ['title' => 'Home', 'url' => route('home')],
                ['title' => $selected_menu_db->parent->title, 'url' => ''],
                ['title' => $selected_menu_title, 'url' => '']
            ];
        } else {
            $breadcrumb = [
                ['title' => 'Home', 'url' => route('home')],
                ['title' => $selected_menu_title, 'url' => '']
            ];
        }

        session()->put('breadcrumb', $breadcrumb);

        $services = BroadcastService::where('menu_item_id', $id)->get();
        $menus = MenuItem::whereNull('parent_id')
            ->with('children.children') // recursive depth
            ->orderBy('order_number')
            ->get();
        $event = Event::find(session()->get('EVENT_ID'));
        $venues = $event?->venues;
        $matches = Matches::all();
        $mmc_studios = MmcSpace::where('space_type', 'studio')->get();
        $mmc_confs = MmcSpace::where('space_type', 'conference')->get();


        session()->put($selected_menu_db->link, 'active');
        if ($selected_menu_db->parent) {
            session()->put($selected_menu_db->parent->link, 'active');
        }

        // Log::info('session()->all(): ' . json_encode(session()->all()));

        return view(
            'bbs.customer.booking.list-services',
            compact('services', 'menus', 'breadcrumb', 'venues', 'matches', 'mmc_studios', 'mmc_confs')
        );
    }

    function getMatchesByVenue(Request $request)
    {
        Log::info('BookingController::getMatchesByVenue request: ' . json_encode($request->all()));
        $matches = Matches::where('venue_id', $request->venue_id)->get();

        return response()->json(['matches' => $matches]);
    }

    function getMatchesByStudio(Request $request)
    {
        Log::info('BookingController::getMatchesByStudio request: ' . json_encode($request->all()));
        $matches = MmcSpaceMatch::where('mmc_space_id', $request->studio_id)->get();

        return response()->json(['matches' => $matches]);
    }

    function getMatchesByConference(Request $request)
    {
        Log::info('BookingController::getMatchesByConference request: ' . json_encode($request->all()));
        $matches = MmcSpaceMatch::where('mmc_space_id', $request->conference_id)->get();

        return response()->json(['matches' => $matches]);
    }

    public function listService()
    {
        $selected_menu_display = 'All Services';
        $services = BroadcastService::all();
        $menus = MenuItem::whereNull('parent_id')
            ->with('children.children') // recursive depth
            ->orderBy('order_number')
            ->get();
        $event = Event::find(session()->get('EVENT_ID'));
        $venues = $event?->venues;
        $matches = Matches::all();

        $breadcrumb = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => $selected_menu_display, 'url' => '']
        ];
        session()->put('breadcrumb', $breadcrumb);

        return view(
            'bbs.customer.booking.list-services',
            compact('services', 'menus', 'breadcrumb', 'venues', 'matches')
        );
    }

    public function build_menu($parent_id = null)
    {
        $menus = MenuItem::whereNull('parent_id')
            ->with('children.children') // recursive depth
            ->orderBy('order_number')
            ->get();

        appLog('menus: ' . json_encode($menus));

        // dd($menu);
        return view('/bbs/customer/booking/list-menu', compact('menus'));
    }

    public function dashboard()
    {
        return view('mds.customer.dashboard.index');
    }


    public function delete($id)
    {
        // LOG::info('inside delete');
        DB::beginTransaction();
        try {
            $op = BroadcastBooking::find($id);
            $service_availability = MatchServiceAvailability::where('service_id', $op->service_id)
                ->where('match_id', $op->match_id)->first();
            $groupKey = $service_availability?->group_key;
            $current_booking_quantity = $op->quantity;

            Log::info('service available_slots before delete: ' . $current_booking_quantity);
            // get the timeslot id
            // $timeslot_id = $op->schedule_period_id;
            // get the timeslot
            // $timeslot = BookingSlot::find($timeslot_id);

            // $service->available_slots = $service->available_slots + 1;
            // $service->used_slots = $service->used_slots - 1;

            // sync all items in the same group
            Log::info('groupKey: ' . $groupKey);
            Log::info('broadcast service id: ' . $id);

            if ($groupKey) {
                MatchServiceAvailability::where('group_key', $groupKey)
                    ->where('id', '!=', $service_availability->id)
                    ->where('match_id', $op->match_id)
                    ->update(['available_slots' => DB::raw('available_slots + ' . $current_booking_quantity), 'used_slots' => DB::raw('used_slots - ' . $current_booking_quantity)]);
            }

            $service_availability->increment('available_slots', intval($current_booking_quantity));
            $service_availability->decrement('used_slots', intval($current_booking_quantity));

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


    public function detail($id)
    {
        $booking = BroadcastService::findOrFail($id);

        // dd($project);

        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);


        // Pass it to the Blade view
        return view('bbs.customer.booking.detail', compact('booking'));
    }

    public function storeService(Request $request)
    {
        // return redirect()->back()->with('error', 'Not enough available slots for the selected service.');
        // }
        //
        // dd($request->all());
        $user = Auth::user();

        $rules = [
            'service_id' => 'required',
            'quantity'   => 'required',
            'venue_id'   => 'required_without:studio_id',
            'studio_id'  => 'required_without:venue_id',
            'match_id'   => 'required',
        ];

        $messages =  [
            'venue_id.required_without' => 'Either venue or studio must be selected.',
            'studio_id.required_without' => 'Either studio or venue must be selected.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Log::info($validator->errors()->all(':message'));
            $type = 'error';
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
            $notification = array(
                'message'       => $message,
                'alert-type'    => $type
            );
            return redirect()->back()->with($notification);
        }

        // check number of slots available.  if available slots = 0 then exit with a warning message.
        // this is incase a user grabed the last slot with this user is waiting ..
        try {
            DB::transaction(function () use ($request, $user) {
                // lock the service row for update
                // $service = BroadcastService::where('id', $request->service_id)->lockForUpdate()->first();
                $service_availability = MatchServiceAvailability::where('service_id', $request->service_id)
                    ->where('match_id', $request->match_id)
                    ->lockForUpdate()->first();

                Log::info('service availability: ' . json_encode($service_availability));

                $groupKey = $service_availability?->group_key;
                Log::info('service available_slots: ' . $service_availability?->available_slots);
                Log::info('request quantity: ' . $request->quantity);

                if (!$service_availability || $service_availability->available_slots < $request->quantity) {
                    $message = 'Not enough available slots for the selected service.';
                    throw new \Exception($message);
                }

                $booking = new BroadcastBooking();

                $error = false;

                // $booking->booking_ref_number = 'MDS' . $booking->id;
                // $booking->schedule_id =  $timeslots->delivery_schedule_id;
                $booking->service_id = $request->service_id;
                $booking->quantity = intval($request->quantity);
                $booking->unit_price = intval($request->unit_price);
                $booking->total_price = intval($request->quantity) * intval($request->unit_price);
                $booking->quantity = intval($request->quantity);
                // $booking->venue_id = $request->venue_id;
                $booking->venue_id = $request->venue_id ?? $request->studio_id;
                $booking->match_id = $request->match_id;
                $booking->created_by = $user->id;
                $booking->updated_by = $user->id;
                $booking->event_id = session()->get('EVENT_ID'); // Tie booking to current event
                $service = BroadcastService::find($request->service_id);

                $service_availability->decrement('available_slots', $request->quantity);
                $service_availability->increment('used_slots', $request->quantity);

                // sync all items in the same group
                if ($groupKey) {
                    MatchServiceAvailability::where('group_key', $groupKey)
                        ->where('id', '!=', $service_availability->id)
                        ->where('match_id', $request->match_id)
                        ->update(['available_slots' => DB::raw('available_slots - ' . $request->quantity), 'used_slots' => DB::raw('used_slots + ' . $request->quantity)]);
                }

                // $booking->event_id = session()->get('EVENT_ID');
                // $booking->booking_date = Carbon::createFromFormat('d/m/Y', $request->booking_date)->toDateString();

                // $service->save();
                $booking->save();

                // return view('bbs.customer.booking.cart');
                // return response()->json(['error' => $error, 'message' => $message]);
            });

            $type = 'success';
            $message = 'Booking created succesfully.';
            $notification = array(
                'message'       => $message,
                'alert-type'    => $type
            );
            return redirect()->route('bbs.customer.booking')->with($notification);
        } catch (\Exception $e) {
            Log::error('Error creating booking: ' . $e->getMessage());
            $type = 'error';
            $message = 'An error occurred while creating the booking. Please try again.';
            $notification = array(
                'message'       => $e->getMessage(),
                'alert-type'    => $type
            );
            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request)
    {
        //
        //  dd($request);
        $user_id = Auth::user()->id;
        $booking = DeliveryBooking::find($request->id);
        $timeslots = BookingSlot::findOrFail($request->schedule_period_id);

        // dd($booking);
        $rules = [
            'booking_date' => 'required',
            'schedule_period_id' => 'required',
            'venue_id' => 'required',
            'driver_id' => 'required',
            'vehicle_id' => 'required',
            'vehicle_type_id' => 'required',
            'receiver_name' => 'required',
            'receiver_contact_number' => 'required',
            'dispatch_id' => 'required',
            'cargo_id' => 'required',
            'loading_zone_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $type = 'error';
            $message = 'Booking could not be created';
        } else {

            // check number of slots available.  if available slots = 0 then exit with a warning message.
            // this is incase a user grabed the last slot with this user is waiting ..

            if ($timeslots->available_slots > 0) {

                $error = false;
                $type = 'success';
                $message = 'Booking updated succesfully.' . $booking->id;

                Log::info('booking->schedule_period_id: ' . $booking->schedule_period_id);
                Log::info('request->schedule_period_id: ' . $request->schedule_period_id);

                if ($request->schedule_period_id != $booking->schedule_period_id) {
                    Log::info('booking->schedule_period_id: ' . $booking->schedule_period_id);
                    Log::info('request->schedule_period_id: ' . $request->schedule_period_id);

                    $timeslots->available_slots = $timeslots->available_slots - 1;
                    $timeslots->used_slots = $timeslots->used_slots + 1;

                    $old_timeslot = BookingSlot::findOrFail($booking->schedule_period_id);
                    $old_timeslot->available_slots = $old_timeslot->available_slots + 1;
                    $old_timeslot->used_slots = $old_timeslot->used_slots - 1;
                } else {
                    $timeslots->available_slots = $timeslots->available_slots;
                    $timeslots->used_slots = $timeslots->used_slots;
                }

                // $booking->booking_ref_number = 'MDS' . $booking->id;
                $booking->schedule_id =  $timeslots->delivery_schedule_id;
                $booking->schedule_period_id = $request->schedule_period_id;
                // $booking->booking_date = Carbon::createFromFormat('Y/m/d', $request->booking_date)->toDateString();
                $booking->booking_date = $request->booking_date;
                $booking->venue_id = $request->venue_id;
                $booking->client_id = $request->client_id;
                $booking->rsp_id = $timeslots->rsp_id;
                $booking->booking_party_company_name = $request->booking_party_company_name;
                $booking->booking_party_contact_name = $request->booking_party_contact_name;
                $booking->booking_party_contact_email = $request->booking_party_contact_email;
                $booking->booking_party_contact_number = $request->booking_party_contact_number;
                // $booking->delivering_party_company_name = $request->delivering_party_company_name;
                // $booking->delivering_party_contact_number = $request->delivering_party_contact_number;
                // $booking->delivering_party_contact_email = $request->delivering_party_contact_email;
                $booking->driver_id = $request->driver_id;
                $booking->vehicle_id = $request->vehicle_id;
                $booking->vehicle_type_id = $request->vehicle_type_id;
                $booking->receiver_name = $request->receiver_name;
                $booking->receiver_contact_number = $request->receiver_contact_number;
                $booking->dispatch_id = $request->dispatch_id;
                $booking->loading_zone_id = $request->loading_zone_id;
                $booking->cargo_id = $request->cargo_id;
                $booking->active_flag = $request->active_flag;
                $booking->created_by = $user_id;
                $booking->updated_by = $user_id;
                $booking->active_flag = 1;

                $timeslots->save();
                if (isset($old_timeslot)) {
                    $old_timeslot->save();
                }
                $booking->save();
            } else {
                $error = true;
                $type = 'error';
                $message = 'Time slot choosing has been used. please choose a different time slot.' . $booking->id;
            }
        }

        $notification = array(
            'message'       => $message,
            'alert-type'    => $type
        );

        return redirect()->route('mds.customer.booking')->with($notification);
        // return view('mds.customer.booking');


        // return response()->json(['error' => $error, 'message' => $message]);
    }

    public function save_pass_pdf($booking)
    {
        // set_time_limit(300);
        // $booking = DeliveryBooking::findOrFail($id);
        $qr_code = getQrCode($booking->id, 100);
        $data = [
            'to' => 'Sam Example',
            'subtotal' => '5.00',
            'tax' => '.35',
            'total' => '5.35',
            'receipeint_company' => 'GWC Logistics',
            'booking' => $booking,
            'qr_code' => $qr_code,

        ];

        $data['css'] = public_path('assets/css/invoice.css');
        $pdf = Pdf::loadView('mds.admin.booking.passx', $data);
        Storage::disk('private')->put('mds/pdf-exports/' . $booking->booking_ref_number . '.pdf', $pdf->output());

        return 1;
    }

    public function passPdf(Request $request, $id)
    {
        // set_time_limit(300);
        $booking = DeliveryBooking::findOrFail($id);
        $qr_code = getQrCode($booking->id, 100);


        $data = [
            'to' => 'Sam Example',
            'subtotal' => '5.00',
            'tax' => '.35',
            'total' => '5.35',
            'receipeint_company' => 'GWC Logistics',
            'booking' => $booking,
            'qr_code' => $qr_code,

        ];

        if ($request->has('preview')) {
            $data['css'] = asset('assets/css/invoice.css');
            return view('mds.booking.passx', $data);
        } else {
            $data['css'] = public_path('assets/css/invoice.css');
        }

        // Pdf::view('mds.booking.passx');
        // Pdf::view('mds.booking.passx')->save('/upload/passx.pdf');
        // return view('mds.booking.passx', $data);
        $pdf = Pdf::loadView('mds.customer.booking.passx', $data);
        // return $pdf->download('itsolutionstuff.pdf');
        return $pdf->stream();
    }  //taskDetailsPDF

    // public function get_times($date, $venue_id)
    // {
    //     // LOG::info('inside get_times');
    //     $formated_date = Carbon::createFromFormat('dmY', $date)->toDateString();
    //     // LOG::info('formated_date: '.$formated_date);
    //     // LOG::info('venue_id: '.$venue_id);
    //     $venue = DeliverySchedulePeriod::where('period_date', '=', $formated_date)
    //         ->where('venue_id', '=', $venue_id)
    //         // ->where('available_slots', '>', '0')
    //         ->get();

    //     // $venue = DeliverySchedulePeriod::all();

    //     return response()->json(['venue' => $venue]);
    // }



    public function switch($id = null)
    {
        if ($id) {
            $event = Event::find($id);

            if ($event) {
                Log::info('Event ID: ' . $id);

                session()->put('EVENT_ID', $id);
                Log::info('Event ID: ' . session()->get('EVENT_ID'));

                // Redirect based on role
                return redirect()->route('bbs.customer.booking')->with('message', 'Event switched.');
            } else {
                return back()->with('error', 'Event not found.');
            }
        } else {
            session()->forget('EVENT_ID');
            return back()->withInput();
        }
    }

    public function pickEvent(Request $request)
    {
        if ($request->event_id) {
            // Check and store Event ID
            if (Event::findOrFail($request->event_id)) {
                session()->put('EVENT_ID', $request->event_id);
            }

            // // Check and store Venue ID
            // if (Venue::findOrFail($request->venue_id) && !session()->has('VENUE_ID')) {
            //     session()->put('VENUE_ID', $request->venue_id);
            // }

            return redirect()->route('bbs.customer.booking')
                ->with('message', 'Event and Venue switched.');
        }

        // If event_id or venue_id is missing
        Log::info('event_id or venue_id is null');
        return redirect()->route('bbs.customer.booking.list')
            ->with('error', 'Event or Venue not found.');
    }

    public function venueSwitch($id)
    {
        if ($id) {
            if (Venue::findOrFail($id)) {
                Log::info('Venue ID: ' . $id);

                session()->put('VENUE_ID', $id);
                Log::info('Venue ID: ' . session()->get('VENUE_ID'));
                return redirect()->route('bbs.customer.booking.list')->with('message', 'Venue Switched.');
            } else {
                // return back()->with('error', 'Workspace not found.');
                return back()->with('error', 'Venue not found.');
            }
        } else {
            session()->forget('VENUE_ID');
            return back()->withInput();
        }
    }
}

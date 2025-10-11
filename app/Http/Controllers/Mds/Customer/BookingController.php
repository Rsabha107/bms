<?php

namespace App\Http\Controllers\Mds\Customer;

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
use App\Models\Mds\DeliveryZone;
use App\Models\Mds\MdsDriver;
use App\Models\Mds\MdsEvent;
use App\Models\Bbs\Venue;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        if (auth()->user()->hasRole('Customer')) {
            return view('bbs.customer.booking.list');
        }

        // You said you don't want to use DeliveryBooking (old project),
        // so we'll just return an empty collection to keep things safe.
        // $bookings = collect();
        $bookings = BroadcastBooking::with('service')->where('user_id', Auth::user()->id)
            ->where('event_id', session()->get('EVENT_ID'))
            // ->where('venue_id', session()->get('VENUE_ID'))
            ->get();

        return view('bbs.customer.booking.list', compact('bookings'));
    }
    // public function customerList()
    // {
    //     $services = BroadcastService::all();
    //     return view('bbs.customer.booking.list', compact('services'));
    // }


    public function dashboard()
    {
        return view('mds.customer.dashboard.index');
    }

    public function listEvent(Request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        // $events = DeliverySchedulePeriod::where('venue_id', $id)
        //     ->where('available_slots', '>', 0)
        //     ->distinct()
        //     ->get('period_date')

        //     // dd($events);
        //     ->map(fn($item) => [
        //         // 'id' => $item->id,
        //         // 'title' => $item->period.' - ('.$item->available_slots.' slots)',
        //         'start' => $item->period_date,
        //         'end' => date('Y-m-d', strtotime($item->period_date . '+1 days')),
        //         // 'category' => $item->category,
        //         'className' => ['bg-warning']
        //     ]);

        // Log::info('BookingController::listEvent carbon yesterday: ' . Carbon::previous('2025-11-01')->setTime(17, 0, 0)->toDateTimeString());
        // $date = Carbon::createFromFormat('Y-m-d',  '2025-03-04');
        // $prevDate = $date->subDay()->setTimeFromTimeString('17:00:00');
        // $now = Carbon::now();
        $t = '7';
        // Log::info('BookingController::listEvent carbon this date: ' . $date);
        // Log::info('BookingController::listEvent carbon this now: ' . $now);
        // Log::info('today is greator than ..'. ($date->gt($now)));
        // Log::info('today is less than ..'. ($date->lt($now)));
        // Log::info('BookingController::listEvent carbon subDay: ' . $prevDate);
        $events = BookingSlot::where('venue_id', $request->venue_id)
            ->where('event_id', session()->get('EVENT_ID'))
            // ->where('bookings_slots_all', '>', 0)
            ->where('available_slots', '>', 0)
            ->where('slot_visibility', '<=', Carbon::now())
            // ->whereRaw("DATE_ADD(booking_date, INTERVAL '-0 7' DAY_HOUR) > NOW()")
            ->where(function ($query) use ($t) {
                $query->whereRaw("DATE_ADD(booking_date, INTERVAL '-0 $t' DAY_HOUR) > NOW()");
            });
        // ->where(Carbon::createFromFormat('Y-m-d','booking_date')->subDay()->setTimeFromTimeString('17:00:00')->gt(Carbon::now()))
        // ->distinct()
        // ->get('booking_date')

        // if catering then include the booking slots catering slots
        if (auth()->user()->hasRole('Catering')) {
            $events = $events->where(function ($query) {
                $query->where('bookings_slots_all', '>', '0')
                    ->orWhere('bookings_slots_cat', '>', '0');
            });
            // if not catering then include the booking slots all slots only
        } else {
            $events = $events->where('bookings_slots_all', '>', '0');
        }

        $events = $events->distinct()->get('booking_date')
            // dd($events);
            ->map(fn($item) => [
                // 'id' => $item->id,
                // 'title' => $item->period.' - ('.$item->available_slots.' slots)',
                'start' => $item->booking_date,
                'end' => date('Y-m-d', strtotime($item->period_date . '+1 days')),
                'display' => 'background',
                'color' => 'green',
                'className' => ['bg-seccess'],
            ]);

        return response()->json($events);
    }

    public function list()
    {
        Log::info('BookingController::list request: ' . json_encode(request()->all()));
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
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="event_table" data-id="' .
                $op->id .
                '" id="deleteEvent" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';

            $actions = $update_action . $delete_action;
            return  [
                'id' => $op->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' .$op->id. '</div>',
                'created_by' => '<div class="align-middle text-wrap fs-9 ps-3 ps-1">' . $op->created_by_user?->name . '</div>',
                'event_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->event?->name . '</div>',
                'venue_id' => '<div class="align-middle text-wrap fs-9 ps-1">' . $op->venue?->title . '</div>',
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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $schedules = DeliverySchedule::all();
        // $intervals = DeliverySchedulePeriod::all();
        // $venues = DeliveryVenue::all();
        $venues = BookingSlot::select('venue_id', 'venue_name')
            ->where('event_id', session()->get('EVENT_ID'))
            ->distinct()
            ->get();
        $events = MdsEvent::all();
        $rsps = DeliveryRsp::all();
        $drivers = MdsDriver::all();
        $vehicles = DeliveryVehicle::all();
        $vehicle_types = DeliveryVehicleType::all();
        $delivery_types = DeliveryType::all();
        $cargos = DeliveryCargoType::all();
        $loading_zones = DeliveryZone::all();
        $clients = FunctionalArea::all();

        return view('mds.customer.booking.create', compact(
            // 'schedules',
            // 'intervals',
            'venues',
            'events',
            'rsps',
            'drivers',
            'vehicles',
            'vehicle_types',
            'delivery_types',
            'cargos',
            'loading_zones',
            'clients'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $booking = new DeliveryBooking();

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

        // $timeslots = DeliverySchedulePeriod::findOrFail($request->schedule_period_id);


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $type = 'success';
            $message = $validator->messages();
            return redirect()->back()->withErrors($message)->withInput();
        } else {

            // check number of slots available.  if available slots = 0 then exit with a warning message.
            // this is incase a user grabed the last slot with this user is waiting ..
            $timeslots = BookingSlot::findOrFail($request->schedule_period_id);

            if ($timeslots->available_slots > 0) {

                $error = false;
                $type = 'success';
                $message = 'Booking created succesfully.' . $booking->id;

                $booking->booking_ref_number = 'MDS' . $booking->id;
                $booking->schedule_id =  $timeslots->delivery_schedule_id;
                $booking->user_id =  $user_id;
                $booking->schedule_period_id = $request->schedule_period_id;
                $booking->booking_date = $request->booking_date;
                $booking->event_id = session()->get('EVENT_ID');
                // $booking->booking_date = Carbon::createFromFormat('d/m/Y', $request->booking_date)->toDateString();
                $booking->venue_id = $request->venue_id;
                $booking->rsp_id = $timeslots->rsp_id;
                $booking->client_id = $request->client_id;
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

                $booking->save();
            } else {
                $error = true;
                $type = 'error';
                $message = 'Time slot choosing has been used please choose a different time slot.' . $booking->id;
            }

            $save_pass_pdf = $this->save_pass_pdf($booking);

            if ($save_pass_pdf) {
                $details = [
                    'email' => 'rsabha@gmail.com',
                    'venue' => $booking->venue->title,
                    'booking_ref_number' => $booking->booking_ref_number,
                    'booking_date' => \Carbon\Carbon::parse($booking->booking_date)->format('l jS \of F Y'),
                    'booking_time_slot' => $booking->schedule->rsp_booking_slot,
                    'filename' => $booking->booking_ref_number . '.pdf',
                ];

                Log::info('BookingController::store details: ' . json_encode($details));
                SendNewBookingEmailJob::dispatch($details);
            }
        }

        $notification = array(
            'message'       => $message,
            'alert-type'    => $type
        );

        // return redirect()->route('mds.customer.booking.confirmation')->with($notification)->with('data', $booking);
        return view('mds.customer.booking.confirmation', ['data' => $booking]);


        // return response()->json(['error' => $error, 'message' => $message]);
    }

    public function deleteBooking($id)
    {
        $op = BroadcastBooking::findOrFail($id);
        $service = BroadcastService::find($op->service_id);
        $service->available_slots = $service->available_slots + $op->quantity;
        $service->used_slots = $service->used_slots - $op->quantity;
        $service->save();
        $op->delete();

        $error = false;
        $message = 'Service deleted succesfully.';

        $notification = array(
            'message'       => 'Service deleted successfully',
            'alert-type'    => 'success'
        );

        return redirect()->route('bbs.customer.booking.cart')->with($notification);
        // return response()->json(['error' => $error, 'message' => $message]);
    } // deleteBooking

    public function delete($id)
    {
        // LOG::info('inside delete');
        $op = DeliveryBooking::find($id);

        // get the timeslot id
        $timeslot_id = $op->schedule_period_id;
        // get the timeslot
        $timeslot = BookingSlot::find($timeslot_id);

        $timeslot->available_slots = $timeslot->available_slots + 1;
        $timeslot->used_slots = $timeslot->used_slots - 1;

        $timeslot->save();

        $op->delete();

        $error = false;
        $message = 'Booking deleted succesfully.';

        $notification = array(
            'message'       => 'Booking deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete


    public function detail($id)
    {
        $booking = BroadcastService::findOrFail($id);

        // dd($project);

        // Log::alert('EmployeeController::getEmpEditView file_name: ' . $emp->emp_files?->file_name);


        // Pass it to the Blade view
        return view('bbs.customer.booking.detail', compact('booking'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = DeliveryBooking::find($id);
        // $intervals = DeliverySchedulePeriod::all();
        $venues = DeliveryVenue::all();
        $events = MdsEvent::all();
        $rsps = DeliveryRsp::all();
        $drivers = MdsDriver::all();
        $vehicles = DeliveryVehicle::all();
        $vehicle_types = DeliveryVehicleType::all();
        $delivery_types = DeliveryType::all();
        $cargos = DeliveryType::all();
        $loading_zones = DeliveryZone::all();
        $clients = FunctionalArea::all();

        return view('mds.customer.booking.edit', compact(
            'booking',
            // 'intervals',
            'venues',
            'events',
            'rsps',
            'drivers',
            'vehicles',
            'vehicle_types',
            'delivery_types',
            'cargos',
            'loading_zones',
            'clients'
        ));
    }

    /**
     * Update the specified resource in storage.
     */


    public function storeService(Request $request)
    {
        //
        // dd($request->all());
        $user_id = Auth::user()->id;
        $booking = new BroadcastBooking();

        $rules = [
            'service_id' => 'required',
            'quantity' => 'required',
            // 'x' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors()->all(':message'));
            $type = 'error';
            // $message = implode($validator->errors()->all(':message'));  // use this for json/jquery
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
            Log::info($message);
            // $message = $validator->errors()->all(':message');
            $notification = array(
                'message'       => $message,
                'alert-type'    => $type
            );
            return redirect()->back()->with($notification);
        } else {

            // check number of slots available.  if available slots = 0 then exit with a warning message.
            // this is incase a user grabed the last slot with this user is waiting ..


            $error = false;
            $type = 'success';
            $message = 'Booking created succesfully.' . $booking->id;

            // $booking->booking_ref_number = 'MDS' . $booking->id;
            // $booking->schedule_id =  $timeslots->delivery_schedule_id;
            $booking->service_id = $request->service_id;
            $booking->quantity = intval($request->quantity);
            $booking->unit_price = intval($request->unit_price);
            $booking->total_price = intval($request->quantity) * intval($request->unit_price);
            $booking->quantity = intval($request->quantity);
            $booking->created_by = $user_id;
            $booking->updated_by = $user_id;
            $booking->event_id = session()->get('EVENT_ID'); // Tie booking to current event
            $service = BroadcastService::find($request->service_id);

            $service->available_slots = $service->available_slots - $request->quantity;
            $service->used_slots = $service->used_slots + $request->quantity;
            // $booking->event_id = session()->get('EVENT_ID');
            // $booking->booking_date = Carbon::createFromFormat('d/m/Y', $request->booking_date)->toDateString();

            $service->save();
            $booking->save();

            $notification = array(
                'message'       => $message,
                'alert-type'    => $type
            );
        }
        return redirect()->route('bbs.customer.booking.cart')->with($notification);
        // return view('bbs.customer.booking.cart');
        // return response()->json(['error' => $error, 'message' => $message]);
    }

    public function cart()
    {
        // Fetch bookings for the logged-in user
        $bookings = BroadcastBooking::with('service')
            ->where('created_by', Auth::user()->id)
            ->get();

        // Check user role
        if (Auth::user()->hasRole('SuperAdmin')) {
            // Show admin cart view
            return view('bbs.admin.booking.cart', compact('bookings'));
        } elseif (Auth::user()->hasRole('Customer')) {
            // Show customer cart view
            return view('bbs.customer.booking.cart', compact('bookings'));
        } else {
            // Optional: redirect other roles or throw error
            abort(403, 'Unauthorized');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
                if (auth()->user()->hasRole('Admin')) {
                    return redirect()->route('bbs.admin.booking.list')->with('message', 'Event switched.');
                } elseif (auth()->user()->hasRole('Customer')) {
                    return redirect()->route('bbs.customer.booking.list')->with('message', 'Event switched.');
                } else {
                    return redirect()->back()->with('message', 'Event switched.');
                }
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
        if ($request->event_id && $request->venue_id) {
            // Check and store Event ID
            if (Event::findOrFail($request->event_id) && !session()->has('EVENT_ID')) {
                session()->put('EVENT_ID', $request->event_id);
            }

            // Check and store Venue ID
            if (Venue::findOrFail($request->venue_id) && !session()->has('VENUE_ID')) {
                session()->put('VENUE_ID', $request->venue_id);
            }

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

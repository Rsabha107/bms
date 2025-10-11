<?php

namespace App\Http\Controllers\Mds\Setting;

use App\Http\Controllers\Controller;
use App\Models\Mds\DeliveryRsp;
// use App\Models\Mds\DeliverySchedule;
use App\Models\Mds\DeliveryVenue;
use App\Models\Location;
use App\Models\Mds\BookingSlot;
use App\Models\Mds\GlobalYN;
use App\Models\Mds\MdsEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class ScheduleController extends Controller
{
    //
    public function index()
    {
        $schedules = BookingSlot::all();
        $events = MdsEvent::all();
        $venues = DeliveryVenue::all();
        $rsps = DeliveryRsp::all();
        $global_yn = GlobalYN::all();

        return view('mds.setting.schedule.list', compact('schedules', 'venues', 'rsps', 'events', 'global_yn'));
    }

    public function get($id)
    {
        $schedules = BookingSlot::findOrFail($id);
        return response()->json(['schedules' => $schedules]);
    }

    public function update(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $op = BookingSlot::find($request->id);

        $rules = [
            'event_id' => 'required',
            'venue_id' => 'required',
            'booking_date' => 'required',
            'rsp_id' => 'required',
            // 'bookings_slots_cat' => 'required',
            'slot_visibility' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
        } else {

            $error = false;
            $message = 'Schedule updated succesfully.' . $op->id;

            $op->venue_id = $request->venue_id;
            $op->event_id = $request->event_id;
            $op->event_name = MdsEvent::find($request->event_id)->name;
            $op->venue_name = DeliveryVenue::find($request->venue_id)->title;
            $op->remote_search_park = DeliveryRsp::find($request->rsp_id)->title;
            $op->booking_date = Carbon::createFromFormat('d/m/Y', $request->booking_date)->toDateString();
            $op->rsp_booking_slot = $request->rsp_booking_slot;
            $op->venue_arrival_time = $request->venue_arrival_time;
            $op->bookings_slots_all = intval($request->bookings_slots_all);
            $op->bookings_slots_cat = intval($request->bookings_slots_cat);
            $op->available_slots = $request->available_slots;
            $op->used_slots = $request->used_slots;
            $op->bookings_slots_cat = $request->bookings_slots_cat;
            $op->slot_visibility = Carbon::createFromFormat('d/m/Y', $request->slot_visibility)->toDateString();
            $op->rsp_id = $request->rsp_id;
            $op->match_day = $request->match_day;
            $op->comments = $request->comments;
            $op->created_by = $user_id;
            $op->updated_by = $user_id;

            $op->save();
        }

        $notification = array(
            'message'       => 'Schedule updated successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function list()
    {
        Log::info('inside Admin ScheduleController::list');
        Log::info(request()->all());

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $mds_schedule_event_filter = (request()->mds_schedule_event_filter) ? request()->mds_schedule_event_filter : "";
        $mds_schedule_venue_filter = (request()->mds_schedule_venue_filter) ? request()->mds_schedule_venue_filter : "";
        $mds_schedule_rsp_filter = (request()->mds_schedule_rsp_filter) ? request()->mds_schedule_rsp_filter : "";
        $mds_date_range_filter = (request()->mds_date_range_filter) ? request()->mds_date_range_filter : "";


        $ops = BookingSlot::orderBy($sort, $order);

        if ($search) {
            $ops = $ops->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('short_name', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }

        if ($mds_schedule_event_filter) {
            $ops = $ops->where('event_id', $mds_schedule_event_filter);
        }

        if ($mds_schedule_venue_filter) {
            $ops = $ops->where('venue_id', $mds_schedule_venue_filter);
        }

        if ($mds_schedule_rsp_filter) {
            $ops = $ops->where('rsp_id', $mds_schedule_rsp_filter);
        }


        if ($mds_date_range_filter) {
            $dates = explode('to', $mds_date_range_filter);
            // Log::info('mds_date_range_filter: ' . $mds_date_range_filter);
            // Log::info('dates: ' . count($dates));
            $startDate = trim($dates[0]);
            // Log::info($dates.length);
            if( count($dates) > 1) {
                $endDate = trim($dates[1]);
            } else {
                $endDate = null;
            }
            // Log::info('startDate: ' . $startDate);
            // Log::info('endDate: ' . $endDate);
            if ($startDate) {
                $startDate = Carbon::createFromFormat('d/m/y', $startDate)->toDateString();
            }
            if ($endDate) {
                $endDate = Carbon::createFromFormat('d/m/y', $endDate)->toDateString();
            }

            if ($startDate && $endDate) {
                $ops = $ops->whereBetween('booking_date', [$startDate, $endDate]);
            } else if ($startDate) {
                $ops = $ops->where('booking_date', '>=', $startDate);
            } else if ($endDate) {
                $ops = $ops->where('booking_date', '<=', $endDate);
            }
            // $ops = $ops->whereBetween('booking_date', [$startDate, $endDate]);
        }

        // Carbon::createFromFormat('d/m/Y', $request->slot_visibility)->toDateString()


        $total = $ops->count();
        $ops = $ops->paginate(request("limit"))->through(function ($op) {
            // $ops = $ops->paginate(request("limit"))->through(function ($op) {

                $div_action = '<div class="font-sans-serif btn-reveal-trigger position-static">';

                $update_action =
                    '<a href="javascript:void(0)" class="btn btn-sm" id="edit_booking_slot_offcanv" data-id=' . $op->id .
                    ' data-table="schedules_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                    '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
                $duplicate_action =
                    '<a href="javascript:void(0)" class="btn btn-sm" id="duplicate_employee" data-action="update" data-type="duplicate" data-id=' .
                    $op->id .
                    ' data-table="schedules_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Duplicate">' .
                    '<i class="fa-solid fa-copy text-success"></i></a>';
                $delete_action =
                    '<a href="javascript:void(0)" class="btn btn-sm" data-table="schedules_table" data-id="' .
                    $op->id .
                    '" id="delete_booking_slot" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                    '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';

            $actions = $div_action . $update_action . $delete_action;

            return  [
                'id' => $op->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-8 ps-2">' .$venue->id. '</div>',
                'event' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->event?->name . '</div>',
                'venue' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->venue?->title . '</div>',
                'booking_date' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . format_date($op->booking_date) . '</div>',
                'rsp_booking_slot' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->rsp_booking_slot . '</div>',
                'venue_arrival_time' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->venue_arrival_time . '</div>',
                'bookings_slots_all' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->bookings_slots_all . '</div>',
                'available_slots' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->available_slots . '</div>',
                'used_slots' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->used_slots . '</div>',
                'bookings_slots_cat' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->bookings_slots_cat . '</div>',
                'slot_visibility' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . format_date($op->slot_visibility) . '</div>',
                'rsp_id' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->rsp?->title . '</div>',
                'match_day' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->match_day . '</div>',
                'comments' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->comments . '</div>',
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

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $op = new BookingSlot();

        $rules = [
            'event_id' => 'required',
            'venue_id' => 'required',
            'booking_date' => 'required',
            'rsp_id' => 'required',
            // 'bookings_slots_cat' => 'required',
            'slot_visibility' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
        } else {

            $error = false;
            $message = 'Schedule created succesfully.' . $op->id;

            $op->venue_id = $request->venue_id;
            $op->event_id = $request->event_id;
            $op->event_name = MdsEvent::find($request->event_id)->name;
            $op->venue_name = DeliveryVenue::find($request->venue_id)->title;
            $op->remote_search_park = DeliveryRsp::find($request->rsp_id)->title;
            $op->booking_date = Carbon::createFromFormat('d/m/Y', $request->booking_date)->toDateString();
            $op->rsp_booking_slot = $request->rsp_booking_slot;
            $op->venue_arrival_time = $request->venue_arrival_time;
            $op->bookings_slots_all = intval($request->bookings_slots_all);
            $op->bookings_slots_cat = intval($request->bookings_slots_cat);
            $op->available_slots = $request->available_slots;
            $op->used_slots = $request->used_slots;
            $op->bookings_slots_cat = $request->bookings_slots_cat;
            $op->slot_visibility = Carbon::createFromFormat('d/m/Y', $request->slot_visibility)->toDateString();
            $op->rsp_id = $request->rsp_id;
            $op->match_day = $request->match_day;
            $op->comments = $request->comments;
            $op->created_by = $user_id;
            $op->updated_by = $user_id;

            $op->save();
        }

        $notification = array(
            'message'       => 'Schedule created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function delete($id)
    {
        $ws = BookingSlot::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'Schedule deleted succesfully.';

        $notification = array(
            'message'       => 'Schedule deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

    public function getScheduleView($id)
    {
        $schedule = BookingSlot::find($id);
        $events = MdsEvent::all();
        $venues = DeliveryVenue::all();
        $rsps = DeliveryRsp::all();
        $global_yn = GlobalYN::all();

        $view = view('/mds/setting/schedule/mv/edit', [
            'schedule' => $schedule,
            'venues' => $venues,
            'rsps' => $rsps,
            'events' => $events,
            'globalYn' => $global_yn,
        ])->render();

        return response()->json(['view' => $view]);
    }  // End function getProjectView

}

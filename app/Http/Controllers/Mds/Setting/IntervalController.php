<?php

namespace App\Http\Controllers\Mds\Setting;

use App\Http\Controllers\Controller;
use App\Models\Mds\DeliveryRsp;
use App\Models\Mds\DeliverySchedule;
use App\Models\Mds\DeliverySchedulePeriod;
use App\Models\Mds\DeliveryVenue;
use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class IntervalController extends Controller
{
    //
    public function manage($id)
    {
        $schedule = DeliverySchedule::findOrFail($id);
        $intervals = DeliverySchedulePeriod::all();
        $venues = DeliveryVenue::all();
        $rsps = DeliveryRsp::all();

        return view('mds.setting.interval.manage', compact('schedule','intervals', 'venues', 'rsps'));
    }

    public function index()
    {
        $intervals = DeliverySchedulePeriod::all();
        $venues = DeliveryVenue::all();
        $rsps = DeliveryRsp::all();

        return view('mds.setting.interval.list', compact('intervals', 'venues', 'rsps'));
    }

    public function get($id)
    {
        $venue = DeliverySchedulePeriod::findOrFail($id);
        return response()->json(['venue' => $venue]);
    }

    public function update(Request $request)
    {

        $user_id = Auth::user()->id;
        $venue = DeliverySchedulePeriod::findOrFail($request->id);

        $rules = [
            'delivery_schedule_id' => 'required',
            'period_date' => 'required',
            'period' => 'required',
            'max_slots' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = 'Timeslot could not be updated';
        } else {

            $venue->period_date = Carbon::createFromFormat('d/m/Y', $request->period_date)->toDateString();
            $venue->period = $request->period;
            $venue->max_slots = $request->max_slots;
            $venue->used_slots = $request->used_slots;
            $venue->available_slots = $request->available_slots;
            $venue->active_flag = $request->active_flag;
            $venue->updated_by = $user_id;


            if ($venue->save()) {
                return response()->json(['error' => false, 'message' => 'Timeslot updated successfully.', 'id' => $venue->id]);
            } else {
                return response()->json(['error' => true, 'message' => 'Timeslot couldn\'t updated.']);
            }
        }
    }

    public function list($id)
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $venue = DeliverySchedulePeriod::where('delivery_schedule_id',$id)->orderBy($sort, $order);

        if ($search) {
            $venue = $venue->where(function ($query) use ($search) {
                $query->where('date', 'like', '%' . $search . '%')
                    ->orWhere('period', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $venue->count();
        $venue = $venue->paginate(request("limit"))->through(function ($venue) {

        // $location = Location::find($venue->location_id);

            return  [
                'id' => $venue->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-8 ps-2">' .$venue->id. '</div>',
                'period_date' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' . format_date($venue->period_date) . '</div>',
                'venue' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' . $venue->venue->title . '</div>',
                'period' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' .  $venue->period . '</div>',
                'max_slots' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' . $venue->max_slots . '</div>',
                'used_slots' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' . $venue->used_slots . '</div>',
                'available_slots' => '<div class="align-middle white-space-wrap fw-bold fs-9 ps-2">' . $venue->available_slots . '</div>',
                'created_at' => format_date($venue->created_at,  'H:i:s'),
                'updated_at' => format_date($venue->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $venue->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $venue = new DeliverySchedulePeriod();

        $rules = [
            'delivery_schedule_id' => 'required',
            'period_date' => 'required',
            'period' => 'required',
            'max_slots' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
        } else {

            $error = false;
            $message = 'Timeslot created succesfully.' . $venue->id;

            $venue->delivery_schedule_id = $request->delivery_schedule_id;
            $venue->period_date = Carbon::createFromFormat('d/m/Y', $request->period_date)->toDateString();
            $venue->period = $request->period;
            $venue->venue_id = $request->venue_id;
            $venue->max_slots = $request->max_slots;
            $venue->used_slots = 0;
            $venue->available_slots = $request->max_slots;
            $venue->active_flag = $request->active_flag;
            $venue->created_by = $user_id;
            $venue->updated_by = $user_id;
            $venue->active_flag = 1;

            $venue->save();

        }

        $notification = array(
            'message'       => 'Timeslot created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);

    }

    public function delete($id)
    {
        $ws = DeliverySchedulePeriod::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'Timeslot deleted succesfully.';

        $notification = array(
            'message'       => 'Timeslot deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}

<?php

namespace App\Http\Controllers\Mds\Setting;

use App\Http\Controllers\Controller;
use App\Models\Mds\DeliveryBookingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookingStatusController extends Controller
{
    //
    public function index()
    {
        $statuses = DeliveryBookingStatus::all();
        return view('mds.setting.status.booking.list', compact('statuses'));
    }

    public function get($id)
    {
        $status = DeliveryBookingStatus::findOrFail($id);
        return response()->json(['status' => $status]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'id' => ['required'],
            'title' => 'required',
            'color' => 'required',
        ]);

        $status = DeliveryBookingStatus::findOrFail($request->id);

        // dd($status);

        if ($status->update($formFields)) {
            return response()->json(['error' => false, 'message' => 'Booking Status updated successfully.']);
        } else {
            return response()->json(['error' => true, 'message' => 'Booking Status couldn\'t be updated.']);
        }
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $status = DeliveryBookingStatus::orderBy($sort, $order);

        if ($search) {
            $venue = $status->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $status->count();
        $status = $status->paginate(request("limit"))->through(function ($status) {

            // $location = Location::find($status->location_id);

            return  [
                'id' => $status->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-8 ps-2">' .$status->id. '</div>',
                'title' => '<div class="align-middle white-space-wrap fs-9 ps-3">' . $status->title . '</div>',
                'color' => '<span class="badge badge-phoenix ms-3 badge-phoenix-' . $status->color . '">' . $status->title . '</span>',
                'created_at' => format_date($status->created_at,  'H:i:s'),
                'updated_at' => format_date($status->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $status->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $status = new DeliveryBookingStatus();

        $rules = [
            'title' => 'required',
            'color' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
        } else {

            $error = false;
            $message = 'Booking Status created succesfully.' . $status->id;

            $status->title = $request->title;
            $status->color = $request->color;
            $status->created_at = $user_id;
            $status->updated_at = $user_id;
            $status->active_flag = 1;

            $status->save();
        }

        $notification = array(
            'message'       => 'Booking Status created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
    }

    public function delete($id)
    {
        $ws = DeliveryBookingStatus::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'Booking Status deleted succesfully.';

        $notification = array(
            'message'       => 'Booking Status deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}

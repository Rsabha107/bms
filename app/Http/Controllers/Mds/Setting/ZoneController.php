<?php

namespace App\Http\Controllers\Mds\Setting;

use App\Http\Controllers\Controller;
use App\Models\Mds\DeliveryVenue;
use App\Models\Mds\DeliveryZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class ZoneController extends Controller
{
    //
    public function index()
    {
        $zones = DeliveryZone::all();
        $zones = DeliveryVenue::all();
        return view('mds.setting.zone.list', compact('zones', 'zones'));
    }

    public function get($id)
    {
        $zone = DeliveryZone::findOrFail($id);
        return response()->json(['zone' => $zone]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'id' => ['required'],
            'title' => ['required'],
            // 'venue_id' => ['required'],
        ]);

        $zone = DeliveryZone::findOrFail($request->id);

        // dd($venue);

        if ($zone->update($formFields)) {
            return response()->json(['error' => false, 'message' => 'Zone updated successfully.', 'id' => $zone->id]);
        } else {
            return response()->json(['error' => true, 'message' => 'Zone couldn\'t updated.']);
        }
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $op = DeliveryZone::orderBy($sort, $order);

        if ($search) {
            $op = $op->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $op->count();
        $op = $op->paginate(request("limit"))->through(function ($op) {

        // $location = Location::find($op->location_id);

            return  [
                'id' => $op->id,
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-8 ps-2">' .$op->id. '</div>',
                'title' => '<div class="align-middle white-space-wrap fs-9 ps-3">' . $op->title . '</div>',
                'venue' => '<div class="align-middle white-space-wrap fs-9 ps-3">' . $op->venue?->title . '</div>',
                'created_at' => format_date($op->created_at,  'H:i:s'),
                'updated_at' => format_date($op->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $op->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $zone = new DeliveryZone();

        $rules = [
            'title' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = 'Zone could not be created';
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
        } else {

            $error = false;
            $message = 'Zone created succesfully.' . $zone->id;

            $zone->title = $request->title;
            $zone->created_by = $user_id;
            $zone->updated_by = $user_id;
            $zone->active_flag = 1;

            $zone->save();


        }

        $notification = array(
            'message'       => 'Zone created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);

    }

    public function delete($id)
    {
        $zone = DeliveryZone::findOrFail($id);
        $zone->delete();

        $error = false;
        $message = 'Zone deleted succesfully.';

        $notification = array(
            'message'       => 'Zone deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}

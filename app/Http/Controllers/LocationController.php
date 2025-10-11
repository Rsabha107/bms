<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class LocationController extends Controller
{
    //
    public function index()
    {
        $locations = Location::all();
        $venues = Venue::all();
        return view('tracki.setup.location.list', compact('locations', 'venues'));
    }

    public function get($id)
    {
        $location = Location::findOrFail($id);
        return response()->json(['location' => $location]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
        ]);

        $location = Location::findOrFail($request->id);

        // dd($location);

        if ($location->update($formFields)) {
            return response()->json(['error' => false, 'message' => 'Location updated successfully.', 'id' => $location->id]);
        } else {
            return response()->json(['error' => true, 'message' => 'Location couldn\'t updated.']);
        }
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $location = Location::orderBy($sort, $order);

        if ($search) {
            $location = $location->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $location->count();
        $location = $location->paginate(request("limit"))->through(function ($location) {


            return  [
                'id' => $location->id,
                'name' => $location->name,
                'created_at' => format_date($location->created_at,  'H:i:s'),
                'updated_at' => format_date($location->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $location->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $location = new Location();

        $rules = [
            'name' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = 'Location could not be created';
        } else {

            $error = false;
            $message = 'Location created succesfully.' . $location->id;

            $location->name = $request->name;
            $location->creator_id = $user_id;
            $location->active_flag = 1;

            $location->save();


        }

        $notification = array(
            'message'       => 'Location created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);

    }

    public function delete($id)
    {
        $ws = Location::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'Location deleted succesfully.';

        $notification = array(
            'message'       => 'Location deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}

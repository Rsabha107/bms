<?php

namespace App\Http\Controllers\Bbs\Setting;

use App\Http\Controllers\Controller;
use App\Models\Bbs\FunctionalArea;
use App\Models\Mds\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class FunctionalAreaController extends Controller
{
    //
    public function index()
    {
        $funcareas = FunctionalArea::all();
        $venues = Venue::all();
        return view('bbs.setting.funcareas.list', compact('venues', 'funcareas'));
    }

    public function get($id)
    {
        $funcarea = FunctionalArea::findOrFail($id);
        return response()->json(['funcarea' => $funcarea]);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'id' => ['required'],
            'title' => ['required'],
            'venue_id' => 'nullable',
        ]);

        $funcarea = FunctionalArea::findOrFail($request->id);

        // dd($funcarea);

        if ($funcarea->update($formFields)) {
            return response()->json(['error' => false, 'message' => 'Functional Area updated successfully.', 'id' => $funcarea->id]);
        } else {
            return response()->json(['error' => true, 'message' => 'Functional Area couldn\'t updated.']);
        }
    }

    public function list()
    {
        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $funcarea = FunctionalArea::orderBy($sort, $order);

        if ($search) {
            $funcarea = $funcarea->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        }
        $total = $funcarea->count();
        $funcarea = $funcarea->paginate(request("limit"))->through(function ($funcarea) {

        // $location = Location::find($funcarea->location_id);

            return  [
                'id' => $funcarea->id,
                'title' => '<div class="align-middle white-space-wrap fs-9 ps-3">' . $funcarea->title . '</div>',
                'created_at' => format_date($funcarea->created_at,  'H:i:s'),
                'updated_at' => format_date($funcarea->updated_at, 'H:i:s'),
            ];
        });

        return response()->json([
            "rows" => $funcarea->items(),
            "total" => $total,
        ]);
    }

    public function store(Request $request)
    {
        //
        // dd($request);
        $user_id = Auth::user()->id;
        $funcarea = new FunctionalArea();

        $rules = [
            'title' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::info($validator->errors());
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
        } else {

            $error = false;
            $message = 'Functional Area created succesfully.' . $funcarea->id;

            $funcarea->title = $request->title;
            $funcarea->venue_id = $request->venue_id;
            $funcarea->creator_id = $user_id;
            $funcarea->active_flag = 1;

            $funcarea->save();


        }

        $notification = array(
            'message'       => 'Functional Area created successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);

    }

    public function delete($id)
    {
        $ws = FunctionalArea::findOrFail($id);
        $ws->delete();

        $error = false;
        $message = 'Functional Area deleted succesfully.';

        $notification = array(
            'message'       => 'Functional Area deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

}

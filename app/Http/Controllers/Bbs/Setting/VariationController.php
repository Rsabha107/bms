<?php

namespace App\Http\Controllers\Bbs\Setting;

use App\Http\Controllers\Controller;
use App\Models\Bbs\BroadcastService;
use App\Models\Bbs\Matches;
use App\Models\Vapp\DeliveryRsp;
use App\Models\Bbs\Venue;
use App\Models\Vapp\VappVariation;
use App\Models\Bbs\Event;
use App\Models\Bbs\ServiceVariation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

// use Illuminate\Support\Facades\Redirect;

class VariationController extends Controller
{
    //
    public function index()
    {
        $events = Event::all();
        $venues = Venue::all();
        $matchs = Matches::all()->sortBy('match_code');
        $services = BroadcastService::all();

        return view('bbs.setting.variation.list', [
            'events' => $events,
            'venues' => $venues,
            'services' => $services,
        ]);
    }

    public function get($id)
    {
        $variation = ServiceVariation::findOrFail($id);

        $venues = $variation->venues;

        // get the parking master with functional areas
        return response()->json([
            'variation' => $variation,
            'venues' => $venues,
        ]);
    }

    public function get_variation_info(Request $request)
    {
        Log::info('Inside VariationController::get_variation_info');
        Log::info('Request Data: ' . json_encode($request->all()));
        $variation = ServiceVariation::where('service_id', $request->service_id)
            ->where('event_id', session()->get('EVENT_ID'))
            ->whereIn('id', function ($query) use ($request) {
                $query->select('service_variation_id')
                    ->from('service_variation_venue')
                    ->where('venue_id', $request->venue_id);
            })
            ->first();
        // $venues = $variation->venues;
        // $matchs = $variation->matchs;

        return response()->json([
            'variation' => $variation,
            // 'venues' => $venues,
            // 'matchs' => $matchs,
        ]);
    }

    public function get_inventory_variation_info($id)
    {
        $variation = VappVariation::findOrFail($id);
        $funcitonal_areas = $variation->functional_areas;
        $vapp_sizes = $variation->vapp_sizes()->select('vapp_sizes.id', 'vapp_sizes.title')->get();
        $venues = $variation->venues;
        $matchs = $variation->matchs;

        return response()->json([
            'variation' => $variation,
            'functional_areas' => $funcitonal_areas,
            'vapp_sizes' => $vapp_sizes,
            'venues' => $venues,
            'matchs' => $matchs,
        ]);
    }

    public function list()
    {
        appLog('inside Admin VariationController::list');

        $search = request('search');
        $sort = (request('sort')) ? request('sort') : "id";
        $order = (request('order')) ? request('order') : "DESC";
        $mds_schedule_event_filter = (request()->mds_schedule_event_filter) ? request()->mds_schedule_event_filter : "";
        $mds_schedule_venue_filter = (request()->mds_schedule_venue_filter) ? request()->mds_schedule_venue_filter : "";
        $mds_schedule_rsp_filter = (request()->mds_schedule_rsp_filter) ? request()->mds_schedule_rsp_filter : "";
        $mds_date_range_filter = (request()->mds_date_range_filter) ? request()->mds_date_range_filter : "";


        $ops = ServiceVariation::orderBy($sort, $order);
        $ops = $ops->where('event_id', session()->get('EVENT_ID'));

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
            appLog('mds_date_range_filter: ' . $mds_date_range_filter);
            appLog('dates: ' . count($dates));
            $startDate = trim($dates[0]);
            appLog($dates . length);
            if (count($dates) > 1) {
                $endDate = trim($dates[1]);
            } else {
                $endDate = null;
            }
            appLog('startDate: ' . $startDate);
            appLog('endDate: ' . $endDate);
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
        $limit = request("limit");
        $limit = max(1, min($limit, 100)); // min=1, max=100
        $ops = $ops->paginate($limit)->through(function ($op) {
            // $ops = $ops->paginate(request("limit"))->through(function ($op) {

            $div_action = '<div class="font-sans-serif btn-reveal-trigger position-static">';

            $update_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="edit_service_variation_offcanv" data-id=' . $op->id .
                ' data-table="service_variation_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Update">' .
                '<i class="fa-solid fa-pen-to-square text-primary"></i></a>';
            $duplicate_action =
                '<a href="javascript:void(0)" class="btn btn-sm" id="duplicate_employee" data-action="update" data-type="duplicate" data-id=' .
                $op->id .
                ' data-table="service_variation_table" data-bs-toggle="tooltip" data-bs-placement="right" title="Duplicate">' .
                '<i class="fa-solid fa-copy text-success"></i></a>';
            $delete_action =
                '<a href="javascript:void(0)" class="btn btn-sm" data-table="service_variation_table" data-id="' .
                $op->id .
                '" id="delete_parking_variation" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete">' .
                '<i class="fa-solid fa-trash text-danger"></i></a></div></div>';


            $venue_display = '';
            foreach ($op->venues as $venue) {
                $venue_display .= '<div class="white-space-wrap"><span class="badge badge-pill bg-body-tertiary text-black">' . $venue->title . '</span></div> ';
            }


            // $match_display = '';
            // foreach ($op->matchs as $match) {
            //     $match_display .= '<span class="badge badge-pill bg-body-tertiary text-black">' . $match->match_code . '</span> ';
            // }

            $actions = $div_action . $update_action . $delete_action;

            return  [
                // 'id' => $op->id,
                'id' => '<div class="align-middle white-space-wrap fs-9 ps-2">VAR-' . $op->id . '</div>',
                // 'id' => '<div class="align-middle white-space-wrap fw-bold fs-8 ps-2">' .$venue->id. '</div>',
                'event' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->event?->name . '</div>',
                'service_title' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->service->title . '</div>',
                'venue' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $venue_display . '</div>',
                'max_slots' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->max_slots . '</div>',
                'limit_slots' => '<div class="align-middle white-space-wrap fs-9 ps-2">' . $op->limit_slots . '</div>',
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
        $user = Auth::user();
        $op = new ServiceVariation();

        $rules = [
            // Unique combination rule
            'service_id' => [
                'required',
                Rule::unique('service_variations')
                    ->where(function ($query) use ($request) {
                        return $query->where('event_id', $request->event_id)
                            ->where('venue_id', $request->venue_id);
                    }),
            ],
            'event_id' => 'required',
            'venue_id' => 'required',
            // 'venue_id' => 'required_if:match_category_id,' . getMatchCategoryIdByLabel('ALL'),
            'max_slots' => 'required',
            'limit_slots' => 'required',
        ];

        $messages = [
            'service_id.required'   => 'Please select a service.',
            'event_id.required'     => 'Please select an event.',
            'venue_id.required'     => 'Please select a venue.',
            'max_slots.required'    => 'Please enter the maximum slots.',
            'limit_slots.required'  => 'Please enter the limit slots.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
            return response()->json(['error' => $error, 'message' => $message]);
        }

        DB::beginTransaction();
        try {
            $error = false;
            $message = 'Service Variation created succesfully.' . $op->id;

            $op->event_id = session()->get('EVENT_ID');
            // $op->event_id = $request->event_id;
            $op->service_id = $request->service_id;
            $op->max_slots = $request->max_slots;
            $op->limit_slots = $request->limit_slots;
            $op->created_by = $user->id;
            $op->updated_by = $user->id;

            $op->save();

            // if ($request->match_id) {
            //     foreach ($request->match_id as $key => $data) {
            //         $op->matchs()->attach($request->match_id[$key]);
            //     }
            // }
            if ($request->venue_id) {
                foreach ($request->venue_id as $key => $data) {
                    $op->venues()->attach($request->venue_id[$key]);
                }
            }

            DB::commit();
            return response()->json(['error' => $error, 'message' => $message]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating Service Variation: ' . $e->getMessage());
            $error = true;
            $message = 'An error occurred while creating the Service Variation. Please try again.';
            return response()->json(['error' => $error, 'message' => $message]);
        }
    }

    // public function inventory_store(Request $request)
    // {
    //     //
    //     // dd($request);
    //     $user_id = Auth::user()->id;
    //     $op = new VappInventory();

    //     $rules = [
    //         'parking_id' => 'required',
    //         'event_id' => 'required',
    //         'venue_id' => 'required',
    //         'match_category_id' => 'required',
    //         'variation_id' => 'required',
    //         'vapp_size_id' => 'required',
    //         'total_vaps' => 'required|numeric|min:0',
    //         'printed_vaps' => 'required|numeric|min:0',
    //         'parking_id' => [
    //             Rule::unique('vapp_inventories')->where(function ($query) use ($request) {
    //                 return $query->where('parking_id', $request->parking_id)
    //                     ->where('event_id', $request->event_id)
    //                     ->where('venue_id', $request->event_id)
    //                     ->where('variation_id', $request->variation_id)
    //                     ->where('match_category_id', $request->match_category_id)
    //                     ->where('vapp_size_id', $request->vapp_size_id);
    //             }),
    //         ],
    //     ];

    //     $message = ['parking_id.unique' => 'This VAPP Inventory already exists for this Parking, Event, Variation and VAPP Size.'];
    //     $validator = Validator::make($request->all(), $rules, $message);

    //     if ($validator->fails()) {
    //         $error = true;
    //         $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
    //     } else {

    //         $error = false;
    //         $message = 'VAPP Inventroy created succesfully.' . $op->id;

    //         $op->event_id = $request->event_id;
    //         $op->venue_id = $request->venue_id;
    //         $op->parking_id = $request->parking_id;
    //         $op->variation_id = $request->variation_id;
    //         $op->match_category_id = $request->match_category_id;
    //         $op->match_id = intval($request->match_id);
    //         $op->vapp_size_id = $request->vapp_size_id;
    //         $op->total_vaps = $request->total_vaps;
    //         $op->printed_vaps = $request->printed_vaps;
    //         $op->active_flag = 1;
    //         // $op->match_id = $request->match_id;
    //         $op->created_by = $user_id;
    //         $op->updated_by = $user_id;

    //         $op->save();
    //     }

    //     $notification = array(
    //         'message'       => 'Parking created successfully',
    //         'alert-type'    => 'success'
    //     );

    //     return response()->json(['error' => $error, 'message' => $message]);
    // }

    public function update(Request $request)
    {
        //
        // dd($request);
        $user = Auth::user();
        $op = ServiceVariation::find($request->id);

        $rules = [
            'service_id'       => [
                'required',
                Rule::unique('service_variations')
                    ->where(function ($query) use ($request) {
                        return $query->where('event_id', $request->event_id)
                            ->where('venue_id', $request->venue_id);
                    })
                    ->ignore($request->id), // 👈 Ignore the current record ID
            ],
            'event_id' => 'required',
            'venue_id' => 'required',
            // 'venue_id' => 'required_if:match_category_id,' . getMatchCategoryIdByLabel('ALL'),
            'max_slots' => 'required',
            'limit_slots' => 'required',
        ];

        $messages = [
            'service_id.required'   => 'Please select a service.',
            'event_id.required'     => 'Please select an event.',
            'venue_id.required_if'  => 'A venue is required when match category is ALL.',
            'max_slots.required'    => 'Please enter the maximum slots.',
            'limit_slots.required'  => 'Please enter the limit slots.',
            'service_id.unique' => 'This service is already assigned to the selected event and venue.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $error = true;
            $message = implode($validator->errors()->all('<div>:message</div>'));  // use this for json/jquery
            return response()->json(['error' => $error, 'message' => $message]);
        }
        DB::beginTransaction();
        try {
            $error = false;
            $message = 'Service Variation updated succesfully.' . $op->id;

            $op->event_id = $request->event_id;
            $op->service_id = $request->service_id;
            $op->max_slots = $request->max_slots;
            $op->limit_slots = $request->limit_slots;
            $op->updated_by = $user->id;

            $op->save();

            $op->venues()->detach();
            // $op->matchs()->detach();


            if ($request->venue_id) {
                foreach ($request->venue_id as $key => $data) {
                    $op->venues()->attach($request->venue_id[$key]);
                }
            }

            DB::commit();
            return response()->json(['error' => $error, 'message' => $message]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating Service Variation: ' . $e->getMessage());
            $error = true;
            $message = 'An error occurred while updating the Service Variation. Please try again.';
            return response()->json(['error' => $error, 'message' => $message]);
        }
    }

    public function delete($id)
    {
        $ws = VappVariation::findOrFail($id);
        $ws->delete();

        if ($ws->functional_areas) {
            $ws->functional_areas()->detach();
        }
        if ($ws->vapp_sizes) {
            $ws->vapp_sizes()->detach();
        }
        $error = false;
        $message = 'Parking deleted succesfully.';

        $notification = array(
            'message'       => 'Parking deleted successfully',
            'alert-type'    => 'success'
        );

        return response()->json(['error' => $error, 'message' => $message]);
        // return redirect()->route('tracki.setup.workspace')->with($notification);
    } // delete

    public function getView($id)
    {
        $variation = VappVariation::find($id);
        $events = Event::all();
        $parkings = ParkingMaster::all();
        $venues = Venue::all();
        $matchs = MatchList::all();
        $vapp_sizes = VappSize::all();

        $view = view('/vapp/setting/variation/mv/edit', [
            'variation' => $variation,
            'venues' => $venues,
            'matchs' => $matchs,
            'events' => $events,
            'vappSizes' => $vapp_sizes,
            'parkings' => $parkings,
        ])->render();

        return response()->json(['view' => $view]);
    }  // End function getProjectView

    public function getAssicatedFunctionalAreas($id)
    {
        $parkingMaster = ParkingMaster::with('functional_areas')
            ->with('vapp_sizes')->find($id);
        // $functional_areas = $parkingMaster->functional_areas;

        return response()->json([
            'functional_areas' => $parkingMaster->functional_areas,
            'vapp_sizes' => $parkingMaster->vapp_sizes,
        ]);
        // return response()->json(['associated_fa' => $functional_areas]);
    }  // End function getAssicatedFunctionalAreas

    public function getParkingCodeFromEvent($id)
    {
        $parkingMaster = ParkingMaster::where('event_id', $id)->get();
        // $functional_areas = $parkingMaster->functional_areas;

        return response()->json([
            'parkings' => $parkingMaster,
            // 'vapp_sizes' => $parkingMaster->vapp_sizes,
        ]);
        // return response()->json(['associated_fa' => $functional_areas]);
    }  // End function getParkingCodeFromEvent


}

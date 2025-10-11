<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\EventCategory;
use App\Models\Audience;
use App\Models\BudgetName;
use App\Models\Planner;
use App\Models\Location;
use App\Models\Venue;
use App\Models\ProjectType;
use App\Models\Department;
use App\Models\Person;
use App\Models\Color;
use App\Models\EventStatus;
use App\Models\FunctionalArea;
use App\Models\Operation;
use App\Models\FundCategory;
use App\Models\GlobalStatus;
use App\Models\Segment;
use App\Models\TaskStatus;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;


class SetupController extends Controller
{

    // ***********************************************Category *********************************************************************
    public function catEvent()
    {
        $dataDetails = EventCategory::all();

        return view('tracki.setup.category-list', compact('dataDetails'));
    }

    public function createEventCategory(Request $request)
    {
        // dd('mainEvent');
        $op = new EventCategory;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Category created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.category')->with($notification);
    } // saveEvent

    public function editCategory($id)
    {
        // dd('mainEvent');
        $data = EventCategory::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];


        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editCategory


    public function updateEventCategory(Request $request)
    {
        //  dd('id:'.$request->id);
        EventCategory::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Category updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.category')->with($notification);
        // return view('');

    } // updateEvent



    public function deleteCategory($id)
    {
        // dd('mainEvent');
        EventCategory::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Category deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.category')->with($notification);
    } // saveEvent


    // *********************************************** Audience *********************************************************************
    public function eventAudience()
    {
        $dataDetails = Audience::all();

        return view('tracki.setup.audience-list', compact('dataDetails'));
    }

    public function createAudience(Request $request)
    {
        // dd('mainEvent');
        $op = new Audience;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Audience created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.audience')->with($notification);
    } // saveEvent

    public function editAudience($id)
    {
        // dd('mainEvent');
        $data = Audience::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];


        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editaudience


    public function updateAudience(Request $request)
    {
        //  dd('id:'.$request->id);
        Audience::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Audience updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.audience')->with($notification);
        // return view('');

    }



    public function deleteAudience($id)
    {
        // dd('mainEvent');
        Audience::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Audience deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.audience')->with($notification);
    }


    // *********************************************** Planner *********************************************************************
    public function eventPlanner()
    {
        $dataDetails = Planner::all();

        return view('tracki.setup.planner-list', compact('dataDetails'));
    }

    public function createPlanner(Request $request)
    {
        // dd('mainEvent');
        $op = new Planner;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Planner created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.planner')->with($notification);
    } // saveEvent

    public function editPlanner($id)
    {
        // dd('mainEvent');
        $data = Planner::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];


        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editplanner


    public function updatePlanner(Request $request)
    {
        //  dd('id:'.$request->id);
        Planner::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Planner updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.planner')->with($notification);
        // return view('');

    }



    public function deletePlanner($id)
    {
        // dd('mainEvent');
        Planner::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Planner deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.planner')->with($notification);
    }

    // *********************************************** Venue *********************************************************************
    public function eventVenue()
    {
        $dataDetails = Venue::all();

        return view('tracki.setup.venue-list', compact('dataDetails'));
    }

    public function createVenue(Request $request)
    {
        // dd('mainEvent');
        $op = new Venue;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Venue created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.venue')->with($notification);
    } // saveEvent

    public function editVenue($id)
    {
        // dd('mainEvent');
        $data = Venue::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];


        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editvenue


    public function updateVenue(Request $request)
    {
        //  dd('id:'.$request->id);
        Venue::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Venue updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.venue')->with($notification);
        // return view('');

    }



    public function deleteVenue($id)
    {
        //  dd('deletVenue');
        Venue::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Venue deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.venue')->with($notification);
    }

    // *********************************************** Venue *********************************************************************
    public function projectType()
    {
        $dataDetails = ProjectType::all();

        return view('tracki.setup.projecttype-list', compact('dataDetails'));
    }

    public function createProjectType(Request $request)
    {
        // dd('mainEvent');
        $op = new ProjectType;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Project Type created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.projecttype')->with($notification);
    } // saveEvent

    public function editProjectType($id)
    {
        // dd('mainEvent');
        $data = ProjectType::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];


        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editvenue


    public function updateProjectType(Request $request)
    {
        //  dd('id:'.$request->id);
        ProjectType::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Project Type updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.projecttype')->with($notification);
        // return view('');

    }



    public function deleteProjectType($id)
    {
        //  dd('deletVenue');
        ProjectType::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Project Type deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.projecttype')->with($notification);
    }

    // *********************************************** Location *********************************************************************
    public function eventLocation()
    {
        $dataDetails = Location::all();

        return view('tracki.setup.location-list', compact('dataDetails'));
    }

    public function createLocation(Request $request)
    {
        // dd('mainEvent');
        $op = new Location;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Location created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.location')->with($notification);
    } // saveEvent

    public function editLocation($id)
    {
        // dd('mainEvent');
        $data = Location::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];


        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editlocation


    public function updateLocation(Request $request)
    {
        //  dd('id:'.$request->id);
        Location::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Location updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.location')->with($notification);
        // return view('');

    }


    public function deleteLocation($id)
    {
        //  dd('deletLocation');
        Location::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Location deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.location')->with($notification);
    }

    // *********************************************** Event Status *********************************************************************
    public function eventStatus()
    {
        $dataDetails = EventStatus::all();

        return view('tracki.setup.eventstatus-list', compact('dataDetails'));
    }

    public function createEventStatus(Request $request)
    {
        // dd('mainEvent');
        $op = new EventStatus;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Status created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.eventstatus')->with($notification);
    } // saveEvent

    public function editEventStatus($id)
    {
        // dd('mainEvent');
        $data = EventStatus::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];


        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editlocation


    public function updateEventStatus(Request $request)
    {
        //  dd('id:'.$request->id);
        EventStatus::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Status updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.eventstatus')->with($notification);
        // return view('');

    }


    public function deleteEventStatus($id)
    {
        //  dd('deletLocation');
        EventStatus::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Status deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.eventstatus')->with($notification);
    }

    // *********************************************** Task Status *********************************************************************

    public function taskStatus()
    {
        $dataDetails = TaskStatus::all();

        return view('tracki.setup.taskstatus-list', compact('dataDetails'));
    }

    public function createTaskStatus(Request $request)
    {
        // dd('mainEvent');
        $op = new TaskStatus;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Status created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.taskstatus')->with($notification);
    } // saveEvent

    public function editTaskStatus($id)
    {
        // dd('mainEvent');
        $data = TaskStatus::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];


        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editlocation


    public function updateTaskStatus(Request $request)
    {
        //  dd('id:'.$request->id);
        TaskStatus::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Status updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.taskstatus')->with($notification);
        // return view('');

    }


    public function deleteTaskStatus($id)
    {
        //  dd('deletLocation');
        TaskStatus::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Status deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.taskstatus')->with($notification);
    }

    // *********************************************** Department *********************************************************************
    public function department()
    {
        $dataDetails = Department::all();

        return view('tracki.setup.department-list', compact('dataDetails'));
    }

    public function createDepartment(Request $request)
    {
        // dd('mainEvent');
        $op = new Department;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Department created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.department')->with($notification);
    } // saveEvent

    public function editDepartment($id)
    {
        // dd('mainEvent');
        $data = Department::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];

        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editlocation


    public function updateDepartment(Request $request)
    {
        //  dd('id:'.$request->id);
        Department::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Department updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.department')->with($notification);
        // return view('');

    }


    public function deleteDepartment($id)
    {
        //  dd('deletLocation');
        Department::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Department deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.department')->with($notification);
    }

    // *********************************************** Funcational Area *********************************************************************
    public function fa()
    {
        $dataDetails = FunctionalArea::all();

        return view('tracki.setup.fa-list', compact('dataDetails'));
    }

    public function addFA(){
        $fa = FunctionalArea::all();
        $budget_name = BudgetName::all();
        $active_flag = GlobalStatus::all();

        return view('tracki.setup.fa-add', compact('fa','budget_name','active_flag'));

    }

    public function createFA(Request $request)
    {
        // dd('mainEvent');
        $op = new FunctionalArea;

        $op->name = $request->name;
        // $op->budget_id = $request->budget_name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Functional Area created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.fa')->with($notification);
    } // saveEvent

    public function editFA($id)
    {
        // dd('mainEvent');
        $data = FunctionalArea::find($id);

        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];

        $response = ["retData"  => $data_arr];

        return response()->json($response);

    } // editFA

    public function editFAx($id)
    {
        // dd('mainEvent');
        $dataDetails = FunctionalArea::leftJoin('budget_name', 'budget_name.id', '=', 'functional_areas.budget_id')
        ->where('functional_areas.id', $id)
        ->get([
            'functional_areas.id',
            'functional_areas.name',
            'functional_areas.active_flag',
            'functional_areas.budget_id',
            'budget_name.name as budget_name'
        ]);

        // dd($dataDetails);
        $budget_name = BudgetName::all();
        $active_flag = GlobalStatus::all();

        return view('tracki.setup.fa-edit', compact('dataDetails','budget_name', 'active_flag'));

    } // editlocation

    public function updateFA(Request $request)
    {
        //  dd('id:'.$request->id);
        FunctionalArea::where('id', '=', $request->id)->update([
            'name' => $request->name,
            // 'budget_id' => $request->budget_name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Functional Area updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.fa')->with($notification);
        // return view('');

    }


    public function deleteFA($id)
    {
        //  dd('deletLocation');
        FunctionalArea::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Functional Area deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.fa')->with($notification);
    }

// *********************************************** User Types *********************************************************************
public function userType()
{
    $dataDetails = UserType::all();

    return view('tracki.setup.usertype-list', compact('dataDetails'));
}

public function createUserType(Request $request)
{
    // dd('mainEvent');
    $op = new UserType;

    $op->name = $request->name;
    // $op->budget_id = $request->budget_name;
    $op->active_flag = "1";

    $op->save();

    $notification = array(
        'message'       => 'User Type created successfully',
        'alert-type'    => 'success'
    );

    // Toastr::success('Has been add successfully :)','Success');
    return Redirect::route('tracki.setup.usertype')->with($notification);
} // saveEvent

public function editUserType($id)
{
    // dd('mainEvent');
    $data = UserType::find($id);

    $data_arr = [];

    $data_arr[] = [
        "id"      => $data->id,
        "name"    => $data->name,
        "active_flag"    => $data->active_flag,
    ];

    $response = ["retData"  => $data_arr];

    return response()->json($response);

} // editUserType

public function updateUserType(Request $request)
{
    //  dd('id:'.$request->id);
    UserType::where('id', '=', $request->id)->update([
        'name' => $request->name,
        // 'budget_id' => $request->budget_name,
        'active_flag' => $request->active_flag,
    ]);


    $notification = array(
        'message'       => 'User Type updated successfully',
        'alert-type'    => 'success'
    );

    // Toastr::success('Has been add successfully :)','Success');
    return Redirect::route('tracki.setup.usertype')->with($notification);
    // return view('');

}


public function deleteUserType($id)
{
    //  dd('deletLocation');
    FunctionalArea::where('id', '=', $id)->delete();

    $notification = array(
        'message'       => 'User Type deleted successfully',
        'alert-type'    => 'success'
    );

    // Toastr::success('Has been add successfully :)','Success');
    return Redirect::route('tracki.setup.usertype')->with($notification);
}

    // *********************************************** Operations *********************************************************************
    public function operation()
    {
        $dataDetails = Operation::all();

        return view('tracki.setup.operation-list', compact('dataDetails'));
    }

    public function createOperation(Request $request)
    {
        // dd('mainEvent');
        $op = new Operation;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Operation Type created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.operation')->with($notification);
    } // saveEvent

    public function editOperation($id)
    {
        // dd('mainEvent');
        $data = Operation::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];

        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editlocation


    public function updateOperation(Request $request)
    {
        //  dd('id:'.$request->id);
        Operation::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Operation Type updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.operation')->with($notification);
        // return view('');

    }


    public function deleteOperation($id)
    {
        //  dd('deletLocation');
        Operation::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Operation Type deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.operation')->with($notification);
    }

    // *********************************************** Budget Names *********************************************************************
    public function budget()
    {
        $dataDetails = BudgetName::all();

        return view('tracki.setup.budget-list', compact('dataDetails'));
    }

    public function createBudget(Request $request)
    {
        // dd('mainEvent');
        $op = new BudgetName;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Budget Type created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.budget')->with($notification);
    } // saveEvent

    public function editBudget($id)
    {
        // dd('mainEvent');
        $data = BudgetName::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];

        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editlocation


    public function updateBudget(Request $request)
    {
        //  dd('id:'.$request->id);
        BudgetName::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Budget Type updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.budget')->with($notification);
        // return view('');

    }


    public function deleteBudget($id)
    {
        //  dd('deletLocation');
        BudgetName::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Budget Type deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.budget')->with($notification);
    }

    // *********************************************** Segments *********************************************************************
    public function segment()
    {
        $dataDetails = Segment::all();

        return view('tracki.setup.segment-list', compact('dataDetails'));
    }

    public function createSegment(Request $request)
    {
        // dd('mainEvent');
        $op = new Segment;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Segment created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.segment')->with($notification);
    } // saveEvent

    public function editSegment($id)
    {
        // dd('mainEvent');
        $data = Segment::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];

        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editlocation


    public function updateSegment(Request $request)
    {
        //  dd('id:'.$request->id);
        Segment::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Segment updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.segment')->with($notification);
        // return view('');

    }


    public function deleteSegment($id)
    {
        //  dd('deletLocation');
        Segment::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Segment deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.segment')->with($notification);
    }


    // *********************************************** Fund Category *********************************************************************
    public function fundCategory()
    {
        $dataDetails = FundCategory::all();

        return view('tracki.setup.fundcategory-list', compact('dataDetails'));
    }

    public function createFundCategory(Request $request)
    {
        // dd('mainEvent');
        $op = new FundCategory();

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Fund Category created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.fundcategory')->with($notification);
    } // saveEvent

    public function editFundCategory($id)
    {
        // dd('mainEvent');
        $data = FundCategory::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];

        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editlocation


    public function updateFundCategory(Request $request)
    {
        //   dd('id:'.$request->id);
        FundCategory::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);

        $notification = array(
            'message'       => 'Fund Category updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.fundcategory')->with($notification);
        // return view('');
    }


    public function deleteFundCategory($id)
    {
        //  dd('deletLocation');
        FundCategory::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Fund Category deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.fundcategory')->with($notification);
    }

    // *********************************************** Person *********************************************************************
    public function person()
    {
        $dataDetails = Person::all();

        return view('tracki.setup.person-list', compact('dataDetails'));
    }

    public function createPerson(Request $request)
    {
        // dd('mainEvent');
        $op = new Person;

        $op->name = $request->name;
        $op->email_address = $request->email_address;
        $op->phone = $request->phone;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Person created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.person')->with($notification);
    } // saveEvent

    public function editPerson($id)
    {
        // dd('mainEvent');
        $data = Person::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"                => $data->id,
            "name"              => $data->name,
            "email_address"     => $data->email_address,
            "phone"             => $data->phone,
            "active_flag"       => $data->active_flag,
        ];


        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editlocation


    public function updatePerson(Request $request)
    {
        //  dd('id:'.$request->id);
        Person::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'email_address' => $request->email_address,
            'phone' => $request->phone,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Person updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.person')->with($notification);
        // return view('');

    }


    public function deletePerson($id)
    {
        //  dd('deletLocation');
        Person::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Person deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.person')->with($notification);
    }

    // *********************************************** Color *********************************************************************
    public function color()
    {
        $dataDetails = Color::all();

        return view('tracki.setup.color-list', compact('dataDetails'));
    }

    public function createColor(Request $request)
    {
        // dd('mainEvent');
        $op = new Color;

        $op->name = $request->name;
        $op->active_flag = "1";

        $op->save();

        $notification = array(
            'message'       => 'Color created successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.color')->with($notification);
    } // saveEvent

    public function editColor($id)
    {
        // dd('mainEvent');
        $data = Color::find($id);
        //dd($data);
        $data_arr = [];

        $data_arr[] = [
            "id"      => $data->id,
            "name"    => $data->name,
            "active_flag"    => $data->active_flag,
        ];


        $response = ["retData"  => $data_arr];

        return response()->json($response);
    } // editlocation


    public function updateColor(Request $request)
    {
        //  dd('id:'.$request->id);
        Color::where('id', '=', $request->id)->update([
            'name' => $request->name,
            'active_flag' => $request->active_flag,
        ]);


        $notification = array(
            'message'       => 'Color updated successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.color')->with($notification);
        // return view('');

    }


    public function deleteColor($id)
    {
        //  dd('deletLocation');
        Color::where('id', '=', $id)->delete();

        $notification = array(
            'message'       => 'Color deleted successfully',
            'alert-type'    => 'success'
        );

        // Toastr::success('Has been add successfully :)','Success');
        return Redirect::route('tracki.setup.color')->with($notification);
    }
}

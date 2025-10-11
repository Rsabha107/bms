<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Status;
use App\Models\Task;
use App\Models\Workspace;
use Illuminate\Http\Request;

class KanbanController extends Controller
{

    public function index($id){

        $task_statuses = Status::where('active_flag', '1')->get();
        // $user_workspace = Workspace::all();

        // $tasks = Task::findOrFail('13');

        if ($id) {
            $projects = Event::findOrFail($id);
            $tasks = Task::where('event_id', $id)
            ->get();
        }
        return view('tracki/kanban/list', [
            'task_statuses' => $task_statuses,
            'projects' => $projects,
            'tasks' => $tasks,
            // 'user_workspace' => $user_workspace,
        ]);

    }

    public function updateStatus($id, $newStatus)
    {
        $task = Task::findOrFail($id);
        // $current_status = $task->status->title;
        $task->status_id = $newStatus;
        $task->progress = 0;

        if ($newStatus == config('tracki.task_status.completed')) {
            $task->progress = 1;
            $task->status_id = config('tracki.task_status.completed');
        }

        if ($task->save()) {
            $task->refresh();
            // $new_status = $task->status->title;
            return response()->json(['error' => false, 'message' => 'Task status updated successfully.', 'id' => $id]);
        } else {
            return response()->json(['error' => true, 'message' => 'Task status couldn\'t updated.']);
        }
    }
}

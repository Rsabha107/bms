<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taskx;
use App\Models\Event;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskGanttController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Log::info('inside store');

        $task = new Taskx();

        $task->text = $request->text;
        $task->start_date = $request->start_date;
        $task->duration = $request->duration;
        $task->progress = $request->has("progress") ? $request->progress : 0;
        $task->parent = $request->parent;

        $task->save();

        return response()->json([
            "action"=> "inserted",
            "tid" => $task->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        Log::info('inside update: '.$request);

        if ($request->type == 'event'){
            Log::info('this is an event');
            $event = Event::find($id);
            $event->name = $request->text;
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->duration = $request->duration;
            $event->progress = $request->has("progress") ? $request->progress : 0;
            $event->parent = $request->parent;
            $event->save();
        }

        if ($request->type == 'task'){
            Log::info('this is an task');
            $task = Task::find($id);
            $task->name = $request->text;
            $task->start_date = $request->start_date;
            $task->due_date = $request->end_date;
            $task->duration = $request->duration;
            $task->progress = $request->has("progress") ? $request->progress : 0;
            $task->parent = $request->parent;
            $task->save();
        }
        // $task = Taskx::find($id);

        // $task->text = $request->text;
        // $task->start_date = $request->start_date;
        // $task->duration = $request->duration;
        // $task->progress = $request->has("progress") ? $request->progress : 0;
        // $task->parent = $request->parent;



        return response()->json([
            "action"=> "updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Log::info('inside destroy');

        $task = Taskx::find($id);
        $task->delete();

        return response()->json([
            "action"=> "deleted"
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('target_completion_date', 'desc')->paginate(5);

        return view('tasks.index')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'                   => 'required|string|max:255|min:3',
            'description'            => 'required|string|max:1000',
            'completion_date'        => 'nullable|date',
            'target_completion_date' => 'required|date',
        ]);

        $task = new Task;
        $task->name                   = $request->name;
        $task->description            = $request->description;
        $task->completion_date        = $request->completion_date;
        $task->target_completion_date = $request->target_completion_date;
        $task->save();

        Session::flash('success', 'Task Created');

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit')->withTask($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'                   => 'required|string|max:255|min:3',
            'description'            => 'required|string|max:1000',
            'completion_date'        => 'nullable|date',
            'target_completion_date' => 'required|date',
        ]);

        $task = Task::find($id);

        $task->name                   = $request->name;
        $task->description            = $request->description;
        $task->completion_date        = $request->completion_date;
        $task->target_completion_date = $request->target_completion_date;
        $task->save();

        Session::flash('success', 'Task Updated');

        return redirect()->route('task.edit', ['task' => $id]);
    }

    /**
     * Update the completion date of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_complete(Request $request, $id)
    {
        $task = Task::find($id);

        $today = Carbon::now();
        $task->completion_date = $today;
        $task->save();

        return response()->json([
            "success" => 'true',
            "completion_date" => $today
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        $task->delete();

        Session::flash('success', $task->name . " Task Deleted");

        return redirect()->route('task.index');
    }
}

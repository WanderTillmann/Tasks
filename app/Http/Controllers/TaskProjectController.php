<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskProjectController extends Controller
{
    public function attach(Task $task, Request $request)
    {
        $task->projects()->attach($request->project_id);
        return back()->with('success', 'Projeto relacionado a tarefa com sucesso');
    }

    public function detach(Task $task, $project_id)
    {
        $task->projects()->detach($project_id);
        return back()->with('success', 'Projeto desrelacionado a tarefa com sucesso');
    }
}

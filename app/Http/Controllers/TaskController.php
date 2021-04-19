<?php

namespace App\Http\Controllers;

use DB;
use App\Task;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskController extends Controller
{
    /**
     *
     *
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = $this->taskRepository->getAll();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Task $task)
    {
        return view('tasks.create', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = $this->taskRepository->create([
            'subject' => $request->subject,
            'made' => $request->made,
            'description' => $request->description,
        ]);

        if ($task) {
            $request->session()->flash('success', 'Task cadastrada com sucesso!');
        } else {
            $request->session()->flash('errror', 'Erro ao cadastrar a flash');
        }
        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projects = \App\Project::get();
        $task = $this->taskRepository->find($id);
        return view('tasks.show', compact('task', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('update-task', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Task $task)
    {
        $result = $this->taskRepository->update($id, [
            'subject' => $request->subject,
            'made' => $request->made,
            'description' => $request->description,
        ]);
        $this->authorize('update-task', $task);

        if ($result) {
            $request->session()->flash('sucess', 'Tarefa atualizada com sucesso');
        } else {
            $request->session()->flash('error', "erro ao atualizar a tarefa");
        }
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, Task $task)
    {
        $this->authorize('update-task', $task);

        $result =  $this->taskRepository->delete($id);
        if ($result) {
            $request->session()->flash('sucess', 'Tarefa Realizada com sucesso');
        } else {
            $request->session()->flash('error', 'Erro ao deletar a tarefa');
        }
        return redirect()->route('tasks.index');
    }
}

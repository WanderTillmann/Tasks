<?php

namespace App\Repositories\Implementations;

use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Task;
use App\Repositories\Base\EloquentRepository;

class EloquentTaskRepository extends EloquentRepository implements TaskRepositoryInterface
{

  /**
   *
   * @param Taskk $task
   */
    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    /**
     * Procura tarefa por assunto
     *
     * @param [type] $subject
     * @return void
     */
    public function getBySubject($subject)
    {
        $subject = '%' . $subject . '%';
        return $this->model->where('subject', 'like', $subject)->get();
    }

    /**
     * busca por ids dentro de um array
     *
     * @param array $ids
     * @return void
     */
    public function getByIds(array $ids)
    {
        return $this->model->where('id', $ids)->get();
    }
}

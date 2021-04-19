<?php

namespace App\Repositories\Implementations;

use App\Repositories\Base\QuerybuilderRepository;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TaskRepository extends QuerybuilderRepository implements TaskRepositoryInterface
{

  /**
   * Nome da tabela
   *
   * @var string
   */
    protected $table = 'tasks';

    /**
     * Procura tarefa por assunto
     *
     * @param [type] $subject
     * @return void
     */
    public function getBySubject($subject)
    {
        $subject = '%' . $subject . '%';
        return \DB::table($this->table)->where('subject', 'like', $subject)->get();
    }
}

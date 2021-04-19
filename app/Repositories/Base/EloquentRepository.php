<?php

namespace App\Repositories\Base;

use App\Repositories\Base\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * Instancia do model usado no repositorio
     */
    protected $model;

    public function getAll(int $page = 10)
    {
        return $this->model->paginate(10);
    }

    /**
     * retorna registro por id
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Cria um registro pelo array de dados
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * atualiza um registro no banco
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data)
    {
        $instance = $this->model->find($id);
    
        if (!$instance) {
            return false;
        }
        return $instance->update($data);
    }

    /**
     * Apaga um registro do banco de dados
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $instance = $this->model->find($id);
    
        if (!$instance) {
            return false;
        }

        return $instance->delete();
    }
}

<?php

namespace App\Repositories\Base;

use DB;

abstract class QuerybuilderRepository implements RepositoryInterface
{
    protected $table;

    /**
     * Retorna lista paginada
     *
     * @param integer $page
     * @return void
     */
    public function getAll(int $page = 10)
    {
        return DB::table($this->table)->paginate($page);
    }
    /**
 * Retorna registro por id
 *
 * @param integer $id
 * @return void
 */
    public function find(int $id)
    {
        return DB::table($this->table)->where('id', $id)->first();
    }

    /**
     * Cria um registro pelo array de dados
     */
    public function create(array $data)
    {
        return DB::table($this->table)->insert($data);
    }
  
    /**
     * atualiza registro por id
     *
     * @param integer $id
     * @param array $data
     * @return void
     */
    public function update($id, array $data)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }

    /**
     * deleta registro por id
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        return DB::table($this->table)->where('id', $id)->delete();
    }
}

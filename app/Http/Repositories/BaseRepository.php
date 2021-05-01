<?php
namespace App\Repositories;

abstract class BaseRepository implements BaseRepositoryContract
{
    /**
     * Returns all records
     * @param  array $fields
     *
     */
    public function all(array $fields = ['*'])
    {
        return $this->model->select($fields)->get();
    }

    /**
     * Creates a record
     *
     * @param  array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Get by id
     *
     * @param int $id
     * @param array $fields
     */
    public function getById(int $id, array $fields = ['*'])
    {
        return $this->model->select($fields)->find($id);
    }
}

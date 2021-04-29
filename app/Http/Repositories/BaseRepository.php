<?php
namespace App\Repositories;

abstract class BaseRepository implements BaseRepositoryContract
{
    /**
     * Returns all record
     *
     */
    public function all()
    {
        return $this->model->all();
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
}

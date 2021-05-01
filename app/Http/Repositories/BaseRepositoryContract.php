<?php
namespace App\Repositories;

interface BaseRepositoryContract
{
    /**
     * Returns all records
     * @param  array $fields
     *
     */
    public function all(array $fields = ['*']);

    /**
     * Creates a record
     *
     * @param  array $data
     */
    public function create(array $data);

    /**
     * Get by id
     *
     * @param int $id
     * @param array $fields
     */
    public function getById(int $id, array $fields = ['*']);
}

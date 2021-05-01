<?php

namespace App\Http\Services\Seller;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Collection;

interface SellerServiceContract
{
    /**
     * Get all sellers with the total value of their sales
     * @param  array $fiields
     *
     * @return Collection
     */
    public function getAllWithCommission(array $fiields = ['*']);

    /**
     * Get by id
     *
     * @param  int $sellerId
     * @return Seller
     */
    public function getById(int $sellerId);

    /**
     * Creates a seller
     *
     * @param  mixed $data
     * @return Seller
     */
    public function create($data);
}

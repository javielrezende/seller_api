<?php

namespace App\Http\Repositories\Seller;

use App\Repositories\BaseRepositoryContract;

interface SellerRepositoryContract extends BaseRepositoryContract
{
    /**
     * Get all sellers with the total value of their sales
     *
     * @param  mixed $fiields
     * @return void
     */
    public function getAllWithCommission(array $fiields = ['*']);
}

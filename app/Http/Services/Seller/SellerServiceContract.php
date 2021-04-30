<?php

namespace App\Http\Services\Seller;

use App\Models\Seller;

interface SellerServiceContract
{
    /**
     * Get by id
     *
     * @param  int $sellerId
     * @return Seller
     */
    public function getById(int $sellerId);
}

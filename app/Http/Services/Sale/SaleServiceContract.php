<?php

namespace App\Http\Services\Sale;

interface SaleServiceContract
{
    /**
     * Make a sale
     *
     * @param  mixed $data
     * @return Sale
     */
    public function sale($data);

    /**
     * Get sales by seller id
     *
     * @param  int $sellerId
     * @return Collection
     */
    public function getSalesBySellerId(int $sellerId);
}

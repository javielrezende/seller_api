<?php

namespace App\Http\Repositories\Sale;

use App\Repositories\BaseRepositoryContract;

interface SaleRepositoryContract extends BaseRepositoryContract
{
    /**
     * Get sales by seller id
     *
     * @param  int $sellerId
     * @param  array $fields
     * @return Collection
     */
    public function getSalesBySellerId(int $sellerId, array $fields = ['*']);

    /**
     * Get sales of the day
     *
     * @param  mixed $fields
     * @return Collection
     */
    public function getSalesReportOfTheDay(array $fields = ['*']);
}

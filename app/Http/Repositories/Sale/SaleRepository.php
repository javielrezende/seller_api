<?php

namespace App\Http\Repositories\Sale;

use App\Models\Sale;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class SaleRepository extends BaseRepository implements SaleRepositoryContract
{
    protected $model;

    public function __construct(Sale $model)
    {
        $this->model = $model;
    }

    /**
     * Get sales by seller id
     *
     * @param  int $sellerId
     * @param  array $fields
     * @return Collection
     */
    public function getSalesBySellerId(int $sellerId, array $fields = ['*'])
    {
        return $this->model->select($fields)
            ->with('seller')
            ->where('seller_id', $sellerId)
            ->get();
    }
}

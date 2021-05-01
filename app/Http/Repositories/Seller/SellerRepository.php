<?php

namespace App\Http\Repositories\Seller;

use App\Models\Seller;
use App\Repositories\BaseRepository;

class SellerRepository extends BaseRepository implements SellerRepositoryContract
{
    protected $model;

    /**
     * __construct
     *
     * @param  Seller $model
     */
    public function __construct(Seller $model)
    {
        $this->model = $model;
    }

    /**
     * Get all sellers with the total value of their sales
     *
     * @param  mixed $fiields
     * @return void
     */
    public function getAllWithCommission(array $fiields = ['*'])
    {
        return $this->model
            ->leftJoin('sales', 'sellers.id', '=', 'sales.seller_id')
            ->selectRaw('sellers.id, sellers.name, sellers.email, sum(sales.commission_paid) as total_commission')
            ->groupBy('sellers.id')
            ->orderBy('total_commission', 'desc')
            ->get();
    }
}

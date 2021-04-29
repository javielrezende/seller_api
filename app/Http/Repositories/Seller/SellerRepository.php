<?php

namespace App\Http\Repositories\Seller;

use App\Models\Seller;
use App\Repositories\BaseRepository;

class SellerRepository extends BaseRepository implements SellerRepositoryContract
{
    protected $model;

    public function __construct(Seller $model)
    {
        $this->model = $model;
    }
}

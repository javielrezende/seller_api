<?php

namespace App\Http\Services\Seller;

use App\Exceptions\SellerNotFoundException;
use App\Http\Repositories\Seller\SellerRepositoryContract;

class SellerService implements SellerServiceContract
{
    protected $repository;

    /**
     * __construct
     *
     * @param  SellerRepositoryContract $repository
     */
    public function __construct(SellerRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get by id
     *
     * @param  int $sellerId
     * @return Seller
     */
    public function getById(int $sellerId)
    {
        $seller = $this->repository->getById($sellerId, ['id']);

        if(!$seller) {
            throw new SellerNotFoundException();
        }

        return $seller;
    }
}

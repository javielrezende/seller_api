<?php

namespace App\Http\Services\Sale;

use App\Http\Repositories\Sale\SaleRepositoryContract;
use App\Http\Services\Seller\SellerServiceContract;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;

class SaleService implements SaleServiceContract
{
    const COMMISSION_RATE = 0.085;

    protected $repository;
    private $sellerService;

    /**
     * __construct
     *
     * @param SaleRepositoryContract $repository
     * @param SellerServiceContract $sellerService
     */
    public function __construct(
        SaleRepositoryContract $repository,
        SellerServiceContract $sellerService)
    {
        $this->repository = $repository;
        $this->sellerService = $sellerService;
    }

    /**
     * Make a sale
     *
     * @param  mixed $data
     * @return Sale
     */
    public function sale($data)
    {
        $commission = $this->calculateCommission($data->price);

        $sale = $this->repository->create([
            'seller_id' => $data->sellerId,
            'price' => $data->price,
            'commission_paid' => $commission,
        ]);

        return $sale->load('seller');
    }

    /**
     * Calculates the seller's commission
     *
     * @param  float $salePrice
     * @return float
     */
    private function calculateCommission(float $salePrice)
    {
        $commission = $salePrice * self::COMMISSION_RATE;
        return number_format($commission, 2, '.', '');
    }

    /**
     * Get sales by seller id
     *
     * @param  int $sellerId
     * @return Collection
     */
    public function getSalesBySellerId(int $sellerId)
    {
        $seller = $this->sellerService->getById($sellerId);

        return $this->repository->getSalesBySellerId($seller->id);
    }
}

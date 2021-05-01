<?php

namespace App\Http\Repositories\Sale;

use App\Models\Sale;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SaleRepository extends BaseRepository implements SaleRepositoryContract
{
    protected $model;

    /**
     * __construct
     *
     * @param  Sale $model
     */
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

    /**
     * Get sales of the day
     *
     * @param  mixed $fields
     * @return Collection
     */
    public function getSalesReportOfTheDay(array $fields = ['*'])
    {
        return $this->model->select($fields)
            ->whereBetween('created_at', [
                Carbon::now()->setHour(0)->setMinute(0)->setSecond(0),
                Carbon::now()->setHour(23)->setMinute(59)->setSecond(59),
            ])->get();
    }
}

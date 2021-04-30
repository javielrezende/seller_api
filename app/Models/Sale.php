<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['seller_id', 'price', 'commission_paid'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'commission_paid' => 'decimal:2',
    ];

    /**
     * Get formated created_at
     *
     * @param  Carbon $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->subHours(3)->format('d-m-Y H:i');
    }

    /**
     * Get the seller responsible for the sale.
     */
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}

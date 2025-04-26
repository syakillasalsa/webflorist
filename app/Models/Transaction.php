<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionItem;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_method',
        'status',
        'delivery_method',
        'address',
        'note',
        'shipping_cost',
        'total_payment',
        'pickup_date',
        'pickup_time',
        'delivery_date',
        'delivery_time',
    ];
    

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function transactionItems()
{
    return $this->hasMany(TransactionItem::class);
}

    public function bouquet()
{
    return $this->belongsTo(\App\Models\Bouquet::class);
}

}

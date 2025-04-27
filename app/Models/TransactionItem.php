<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id', 'bouquet_id', 'quantity', 'subtotal','price'];

    public function bouquet()
    {
        return $this->belongsTo(Bouquet::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouquet extends Model
{
    use HasFactory;
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
    
    protected $fillable = ['name', 'description', 'price', 'image'];
}

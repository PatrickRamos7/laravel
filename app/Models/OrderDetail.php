<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'pos_order_detail';
    protected $primaryKey = 'order_detail_id';

    protected $fillable = [
        'order_id',
        'book_id',
        'detail_price',
        'quantity'
    ];

    // Relación con Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Relación con Book
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
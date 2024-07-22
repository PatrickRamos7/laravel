<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'pos_order';
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'client_id',
        'total',
        'doc_type',
        'doc_number',
        'created_at'
    ];

    // Relación con Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // Relación con OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
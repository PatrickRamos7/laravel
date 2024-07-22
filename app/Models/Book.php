<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pos_book';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'book_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'isbn',
        'name',
        'author',
        'stock',
        'current_price'
    ];

    /**
     * Get the order details for the book.
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'book_id');
    }
}
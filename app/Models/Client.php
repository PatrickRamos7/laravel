<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // Especifica el nombre de la tabla si no sigue la convención de Laravel
    protected $table = 'pos_client';

    // Especifica la clave primaria si no es 'id'
    protected $primaryKey = 'client_id';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'doc_type',
        'doc_number',
        'first_name',
        'last_name',
        'phone',
        'email'
    ];

    // Relación con Order
    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }
}
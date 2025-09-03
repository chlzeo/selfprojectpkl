<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    // kasih tau Laravel nama tabel yg bener
    protected $table = 'testimoni';

    protected $fillable = [
        'customer_name',
        'car_model',
        'message',
        'photo',
        'purchase_date'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestDeliveryModel extends Model
{
    protected $table = 'test_delivery';


    public $timestamps = false;

    protected $fillable = [
        'test_id', 'class_id'
    ];
}

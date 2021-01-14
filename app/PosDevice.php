<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class PosDevice extends Model
{
    protected $fillable = [
        'imei',
         'serial_number',
         'brand',
         'model',
         'carton_no',
        'batch',
        'status',
        'date_received',
        'remarks',
        'availability',
    ];
    protected $dates = ['date_received'];
}
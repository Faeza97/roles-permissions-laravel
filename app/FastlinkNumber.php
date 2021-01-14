<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FastlinkNumber extends Model
{
    protected $fillable = [
        'msisdn',
         'serial_number',
        'batch',
        'date_received',
        'status',
        'remarks',
        'availability',
    ];
    protected $dates = ['date_received'];

}

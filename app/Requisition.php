<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Requisition extends Model
{
    use SoftDeletes;
    protected $table = 'requisitions';

        protected $fillable = [
        'sub_distributors_id',
         'sales_rep_id',
         'dealer_id',
         'fastlink_numbers_id',
        'pos_devices_id',
         'type',
        'status',
        'remarks',
         'approve_by',
        'acc_status',
        'acc_document',

    ];

        protected $dates = ['deleted_at'];

}
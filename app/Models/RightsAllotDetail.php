<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightsAllotDetail extends Model
{
    use HasFactory;
   

    protected $fillable = ['market_lot',    
    'lots',

    'lot_size',
    'terms_payment',
    'entitlement',

    'record_date',
    'date_of_allotment',
    'renunciation_date',
    'rights_issue_id'


        ];
}

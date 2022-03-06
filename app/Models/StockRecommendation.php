<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockRecommendation extends Model
{
    use HasFactory;

    protected $fillable = ['scrip',
                             'action',
                             'entryprice',
                             'target1',
                             'target2',
                             'stoploss',
                             'status',
                             'lotsize',
                             'tabname',
                             'subtabname',
                             'recommendationdate'];



}

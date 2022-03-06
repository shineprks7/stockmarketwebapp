<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashScripNameList extends Model
{
    use HasFactory;

    protected $fillable = ['scripname',
                             'scriptype','column3','column4'];
}

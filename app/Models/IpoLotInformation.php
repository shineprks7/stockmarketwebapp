<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpoLotInformation extends Model
{
    use HasFactory;
   

    protected $fillable = ['lots',
    'min_lot',
    'max_lot',
    'min_shares',
    'max_shares',
    'min_cut_off',
     'max_cut_off',
     'ipo_company_id',
    'status'];
    public function IpoCompany()
    {
        return $this->belongsTo(IpoCompany::class);
    }

}

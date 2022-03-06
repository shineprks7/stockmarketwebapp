<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpoTimeTable extends Model
{
    use HasFactory;

   
    protected $fillable = ['open_date',
    'close_date',
    'allotment_date',
    'refund_initiation',
    'shares_to_demat',
    'listing_date',
     'ipo_company_id',
    'status'];

    public function IpoCompany()
    {
        return $this->belongsTo(IpoCompany::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpoDetail extends Model
{
    use HasFactory;
            
    protected $fillable = ['issue_type',    
    'open_date',
    'close_date',
    'face_value',
    'issue_price',
    'lots',
     'issue_price_max',
    'min_order_quantity',

    'listing_at',
    'offer_for_sale',
    'qib_shares',
    'retail_shares',
    'nii_shares',
    'ipo_company_id'
     ];

     public function IpoCompany()
     {
         return $this->belongsTo(IpoCompany::class);
     }
 
 
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcdMoreInfo extends Model
{
    use HasFactory;
    

    protected $fillable = ['ncd_review',    
    'subscription_details',

    'objective_of_issue',
    'company_financials',
    'subscription_link',

    'ncd_issue_id',
    

];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightMoreInfo extends Model
{
    use HasFactory;
 


    protected $fillable = ['review',    
    'subscription_details',

    'objective_of_issue',
    'company_financials',
    'rights_issue_id',

      ];


}

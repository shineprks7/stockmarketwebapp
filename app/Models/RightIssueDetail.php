<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightIssueDetail extends Model
{
    use HasFactory;
   

    protected $fillable = ['security_name',    
    'issue_size_shares',

    'issue_size_amount',
    'open_date',
    'close_date',

    'face_value',
    'issue_price',
    'listing_at',
    'rights_issue_id'


        ];

}

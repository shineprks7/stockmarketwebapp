<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcdIssueDetail extends Model
{
    use HasFactory;
   

    protected $fillable = ['security_name',    
    'security_type',
    'open_date',
    'close_date',
    'face_value',
    'issue_price',
    'issue_size_base',
    'issue_size_shelf',
    'listing_at',
    'credit_rating',
    'ncd_issue_id'
];

}

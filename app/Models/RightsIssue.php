<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightsIssue extends Model
{
    use HasFactory;
   

    protected $fillable = ['company_name',    
    'logo_url',

    'about',
    'address',
    'assumed_open_date',

    'phone',
    'email',
    'website',
    'status'


];

public function RightIssueDetails()
{
    return $this->hasMany(RightIssueDetail::class);
}
public function RightsAllotDetails()
{
    return $this->hasMany(RightsAllotDetail::class);
}
public function RightMoreInfos()
{
    return $this->hasMany(RightMoreInfo::class);
}

}

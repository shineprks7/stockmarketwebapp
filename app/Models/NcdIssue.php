<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NcdIssue extends Model
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
public function NcdissueDetails()
{
    return $this->hasMany(NcdIssueDetail::class);
}
public function LotsAndAllotmentInfos()
{
    return $this->hasMany(LotsAndAllotmentInfo::class);
}
public function NcdMoreInfos()
{
    return $this->hasMany(NcdMoreInfo::class);
}


}

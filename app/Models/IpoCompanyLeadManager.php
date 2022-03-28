<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpoCompanyLeadManager extends Model
{
    use HasFactory;
    protected $table = "ipocompany_ipoleadmanager";
    protected $fillable = ['ipo_company_id',
    'ipo_lead_manager_id'];

}

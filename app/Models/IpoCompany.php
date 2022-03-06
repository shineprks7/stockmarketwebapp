<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpoCompany extends Model
{
    use HasFactory;

    protected $fillable = ['company_name',
    'logo_url',
    'about',
    'address',
    'phone',
    'email',
     'website',
    'status'];

    public function IpoDetails()
    {
        return $this->hasMany(IpoDetail::class);
    }
    public function IpoLotInformations()
    {
        return $this->hasMany(IpoLotInformation::class);
    }
    public function IpoTimeTables()
    {
        return $this->hasMany(IpoTimeTable::class);
    }

   
}

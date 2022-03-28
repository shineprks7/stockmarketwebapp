<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpoLeadManager extends Model
{
    use HasFactory;
   

            protected $fillable = ['company_name',
      'logo_url',

      'address',
      'phone',
      'contact_person',
      'contact_email',
       'website',
      'status',
      'validity'];
    
     public function Ipocompanies()
     {
 
      return $this->belongsToMany(IpoLeadManager::class, 'ipocompany_ipoleadmanager');
 
     }

}



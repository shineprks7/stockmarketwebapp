<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotsAndAllotmentInfo extends Model
{
    use HasFactory;
    

    protected $fillable = ['minimum_lot',    
    'maximum_lots',

    'qib_allocation_ratio',
    'nii_allocation_ratio',
    'hni_allocation_ratio',
    'rii_allocation_ratio',

    'qib_offered',
    'nii_offered',
    'hni_offered',
    'rii_offered',

    'basis_of_allotment',
    'allotment_status',
    'allotment_comments',
    'ncd_issue_id'

];


}

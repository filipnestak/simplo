<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'surname',
        'contact_email',
        'phone',
        'is_company',
        'company_id',
        'company_name',
        'company_vat_id',
        'company_tax_id',
    ];

    public function customerGroups()
    {
        return $this->belongsToMany(CustomerGroup::class,'customer_group_customer');
    }
}

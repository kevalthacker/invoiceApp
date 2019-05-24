<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = ['user_id', 'company_name', 'company_address', 'company_website', 'company_city', 'company_state', 'company_postcode', 'company_country'];
	
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $fillable = ['user_id', 'address_id','invoice_no', 'invoice_date', 'due_date', 'creater_detail', 'sub_total', 'discount', 'grand_total'];
	
	public function items()
    {
        return $this->hasMany(InvoiceItems::class);
    }	
}

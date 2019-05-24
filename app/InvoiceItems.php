<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItems extends Model
{
    //
    protected $fillable = ['invoice_id', 'item_name','qty', 'price', 'total'];		
	
	public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

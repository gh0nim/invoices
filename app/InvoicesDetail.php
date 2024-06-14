<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicesDetail extends Model
{
    protected $fillable = [
        'invoice_id',
        'invoice_number',
        'product',
        'section',
        'Status',
        'Value_Status',
        'note',
        'user',
        'Payment_Date',
    ];
    public function invoices(){
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
}

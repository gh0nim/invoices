<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Invoice extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'invoice_number',
        'invoice_Date',
        'Due_date',
        'product_id',
        'section_id',
        'Amount_collection',
        'Amount_Commission',
        'Discount',
        'Value_VAT',
        'Rate_VAT',
        'Total',
        'Status',
        'Value_Status',
        'note',
        'Payment_Date',
    ];
    public function sections(){
        return $this->belongsTo(Section::class,'section_id','id');
    }public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function details(){
        return $this->hasMany(InvoicesDetail::class,'invoice_id','id');
        
}
}
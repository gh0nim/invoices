<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function sections(){
        return $this->belongsTo(Section::class,'section_id','id');
    }
}

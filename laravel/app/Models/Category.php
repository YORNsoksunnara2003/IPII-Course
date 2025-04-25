<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
// use Illuminate\Database\Eloquent\SoftDelete÷s;

class Category extends Model
{
    // use SoftDeletes;
    // use HasFactory;
    // Allow mass assignment
    protected $fillable = ['name'];
   
    

    public function product(){
        return $this->hasMany(Product::class);
    }

}
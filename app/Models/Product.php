<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //rellenar un producto
    protected $fillable = [
        'name',
        'price',
        'detail',
    ];

    public function orders(){
       // return $this->belongsToMany('App\Models\Order')->withTimestamps();
        return $this->belongsToMany('App\Models\Order')->withTimestamps();
    }



}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $guarded = ['id'];

    protected $with = ['categories', 'jewelTypes', 'images'];
    // public function prices()
    // {
    //     return $this->hasMany('App\Price');
    // }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function jewelTypes()
    {
        return $this->belongsToMany('App\JewelType');
    }

    public function images(){
        return $this->hasMany('App\ItemImage');
    }
}

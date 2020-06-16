<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';

    // dinh nghia 1 phuong thuc tao moi quan he voi bang product
    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}

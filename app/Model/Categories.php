<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //khai bao model nay se lam viec bang du lieu
    protected $table = 'categories';

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    public static function findOrFail(int $int)
    {
    }
    
    public function brands()
    {
        return $this->belongsTo('App\Model\Brands','brands_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Model\Categories','categories_id', 'id');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Model\Color','product_color', 'products_id','colors_id');
    }


    public function tags()
    {
        return $this->belongsToMany('App\Model\Tag','product_tag', 'products_id','tags_id');
    }

    public function sizes()
    {
        return $this->belongsToMany('App\Model\Size','product_size', 'products_id','sizes_id');
    }
}

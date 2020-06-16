<?php

namespace App\Http\Controllers\orm;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Categories;
use App\Model\Product;
use App\Model\Brands;
use App\Model\Color;
use App\Model\Tag;

class TestOrmController extends Controller
{
    public function index(Tag $tag)
    {
        $data = Categories::find(1)->products;
        // dd($data->toArray());
        $dt = Product::find(1)->categories;
        // dd($dt->toArray());

        // tu bang brand tim ra san pham co id bang 2
        $dt2 = Brands::find(2)->products;
        //dd($dt2->toArray());

        // bang color map sang bang product thong bang trung gian
        // pivot : tra ve mang lay id cua bang trung gian
        $dt3 = Color::find(1)->products;

        //dd($dt3->toArray());
        $t = Product::find(1);
        // DB::table('products')->where('id',1)->get();
        // dd($t->toArray());
        $t2 = Product::all();
        // DB::table('products')->get();
        //dd($t2->toArray());
        $t3 = Product::count();
        //dd($t3);

        $t4 = Product::select('name_product')->get();
        //dd($t4->toArray());
        //$t5 = Product::findOrFail(100);
        //dd($t5->toArray());

        // insert ORM
        /*
        $insert = $tag->insertDataTag('giay dep', 'giay-dep', null,null,null);
        if($insert){
            echo 'OK';
        } else {
            echo 'ERR';
        }
        */
        /*
        $up = $tag->updateTag('giay the thao',1);
        if($up){
            echo 'OK';
        } else {
            echo 'ERR';
        }
        */
        $del = $tag->deleteTag(1);
        if($del){
            echo 'OK';
        } else {
            echo 'ERR';
        }
    }
}

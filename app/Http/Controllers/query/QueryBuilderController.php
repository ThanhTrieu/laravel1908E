<?php

namespace App\Http\Controllers\query;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderController extends Controller
{
    public function index()
    {
        // lay ra tat ca danh muc san pham
        // SELECT * FROM categories
        $data = DB::table('categories')->get();

        // SELECT a.name_product, a.slug_product FROM products AS a WHERE a.id = 1
        $detail = DB::table('products AS a')
                        ->select('a.name_product', 'a.slug_product')
                        ->where('a.id', '=', 1)
                        ->first(); // get one row

        // select max(price) from products
        $maxPrice = DB::table('products')
                    //->max('price');
                    //->min('price');
                    //->avg('price');
                    ->sum('price');
        //dd($maxPrice);

        // select count() from product
        $count = DB::table('products')->count();
        //dd($count);

        $dt = DB::table('sizes')
            ->select('*')
            ->where('size_number', '>=', 38)
            ->where(['id' => 1, 'status' => 1])
            ->get();
        //dd($dt);
        $join = DB::table('products AS p')
                    ->select('c.name AS name_cate', 'b.name AS name_brand', 'p.name_product', 'p.id AS id_product')
                    ->join('categories AS c', 'c.id', '=', 'p.categories_id')
                    ->join('brands AS b', 'b.id', '=', 'p.brands_id')
                    ->where('p.id',1)
                    ->first();
        //dd($join);
        $dt2 = DB::table('products AS p')
                    ->select('c.name AS name_color', 's.size_number', 'p.name_product', 'p.id AS id_product')
                    ->join('product_color AS pc','pc.products_id', '=', 'p.id')
                    ->join('colors AS c', 'c.id', '=', 'pc.colors_id')
                    ->join('product_size AS ps', 'ps.products_id', 'p.id')
                    ->join('sizes AS s', 's.id', '=', 'ps.sizes_id')
                    ->where('p.id', 2)
                    ->get();
        //dd($dt2);

        // select * colors where id IN (1,2,3);
        $t = DB::table('colors')
                //->whereIn('id', [1,2,99])
                ->whereNotIn('id', [1,2,99])
                ->get();
        //dd($t);
        $t2 = DB::table('colors')
                ->whereNotNull('created_at')
                ->get();
        //dd($t2);
        $t3 = DB::table('products')
                ->whereNotBetween('price',[2000,3000])
                ->get();
        //dd($t3);
        $input1 = date('Y-m-d H:i:s', strtotime('-7days'));
        $input2 = date('Y-m-d H:i:s');
        $dt4 = DB::table('products')
                //->whereDate('created_at', $input1)
                ->whereBetween('created_at',[$input1, $input2])
                ->get();
        //dd($dt4);
        $pd = DB::table('products')->where('name_product', 'like', '%Test%')->get();
        // limit
        $test23 = DB::table('categories')
                //->offset(3)
                //->limit(2)
                ->skip(3)
                ->take(2)
                ->get();
        //dd($test23);

        $dataInert = [
            //banng tags
            'name_tag' => 'test 123',
            'slug_tag' => 'test-123',
            'title_seo' => null,
            'meta_seo' => null,
            'description_seo' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ];
        /*
        $insert = DB::table('tags')->insert($dataInert);
        if($insert){
            echo 'Thanh cong';
        } else {
            echo 'That bai';
        }
        */
        /*
        $update = DB::table('tags')
            ->where('id',1)
            ->update(['name_tag' => 'tag demo', 'slug_tag' => 'tag-demo']);

        if($update){
            echo 'Thanh cong';
        } else {
            echo 'That bai';
        }
        */
        $del = DB::table('tags')
            ->where('id',1)
            ->delete();
        if($del){
            echo 'Thanh cong';
        } else {
            echo 'That bai';
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Categories;
use App\Model\Brands;
use App\Model\Color;
use App\Model\Tag;
use App\Model\Size;
use App\Model\Product;
use App\Http\Requests\StoreProducShoesPost as Products;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.list-shoes');
    }

    public function addShoes()
    {
        $category = Categories::where('status',1)->get();
        $brands = Brands::where('status',1)->get();
        $colors = Color::where('status',1)->get();
        $sizes = Size::where('status',1)->get();
        $tags = Tag::all();
        return view('admin.product.add-shoes', compact(
            'category',
            'brands',
            'colors',
            'sizes',
            'tags'
        ));
    }

    public function handleAddShoes(Products $request)
    {
        $nameProduct = $request->nameProduct;
        $slug = Str::slug($nameProduct, '-');
        $price = $request->priceProduct;
        $price = trim(str_replace(',','', $price));
        $qty = $request->qtyProduct;
        $qty = is_numeric($qty) && $qty > 0 ? $qty : 1;
        $saleOff = $request->saleOffProduct;
        $saleOff = is_numeric($saleOff) ? $saleOff : 0;
        $codeProduct = $request->codeProduct;

        $category = $request->categoryProduct;
        $brand = $request->brandProduct;
        $color = $request->colorProduct;
        $size = $request->sizeProduct;
        $tag = $request->tagProduct;

        $arrImageProduct = [];
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            foreach ($file as $key => $image) {
                $nameFile = $image->getClientOriginalName();
                $image->move('upload/images', $nameFile);
                $arrImageProduct[] = $nameFile;
            }
        }
        if($arrImageProduct){
            $strImages = json_encode($arrImageProduct);
            $dataInsert = [
                'categories_id' => $category,
                'brands_id' => $brand,
                'name_product' => $nameProduct,
                'slug_product' => $slug,
                'image' => $strImages,
                'qty' => $qty,
                'price' => $price,
                'status' => 1,
                'sale_off' => $saleOff,
                'code_product' => $codeProduct,
                'view' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null
            ];
            $insertShoes = Product::create($dataInsert);
            $idInsert = $insertShoes->id;
            //insert vao bang product => lay ra duoc Id vua insert vao db
            // insert vao bang color_product
            // insert vao bang size_product
            // insert vao bang tag_product
            if($idInsert > 0 && is_numeric($idInsert)) {
                foreach ($color as $key => $idColor) {
                    DB::table('product_color')->insert([
                        'products_id' => $idInsert,
                        'colors_id' => $idColor,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null
                    ]);
                }
                foreach ($size as $key => $idSize) {
                    DB::table('product_size')->insert([
                        'products_id' => $idInsert,
                        'sizes_id' => $idSize,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => null
                    ]);
                }

                if ($tag) {
                    foreach ($tag as $key => $idTag) {
                        DB::table('product_tag')->insert([
                            'products_id' => $idInsert,
                            'tags_id' => $idTag,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => null
                        ]);
                    }
                }
                $request->session()->flash('successAddProduct', 'Them thanh cong');
                return redirect()->route('admin.shoes.product');
            } else {
                $request->session()->flash('errorAddProduct', 'Co loi xay ra vui long thu lai');
                return redirect()->route('admin.add.shoes');
            }
        } else {
            $request->session()->flash('errorAddProduct', 'Vui long nhap anh san pham');
            return redirect()->route('admin.add.shoes');
        }
    }
}

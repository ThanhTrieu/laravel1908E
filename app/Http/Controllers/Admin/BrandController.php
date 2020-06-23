<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Support\Str;
use voku\helper\AntiXSS;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    const LIMITED_ROW = 2;
    public function index(Request $request)
    {
        $data = [];
        $data['message'] = $request->session()->get('brands');
        $data['listBrands'] = DB::table('brands')->paginate(self::LIMITED_ROW);
        return view('admin.brand.index', $data);
    }

    public function addBrand()
    {
        return view('admin.brand.add');
    }

    public function handleAddBrand(StoreBrandPost $request, AntiXSS $xss)
    {
        $nameBrand = $request->nameBrand;
        $nameBrand = $xss->xss_clean($nameBrand);
        $slug = Str::slug($nameBrand, '-');
        $desBrand = $request->descBrand;

        $insert = DB::table('brands')->insert([
           'name' => $nameBrand,
            'slug' => $slug,
            'description' => $desBrand,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ]);

        if($insert){
            $request->session()->flash('brands', 'Add successful');
            return redirect(route('admin.brands'));
        } else {
            $request->session()->flash('brands', 'Add fail');
            return redirect(route('admin.add.brand'));
        }
    }
}

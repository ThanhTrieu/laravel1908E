<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandPost;
use Illuminate\Support\Str;
use voku\helper\AntiXSS;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateBrandPost;

class BrandController extends Controller
{
    const LIMITED_ROW = 2;
    public function index(Request $request, AntiXSS $xss)
    {
        $data = [];
        $keyword = $request->q;
        $keyword = $xss->xss_clean($keyword);
        $keyword = "%{$keyword}%";

        $data['message'] = $request->session()->get('brands');
        $data['listBrands'] = DB::table('brands')
                                ->orderByDesc('status')
                                ->paginate(self::LIMITED_ROW);
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

    public function deleteBrand(Request $request)
    {
        if($request->ajax()){
            // check la request ajax
            $idBrand = $request->id;
            $idBrand = (is_numeric($idBrand) && $idBrand > 0) ? $idBrand : 0;

            $status = $request->status;
            $status = $status === '0' || $status === '1' ? $status : '';

            if($idBrand != 0 && $status !== ''){
                $update = DB::table('brands')
                    ->where('id', $idBrand)
                    ->update(['status' => $status]);
                if($update){
                    echo 'ok';
                } else {
                    echo 'fail';
                }
            } else {
                echo 'err';
            }
        }
    }

    public function editBrand(Request $request)
    {
        $id = $request->id;
        $id = is_numeric($id) && $id > 0 ? $id : 0;
        $infoBrand = DB::table('brands')
                        ->where('id', $id)
                        ->first();
        //$infoBrand = json_decode(json_encode($infoBrand), true);
        //dd($infoBrand);
        if($infoBrand){
            $message = $request->session()->get('brands');
            return view('admin.brand.edit', compact('id', 'infoBrand', 'message'));
        } else {
            abort(404);
        }
    }

    public function handleUpdate(UpdateBrandPost $request)
    {
        $name = $request->nameBrand;
        $slug = Str::slug($name, '-');
        $des = $request->descBrand;
        $status= $request->status;
        $id = $request->hddIdBrand;
        $id = is_numeric($id) && $id > 0 ? $id : 0;

        $update = DB::table('brands')
                    ->where('id', $id)
                    ->update([
                        'name' => $name,
                        'slug' => $slug,
                        'description' => $des,
                        'status' => $status,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
        if($update){
            $request->session()->flash('brands', 'Update success');
            return redirect(route('admin.brands'));
        } else {
            $request->session()->flash('brands', 'Update fail');
            return redirect(route('admin.edit.brand',['slug'=>$slug,'id' =>$id]));
        }

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Categories;
use App\Http\Requests\StoreCategoryPost;
use App\Http\Requests\UpdateCategoryPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    const LIMITED = 30;
    public function index(Request $request)
    {
        $viewCate = Categories::where([
            'parent_id' => 0
        ])->paginate(self::LIMITED);

        $allCate = Categories::where('status', 1)->get();
        $message = $request->session()->get('actionCate');
        return view('admin.category.index', compact(
            'allCate',
            'message',
            'viewCate'
        ));
    }

    public function addCategory(StoreCategoryPost $request)
    {
        $name = $request->nameCate;
        $slug = Str::slug($name, '-');
        $status =1; // active luon
        $parentId = $request->cateParent;
        $parentId = ($parentId == '' || $parentId < 0) ? 0 : $parentId;

        $dataInsert = Categories::create([
            'parent_id' => $parentId,
            'status' => $status,
            'name' => $name,
            'slug' => $slug,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ]);

        if($dataInsert){
            $request->session()->flash('actionCate', 'Add success');
        } else {
            $request->session()->flash('actionCate', 'Add Fail');
        }
        return redirect(route('admin.category'));
    }

    public function editCategory($slug, $id, Request $request)
    {
        $id = is_numeric($id) && $id > 0 ? $id : 0;
        $infoCategory = Categories::find($id);

        if($infoCategory){
            $allCate = Categories::all()->where('status', 1);
            return view('admin.category.edit-category', compact('infoCategory','allCate','infoCategory'));
        } else {
            abort(404);
        }
    }

    public function handleUpdateCategory(UpdateCategoryPost $request)
    {
        $id = $request->id;
        $id = is_numeric($id) ? $id : 0;
        $info = Categories::find($id);

        if($info) {
            $nameCate = $request->nameCate;
            $slug = Str::slug($nameCate, '-');

            $status = $request->statusCate;
            $status = $status === '0' || $status === '1' ? $status : 0;

            $strParentCate = $request->cateParent;
            $arrParentCate = explode('-', $strParentCate);
            $idCate = $arrParentCate[0];
            $parentIdCate = $arrParentCate[1];

            // cap lai cate
            if($idCate != $info->parent_id && $idCate != $info->id){
                // cap lai parent_id hien tai bang id gui len
                $update = DB::table('categories')
                    ->where('id', $id)
                    ->update([
                        'status' => $status,
                        'parent_id' => $idCate,
                        'name' => $nameCate,
                        'slug' => $slug,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            } else {
                $update = DB::table('categories')
                    ->where('id', $id)
                    ->update([
                        'status' => $status,
                        'name' => $nameCate,
                        'slug' => $slug,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            }
            if($update){
                // quay ve trang list category
                $request->session()->flash('updateCate', 'Update thanh cong');
                return redirect(route('admin.category'));
            } else {
                // o lai form update
                $request->session()->flash('updateCate', 'Co loi xay ra, vui long thu lai');
                return redirect(route('admin.edit.category',['slug' => $info->slug, 'id' => $id]));
            }
        } else {
            $request->session()->flash('updateCate', 'Co loi xay ra, vui long thu lai');
            return redirect(route('admin.category'));
        }
    }
}

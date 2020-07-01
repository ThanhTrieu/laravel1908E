<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Categories;
use App\Http\Requests\StoreCategoryPost;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    const LIMITED = 4;
    public function index(Request $request)
    {
        $viewCate = Categories::where([
            'parent_id' => 0,
            'status' => 1
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
}

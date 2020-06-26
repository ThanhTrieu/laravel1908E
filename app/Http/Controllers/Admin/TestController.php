<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use App\Model\Categories;
use Illuminate\Support\Str;

class TestController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */

    public function manageCategory()
    {

        $categories = Categories::where('parent_id', '=', 0)->get();

        $allCategories = Categories::all();
//        $data = [];
//        $data['categories'] = $categories->toArray();
//        $data['allCategories'] = $allCategories->toArray();
        //dd($data);
        return view('admin.test.categoryTreeview', compact('categories', 'allCategories'));
    }


    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return Response
     * @throws ValidationException
     */

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        $slug = Str::slug($input['title'], '-');

        $data = [
            'parent_id' => $input['parent_id'],
            'name' => $input['title'],
            'status' => 1,
            'slug' => $slug,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null
        ];

        Categories::create($data);
        return back()->with('success', 'New Category added successfully.');

    }
}

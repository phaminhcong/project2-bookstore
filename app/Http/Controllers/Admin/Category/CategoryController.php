<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function all()
    {
        $category = Category::where('isDeleted', 0)->Paginate(5);
        return view('admin.categories.list_category', compact('category'));
    }
    public function showCategoryCilent()
    {
        $categories = Category::where('isDeleted', 0)->Paginate(5);
        return view('customer.customer', compact('categories'));
    }
    public function softDeleted($id)
    {
        DB::table("categories")
            ->where("id", $id)
            ->update(['isDeleted' => 1]);
        return redirect()->route('category.all');
    }
    //add
    public function create()
    {
        return view('admin.categories.add_category');
    }

    public function store(Request $request)
    {
        $add_category = $request->validate([
            'name' => 'required|unique:categories|regex:/[a-zA-Z]/',
        ],[
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.regex' => 'Tên danh mục không được chỉ chứa mỗi số',
            'name.unique' => 'Tên danh mục đã tồn tại',
            
        ]);
        Category::create($add_category);
        Session::flash('success', 'Danh mục đã được thêm thành công!');
        return redirect()->route('category.all');
    }
    //edit
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.update_category', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|string|max:255|regex:/[a-zA-Z]/',
        ],[
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.regex' => 'Tên danh mục không được chỉ chứa mỗi số',
            'name.unique' => 'Tên danh mục đã tồn tại',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $validatedData['name'];
        $category->save();
        Session::flash('successUpdate', 'Danh mục đã được cập nhật thành công!');
        return redirect()->route('category.all');
    }


    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $categories = Category::where('name', 'like', "%$searchTerm%")
        ->where('isDeleted', 0)
        -> paginate(4);
        return view('admin.categories.search_category', compact('categories', 'searchTerm'));
    }
}

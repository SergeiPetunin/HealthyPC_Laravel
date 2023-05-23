<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //----------------------adminpanel. список всех категорий
    public function index()
    {
        $categories = Category::orderBy('id','asc')->get();
        return view('categories.index', compact('categories'));
    }

    //----------------------adminpanel. ввод новой категории
    public function create()
    {
        return view('categories.create');
    }

    //----------------------adminpanel. запись новой категории в БД
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Category::create($request->all());
        return redirect('/categorylist');
    }

    //----------------------adminpanel. редактирование категории
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    //----------------------adminpanel. запись отредактированных данных в БД
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category->update($request->all());
        return redirect('/categorylist');
    }

    //----------------------adminpanel. удаление категории
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/categorylist');
    }


     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }
}

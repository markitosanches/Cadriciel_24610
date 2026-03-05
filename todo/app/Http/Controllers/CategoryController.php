<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::all();
        // // return $categories;
        // // return $categories[0]->category['en'];

        // $categoriesR = CategoryResource::collection($categories)->resolve();
        // // return $categoriesR;

        // $sorted = collect($categoriesR)->sortBy('category')->values();
        // return $sorted->all();
        if(Auth::user()->hasRole('Admin')){
             $categories = Category::categories();
            return $categories;
        }else{
            return 'Error';
        }
       
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //    return $request;
        $request->validate([
            'category_en' => 'required|max:30',
            'category_fr' => 'max:30',
        ]);

        $category = array_filter([
            'en' => $request->category_en,
            'fr' => $request->category_fr,
        ]);

        // return $category;
        Category::create([
            'category' => $category
        ]);
        return back()->withSuccess('Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}

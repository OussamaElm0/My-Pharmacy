<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|min:3|string"
        ]);
        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', "Category was created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('categories.show', [
            'category' => Category::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('categories.edit', [
            'category' => Category::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        $category->update($request->all());

        $flashMessage = "Category: " . $category->name . " was updated successfully" ;

        return redirect()->route("categories.index")->with('success',$flashMessage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();

        return redirect()->route('categories.index')->with('success', 'Category was deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
   public function index()
{
    $categories = Category::with('todos')->get(); // pastikan relasi 'todos' ada di model Category
    return view('category.index', compact('categories'));
}


    public function create()
    {
        return view('category.create');
    }

    public function edit(Category $category)
    {
        if (auth()->user()->id == $category->user_id) {
            return view('category.edit', compact('category'));
        } else {
            return redirect()->route('category.index')->with('danger', 'You are not authorized to edit this todo!');
        }
    }

     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:25',
        ]);

        Category::create([
            'title' => ucfirst($request->title),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('category.index')->with('success', 'Todo created successfully');
    }

    public function destroy(Category $category)
    {
        // optional: validasi user yang berhak menghapus
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }

}

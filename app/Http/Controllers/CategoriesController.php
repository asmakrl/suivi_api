<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $category = Category::with('sender')->get();
        return response()->json($category);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!empty($category)) {
            return response()->json($category['nomAr']);
        } else {
            return response()->json(['message', 'Action Not Found'], 404);
        }
    }
}

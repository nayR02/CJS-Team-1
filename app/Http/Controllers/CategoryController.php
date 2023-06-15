<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryController extends Controller
{
    //
    public function saveCategory(Request $request)
    {
        $roundId = $request->input('rounds');
        $categoryName = $request->input('category_name');
        $categoryValue = $request->input('category_value');

        $category = new Categories();
        $category->category_name = $categoryName;
        $category->category_value = $categoryValue;
        $category->rounds_id = $roundId;
        $category->save();

        // Read the saved category from the database
        $savedCategory = Categories::find($category->id);

        return redirect()->route('save.category')->with('success', 'Category saved successfully.')
            ->with('category', $savedCategory);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;

class CriteriaController extends Controller
{
    //
    public function saveCategory(Request $request)
    {
        $categoryId = $request->input('categories');
        $categoryName = $request->input('criteria_name');
        $categoryValue = $request->input('criteria_value');

        $category = new Criteria();
        $category->category_name = $categoryName;
        $category->category_value = $categoryValue;
        $category->rounds_id = $categoryId;
        $category->save();

        return redirect()->route('save.category')->with('success', 'Category saved successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Rounds;

class CategoryController extends Controller
{
    // create
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

        return redirect()->route('save.category')
            ->with('success', 'Category saved successfully.');
    }
    // read
    public function getCategory(Request $request)
    {
        $roundInput = $request->input('rounds');
        $round = Rounds::where('rounds', $roundInput)->firstOrFail();
        $categories = $round->categories;

        return view(
            '/categories/index',
            ['categories' => $categories],
            ['rounds' => $round]
        );
    }
    // delete
    public function deleteCategory($category_id)
    {
        $category = Categories::find($category_id);
        $category->delete();

        return redirect()->route('save.category')
            ->with('success', 'Category deleted successfully.');
    }
    public function updateCategory(Request $request, $category_id)
    {
        $category = Categories::find($category_id);

        if (!$category) {
            return redirect()->route('save.category')->with('error', 'Category not found.');
        }

        $category->category_name = $request->input('category_name', $category->category_name);
        $category->category_value = $request->input('category_value', $category->category_value);
        $category->save();

        return redirect()->route('save.category')->with('success', 'Category updated successfully.');
    }
}

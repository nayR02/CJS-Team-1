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
        $criteriaName = $request->input('criteria_name');
        $criteriaValue = $request->input('criteria_value');

        $criteria = new Criteria();
        $criteria->criteria_name = $criteriaName;
        $criteria->criteria_value = $criteriaValue;
        $criteria->category_id = $categoryId;
        $criteria->save();

        return redirect()->route('save.criteria')->with('criteria', 'Criteria saved successfully.');
    }
}

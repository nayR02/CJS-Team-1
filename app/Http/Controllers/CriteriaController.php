<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Categories;

class CriteriaController extends Controller
{
    public function criteria()
    {
        return view('criteria');
    }

    public function saveCriteria(Request $request)
    {
        $roundId = $request->input('rounds');
        $categoryId = $request->input('categories');
        $criteriaName = $request->input('criteria_name');
        $criteriaValue = $request->input('criteria_value');

        $categories = Categories::where('rounds_id', $roundId)->get();

        $criteria = new Criteria();
        $criteria->criteria_name = $criteriaName;
        $criteria->criteria_value = $criteriaValue;

        $criteria->categories()->associate($categoryId);

        $criteria->save();

        return redirect()->route('save.criteria')->with('criteria', 'Criteria saved successfully.');
    }

    public function deleteCriteria($criteria_id)
    {
        $criteria = Criteria::find($criteria_id);
        $criteria->delete();

        return redirect()->route('save.criteria')
            ->with('success', 'Criteria deleted successfully.');
    }
}
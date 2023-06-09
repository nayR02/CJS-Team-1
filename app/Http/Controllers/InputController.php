<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DynamicInput;

class InputController extends Controller
{
    public function storeFields(Request $request)
    {
        $inputs = $request->input('inputs');

        // Store the inputs in sessions
        session()->put('generated_inputs', $inputs);

        // Optionally, you can also store the inputs in the database or perform other operations

        return response()->json(['message' => 'Inputs stored successfully']);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AnimalExpensesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{
    public function saveData(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'id_animal' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'required|string',
            'price' => 'required|numeric|regex:/^[1-9][0-9]*$/|not_in:0',
        ]);

        // Return validation error
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Save the data
        $expanse = AnimalExpensesModel::create([
            'date' => $request->date,
            'id_animal' => $request->id_animal,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // Return response
        if (!$expanse) return response()->json(['message' => 'Expanse failed to save']);
        return response()->json(['message' => 'Expanse successfully saved', 'expanse' => $expanse]);
    }
}

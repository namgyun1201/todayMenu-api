<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function list(Request $request)
    {
        $this->validate($request, [
            'name' => 'nullable|string',
            'type' => 'nullable|string',
            'only_name' => 'nullable|boolean'
        ], [
            '*' => config('aborts.request')
        ]);

        $name = $request->input('name');
        $type = $request->input('type');
        $only_name = $request->input('only_name') !== null ? filter_var($request->input('only_name'), FILTER_VALIDATE_BOOLEAN) : false;

        $ingredients = Ingredient::where(function ($query) use ($name) {
            if ($name !== null) {
                $query->where('name', $name);
            }
        })
        ->where(function ($query) use ($type) {
            if ($type !== null) {
                $query->where('type', $type);
            }
        })
        ->get();

        if ($only_name === true) {
            $ingredients = $ingredients->pluck('name')->unique()->values();
        }

        return response()->json([
            'data' => $ingredients
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipie;
use App\Models\Ingredient;

class RecipieController extends Controller
{
    public function recommendList(Request $request)
    {
        $this->validate($request, [
            'limit' => 'nullable|integer'
        ], [
            '*' => config('aborts.request')
        ]);

        $limit = $request->input('limit');

        $recipies = Recipie::inRandomOrder()->take($limit)->get();

        return response()->json([
            'data' => $recipies
        ]);
    }

    public function show(Request $request, $recipie_id)
    {
        $recipie_id = intval($recipie_id);

        $recipie = Recipie::find($recipie_id);
        if ($recipie === null) {
            abort(403, config('aborts.recipies.does_not_exist'));
        }

        return response()->json([
            'data' => $recipie
        ]);
    }

    public function list(Request $request)
    {
        $this->validate($request, [
            'ingredient' => 'required|string'
        ], [
            '*' => config('aborts.request')
        ]);

        $ingredient = $request->input('ingredient');

        $ingredients = Ingredient::with('recipie')->where('name', $ingredient)->get();
        if ($ingredients->isEmpty()) {
            abort(403, config('aborts.ingredients.does_not_exist'));
        }

        $recipies = $ingredients->pluck('recipie');

        return response()->json([
            'data' => $recipies
        ]);
    }
}

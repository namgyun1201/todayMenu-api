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
            'ingredients' => 'required|array'
        ], [
            '*' => config('aborts.request')
        ]);

        $ingredients = $request->input('ingredients');

        $intersection = Ingredient::with('recipie')->select('recipie_id')->whereIn('name', $ingredients)->groupBy('recipie_id')->havingRaw('COUNT(DISTINCT name) = ?', [count($ingredients)])->get();

        $intersectionRecipies = collect();
        if ($intersection->isNotEmpty()) {
            $intersectionRecipies = $intersection->pluck('recipie');
        }

        $combination = Ingredient::with('recipie')->select('recipie_id')->whereIn('name', $ingredients)->groupBy('recipie_id')->get();
        $combinationRecipies = $combination->pluck('recipie');

        $recipies = $intersectionRecipies->merge($combinationRecipies)->unique()->values();

        return response()->json([
            'data' => $recipies
        ]);
    }
}

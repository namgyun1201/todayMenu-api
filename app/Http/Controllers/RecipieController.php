<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipie;

class RecipieController extends Controller
{
    public function list(Request $request)
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
}

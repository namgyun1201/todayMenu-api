<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipie;

class RecipieController extends Controller
{
    public function list(Request $request, $user_id)
    {
        $this->validate($request, [
            'limit' => 'nullable|'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Process;

class ProcessController extends Controller
{
    public function show(Request $request, $recipie_id)
    {
        $recipie_id = intval($request->input('recipie_id'));

        $processes = Process::where('recipie_id', $recipie_id)->orderBy('position')->get();

        return response()->json([
            'data' => $processes
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Process;

class ProcessController extends Controller
{
    public function show(Request $request, $recipie_id)
    {
        $recipie_id = intval($recipie_id);

        $processes = Process::where('recipie_id', $recipie_id)->orderBy('position')->get();
        if ($processes->isEmpty()) {
            abort(403, config('aborts.processes.does_not_exist'));
        }

        return response()->json([
            'data' => $processes
        ]);
    }
}

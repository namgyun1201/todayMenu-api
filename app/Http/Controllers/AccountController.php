<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function check(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|string'
        ], [
            '*' => config('aborts.request')
        ]);

        $account = $request->input('account');

        $available = true;

        $user = User::where('account', $account)->first();
        if ($user !== null) {
            $available = false;
        }

        return response()->json([
            'available' => $available
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'account' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'mobile' => 'nullable|regex:/^\d{3}-\d{3,4}-\d{4}$/'
        ], [
            '*' => config('aborts.request')
        ]);

        $name = $request->input('name');
        $account = $request->input('account');
        $email = $request->input('email');
        $password = $request->input('password');
        $mobile = $request->input('mobile');

        $user = new User([
            'name' => $name,
            'account' => $account,
            'email' => $email,
            'password' => $password,
            'mobile' => $mobile
        ]);

        $user->save();

        return response()->json([
            'result' => 'success'
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'account' => 'required|string',
            'password' => 'required|string'
        ], [
            '*' => config('aborts.request')
        ]);

        $account = $request->input('account');
        $password = $request->input('password');

        $user = User::where('account', $account)->first();

        if ($user === null) {
            abort(403, config('aborts.accounts.does_not_exist'));
        }

        if ($user->password !== $password) {
            abort(403, config('aborts.accounts.wrong_password'));
        }

        return response()->json([
            'data' => $user
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AccountController extends Controller
{
    public function check(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ], [
            '*' => config('aborts.request')
        ]);

        $email = $request->input('email');

        $available = true;

        $user = User::where('email', $email)->first();
        if ($user !== null) {
            $available = false;
        }

        return response()->json([
            'data' => [
                'available' => $available
            ]
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            // 'account' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'mobile' => 'nullable|regex:/^\d{3}-\d{3,4}-\d{4}$/'
        ], [
            '*' => config('aborts.request')
        ]);

        $name = $request->input('name');
        // $account = $request->input('account');
        $email = $request->input('email');
        $password = $request->input('password');
        $mobile = $request->input('mobile');

        $user = User::updateOrCreate([
            'email' => $email,
        ], [
            'name' => $name,
            'password' => bcrypt($password),
            'mobile' => $mobile
        ]);

        $client = Client::where('password_client', true)->first();

        $http = new \GuzzleHttp\Client();

        $route = route('passport.token');

        $response = $http->post($route, [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ]
        ]);

        $token = json_decode((string) $response->getBody(), true);

        return response()->json([
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string'
        ], [
            '*' => config('aborts.request')
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password]) === false) {
            abort(403, config('aborts.accounts.does_not_exist'));
        }

        $user = Auth::user();

        $client = Client::where('password_client', true)->first();

        $http = new \GuzzleHttp\Client();

        $route = route('passport.token');

        $response = $http->post($route, [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ]
        ]);

        $token = json_decode((string) $response->getBody(), true);

        return response()->json([
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }

    public function refreshToken(Request $request)
    {
        $this->validate($request, [
            'refresh_token' => 'required|string',
        ], [
            '*' => config('aborts.request')
        ]);

        $refresh_token = $request->input('refresh_token');

        $client = Client::where('password_client', true)->first();

        $http = new \GuzzleHttp\Client();

        $route = route('passport.token');

        $response = $http->post($route, [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refresh_token,
                'client_id' => $client->id,
                'client_secret' => $client->secret,
                'scope' => '',
            ]
        ]);

        $token = json_decode((string) $response->getBody(), true);

        return response()->json([
            'data' => [
                'token' => $token
            ]
        ]);
    }
}

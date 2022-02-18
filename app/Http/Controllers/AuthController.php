<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);
        if ($validated) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('posts.index');
            } else {
                return redirect()->back()->with('error', 'User credential error!');
            }
        } else {
            return redirect()->back()->with('error', 'Validation Error!');
        }
    }

    public function register(UserRequest $request)
    {
        $validated = $request->validated();
        $bol = User::create($validated);
        if ($bol) return redirect()->route('login')->with('success', 'Register Success, Please Login Sir!');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('user_login');
    }
}

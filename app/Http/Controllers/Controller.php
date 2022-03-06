<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard()
    {
        if ($this->isLoggedIn()) {
            $user = User::where('email', '=', Session::get('user'))->first();
            return view('dashboard', ['user' => $user]);
        }
        return redirect('/login');
    }

    public function isLoggedIn()
    {
        return Session::has('user');
    }

    public function login()
    {
        if ($this->isLoggedIn()) {
            $this->logout();
        }
        return view('login');
    }

    public function logout()
    {
        if (Session::has('user')) {
            Session::pull('user');
        }
        return redirect('/login');
    }

    public function checkLogin(Request $req)
    {
        $user = User::where('email', '=', htmlspecialchars($req->email))->first();
        if ($user) {
            if (Hash::check($req->password, $user->password)) {
                $req->session()->put('user', $user->email);
                return redirect('/');
            }
        }

        return back()->with(['error' => 'Email or password not correct']);
    }
}

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
use App\Models\Data;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard()
    {
        if ($this->isLoggedIn()) {
            $user = User::where('email', '=', Session::get('user'))->first();

            $data = Data::where('user_id', '=', $user->id)->get();
            /*$dataDateTop = Data::where('user_id', '=', $user->id)->orderBy('date', 'ASC');
            $dataDateBottom = Data::where('user_id', '=', $user->id)->orderBy('date', 'DESC');
            $dataTypeTop = Data::where('user_id', '=', $user->id)->orderBy('type', 'ASC');
            $dataTypeBottom = Data::where('user_id', '=', $user->id)->orderBy('type', 'DESC');
            $dataCategoryTop = Data::where('user_id', '=', $user->id)->orderBy('category', 'ASC');
            $dataCategoryBottom = Data::where('user_id', '=', $user->id)->orderBy('category', 'DESC');
            $dataTimeTop = Data::where('user_id', '=', $user->id)->orderBy('time', 'ASC');
            $dataTimeTop = Data::where('user_id', '=', $user->id)->orderBy('time', 'DESC');*/

            return view('dashboard', [
                'user' => $user,
                'data' => $data,
                /*'dataTimeTop' => $dataDateTop,
                'dataDateBottom' => $dataDateBottom,
                'dataTypeTop' => $dataTypeTop,
                'dataTypeBottom' => $dataTypeBottom,
                'dataCategoryTop' => $dataCategoryTop,
                'dataCategoryTop' => $dataCategoryTop,
                'dataCategoryBottom' => $dataCategoryBottom,
                'dataTimeTop' => $dataTimeTop,
                'dataTimeTop' => $dataTimeTop,*/
            ]);
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

    public function checkEntry(Request $req)
    {

        $req->validate([
            'type' => 'required|min:2|max:64|regex:/^[a-zA-Z äöüÄÖÜ]+$/u',
            'category' => 'required',
            'time' => 'required',
        ]);

        $user = User::where('email', '=', htmlspecialchars(Session::get('user')))->first();

        $data = new Data();
        $data->type = htmlspecialchars($req->type);
        $data->time =  htmlspecialchars($req->time);
        $data->category =  htmlspecialchars($req->category);
        $data->notes =  htmlspecialchars($req->note);
        $data->user_id = $user->id;
        if ($data->save()) {
            return 1;
        }

        return 0;
    }
}

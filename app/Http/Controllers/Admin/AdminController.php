<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Guards;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
//    public function index()
//    {
//        return view('admin.home');
//    }
    public function loginView()
    {
        return view('admin.login.index');
    }
    public function login()
    {
//        dd(request()->toArray());
        //active olanlar gelir
        if(Auth::guard('admin')->attempt(['email'=>request()->email,'password'=>request()->password],true)){
            return redirect()->route('products');
        }
        return redirect()->back();
    }

    public function logout()
    {
        if(auth()->guard(Guards::ADMIN->value)->check()) {
            auth()->guard(Guards::ADMIN->value)->logout();
        }
        return redirect()->route('admin.login-view');
    }
}

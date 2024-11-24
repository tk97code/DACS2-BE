<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $data = [];

    public function index() {

        $isLogin = false;
        
        if (Auth::check()) {
            $isLogin = true;
        } else {
            $isLogin = false;
        }
        return view("home", compact('isLogin'));
    }
}

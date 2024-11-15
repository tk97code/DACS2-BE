<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $data = [];

    public function index() {
        
        if (Auth::check()) {
            $this->data['isLogin'] = true;
        } else {
            $this->data['isLogin'] = false;
        }
        return view("home", $this->data);
    }
}

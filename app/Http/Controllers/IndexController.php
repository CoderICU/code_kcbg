<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (isMobile()) {
                return view('index');
            } else {
                return view('home');
            }
        } else {
            return redirect()->route('login');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('index');
        } else {
            return redirect()->route('login');
        }
    }
}

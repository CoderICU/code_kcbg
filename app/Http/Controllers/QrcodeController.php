<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Code;

class QrcodeController extends Controller
{
    public function newqr()
    {
        $code = Code::create();
        return view('qr.newqr', compact('code'));
    }

    public function deqr()
    {
        return view('qr.deqr');
    }
}

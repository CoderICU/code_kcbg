<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributesController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $attrs = Attribute::paginate(20);
        return view('attrs.index', compact('attrs'));
    }
}

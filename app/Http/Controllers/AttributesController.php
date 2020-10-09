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

    public function store(Request $request)
    {
        $rules = [
            'name' => 'unique:attributes'
        ];
        $message = [
            'name.unique' => '规格已存在'
        ];
        $this->validate($request, $rules, $message);
        $attr = Attribute::create([
            'name' => $request->name,
            'type' => $request->type
        ]);
        return json_encode(['code'=> 200, 'msg'=> '保存成功']);
    }
}

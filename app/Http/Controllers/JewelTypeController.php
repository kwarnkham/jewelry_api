<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\JewelType;

class JewelTypeController extends Controller
{
    public function index()
    {
        $jewelTypes = JewelType::all();
        return ['code' => '0', 'msg' => 'ok', 'result' => ['jewel_types' => $jewelTypes]];
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return ['code' => '1', 'msg' => $validator->errors()->first()];
        }

        if (JewelType::where('name', $request->name)->exists()) {
            return ['code' => '1', 'msg' => "$request->name already exists"];
        }

        $input = $request->only(['name']);

        $jewelType = JewelType::create($input);

        return ['code' => '0', 'msg' => 'ok', 'result' => ['jewel_type' => $jewelType]];
    }
}

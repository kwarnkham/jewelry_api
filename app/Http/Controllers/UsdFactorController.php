<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\UsdFactor;
use Illuminate\Support\Facades\DB;

class UsdFactorController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|numeric|min:1',
        ]);
        if ($validator->fails()) {
            return ['code' => '1', 'msg' => $validator->errors()->first()];
        }
        $lastFactor = DB::table('usd_factors')->latest()->first();
        if ($lastFactor->value == $request->value) {
            return ['code' => '1', 'msg' => "USD value is already $request->value"];
        }
        $factor = UsdFactor::create($request->only(['value', 'name']));

        return ['code' => '0', 'msg' => 'ok', 'result' => ['factor' => $factor]];
    }

    public function index()
    {
        $factor = DB::table('usd_factors')->latest()->first();
        return ['code' => '0', 'msg' => 'ok', 'result' => ['factor' => $factor]];
    }
}

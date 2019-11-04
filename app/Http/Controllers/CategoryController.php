<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return ['code' => '1', 'msg' => $validator->errors()->first()];
        }

        if (Category::where('name', $request->name)->exists()) {
            return ['code' => '1', 'msg' => "$request->name already exists"];
        }

        $input = $request->only(['name']);
        $category = Category::create($input);

        return ['code' => '0', 'msg' => 'ok', 'result' => ['category' => $category]];
    }

    public function index()
    {
        $categories = Category::all();
        return ['code' => '0', 'msg' => 'ok', 'result' => ['categories' => $categories]];
    }
}

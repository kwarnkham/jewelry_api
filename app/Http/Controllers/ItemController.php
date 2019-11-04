<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return ['code' => '0', 'msg' => 'ok', 'result' => [
            'items' => $items
        ]];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'jewel_types' => 'required|array',
            'categories' => 'required|array',
        ]);
        if ($validator->fails()) {
            return ['code' => '1', 'msg' => $validator->errors()->first()];
        }

        if (Item::where('name', $request->name)->exists()) {
            return ['code' => '1', 'msg' => "$request->name already exists"];
        }

        $item = Item::create($request->only(['name', 'description', 'price']));
        $item->categories()->sync($request->categories);
        $item->jewelTypes()->sync($request->jewel_types);
        $item = Item::find($item->id);

        return ['code' => '0', 'msg' => 'ok', 'result' => [
            'item' => $item
        ]];
    }
}

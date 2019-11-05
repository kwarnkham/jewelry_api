<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Item;
use Illuminate\Support\Facades\Storage;

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
            'files' => 'required|array',
            'files.*' => 'image',
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
        foreach ($request->file('files') as $image) {
            $savedImage = basename(Storage::putFile('public/item_images', $image));
            \App\ItemImage::create(['name' => $savedImage, 'item_id' => $item->id]);
        }
        $item = Item::find($item->id);

        return ['code' => '0', 'msg' => 'ok', 'result' => [
            'item' => $item
        ]];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemImage;

class ItemImageController extends Controller
{
    public function index()
    {
        $images = ItemImage::all();
        return ['code' => '0', 'msg' => 'ok', 'result' => ['images' => $images]];
    }
}

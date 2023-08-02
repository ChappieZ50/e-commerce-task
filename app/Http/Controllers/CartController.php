<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store()
    {
        return response()->json([
           'status' => auth()->guard('api')->check() ? 200 : 401
        ]);
    }
}

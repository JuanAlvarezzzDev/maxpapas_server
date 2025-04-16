<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    function index(){
        return response()->json(Coin::all(), 200);
    }
}

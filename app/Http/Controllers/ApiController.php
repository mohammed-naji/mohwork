<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    function products() {
        $products = Http::get('https://dummyjson.com/products')->json();

        return view('api_products', compact('products'));
    }

    function weather() {
        return view('weather');
    }
}

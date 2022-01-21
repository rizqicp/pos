<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('welcome', compact('products'));
    }
}

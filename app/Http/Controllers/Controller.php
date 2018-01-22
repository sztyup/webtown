<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Controller extends BaseController
{
    use ValidatesRequests;

    public function index()
    {
        $products = [
            new Product('téliszalámi', 2000),
            new Product('gumikacsa', 3000),
            new Product('uborka', 2800, true),
            new Product('gesztenye', 1000, true)
        ];

        return view('index', [
            'products' => $products
        ]);
    }

    public function post(Request $request)
    {
        return view('index');
    }
}

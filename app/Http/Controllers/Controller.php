<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Manager;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Collection;

class Controller extends BaseController
{
    use ValidatesRequests;

    /**
     * @return Collection|Product[]
     */
    protected function getDefaultProducts()
    {
        return Collection::make([
            new Product('téliszalámi', 2000),
            new Product('gumikacsa', 3000),
            new Product('uborka', 2800, true),
            new Product('gesztenye', 1000, true)
        ]);
    }

    public function index()
    {
        return view('index', [
            'products' => $this->getDefaultProducts()
        ]);
    }

    public function post(Request $request, Manager $manager)
    {
        /** @var Product[] $products */
        $products = $this->getDefaultProducts()->mapWithKeys(function (Product $product) {
            return [$product->getId() => $product];
        });

        $validator = [];
        foreach ($products as $product) {
            $validator += [$product->getId() => 'required|integer'];
        }

        $amounts = $this->validate($request, $validator, [
            'required' => 'Minden termék darabszámának a kitöltése kötelező'
        ]);

        $cart = new Cart();

        foreach ($amounts as $productId => $amount) {
            $cart->addProduct($products[$productId], intval($amount));
        }

        $manager->processCart($cart);

        return view('index', [
            'cart' => $cart,
            'products' => $this->getDefaultProducts()
        ]);
    }
}

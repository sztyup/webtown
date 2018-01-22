<?php

namespace App\Discounts;

use App\Cart;
use App\Product;

class MegapackDiscount implements DiscountInterface
{
    const NAME = 'megapack';
    const AMOUNT = 12;

    public function calculateDiscount(Cart $cart): int
    {
        $discount = 0;

        /** @var Product[] $products */
        foreach ($cart->getProducts() as $product) {
            if ($product['type']->isMegapack()) {
                $amount = floor($product['amount'] / self::AMOUNT);
                $discount += $amount * $product['type']->getPrice();
            }
        }

        return $discount;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}

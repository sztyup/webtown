<?php

namespace App\Discounts;

use App\Cart;
use App\Product;

class MegapackDiscount implements DiscountInterface
{
    const NAME = 'megapack';
    const COUNT = 12;
    const AMOUNT = 6000;

    public function calculateDiscount(Cart $cart): int
    {
        $discount = 0;

        /** @var Product[] $products */
        foreach ($cart->getProducts() as $product) {
            if ($product['type']->isMegapack()) {
                $amount = floor($product['amount'] / self::COUNT);
                $discount += $amount * self::AMOUNT;
            }
        }

        return $discount;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}

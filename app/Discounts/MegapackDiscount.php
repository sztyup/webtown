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
        foreach ($cart->getProducts() as $productId => $products) {
            if ($products[0]->isMegapack()) {
                $amount = floor(count($products) / self::AMOUNT);
                $discount += $amount * $products[0]->getPrice();
            }
        }

        return $discount;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}

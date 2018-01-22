<?php

namespace App\Discounts;

use App\Cart;
use App\Product;

class BasicDiscount implements DiscountInterface
{
    const NAME = '1-et fizet, kettőt kap';

    /** The amount from where the discount should be applied */
    const COUNT = 3;

    public function calculateDiscount(Cart $cart): int
    {
        $discount = 0;

        /** @var Product[] $products */
        foreach ($cart as $id => $products) {
            $amount = floor(count($products) / self::COUNT);
            $discount += $amount * $products[0]->getPrice();
        }

        return $discount;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}

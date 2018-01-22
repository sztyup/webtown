<?php

namespace App\Discounts;

use App\Cart;

interface DiscountInterface
{
    /**
     * This function applies a discount to a set of products given (the Cart)
     * and gives back the amount of the discount
     *
     * @param Cart $cart
     * @return int
     */
    public function calculateDiscount(Cart $cart): int;

    public function getName(): string;
}

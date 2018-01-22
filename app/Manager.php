<?php

namespace App;

use App\Discounts\DiscountInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;

class Manager
{
    /** @var DiscountInterface[] */
    protected $discounts;

    protected $selected;

    protected $discountedPrice;

    public function __construct(Container $container, Repository $config)
    {
        foreach ($config->get('discounts.discounts') as $discount) {
            /** @var DiscountInterface $class */
            $this->discounts[] = $container->make($discount);
        }
    }

    /**
     * Determines which discount is the best for the given cart, and applies that to it
     *
     * @param Cart $cart
     */
    public function processCart(Cart $cart)
    {
        /** @var int $max */
        $max = 0;

        /** @var DiscountInterface Holds the so far best discount $biggest */
        $biggest = null;

        foreach ($this->discounts as $discount) {
            $current = $discount->calculateDiscount($cart);

            if ($current > $max) {
                $max = $current;
                $biggest = $discount;
            }
        }

        // If there is any applicable discount
        if ($biggest) {
            $cart->applyDiscount($biggest, $max);
        }
    }
}

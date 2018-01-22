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

    public function processCart(Cart $cart)
    {
        $max = 0;
        $biggest = null;
        foreach ($this->discounts as $discount) {
            $current = $discount->calculateDiscount($cart);

            if ($current > $max) {
                $max = $current;
                $biggest = $discount;
            }
        }

        if ($biggest) {
            $cart->applyDiscount($biggest, $max);
        }
    }
}

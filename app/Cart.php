<?php

namespace App;

use App\Discounts\DiscountInterface;
use Illuminate\Support\Collection;

class Cart
{
    protected $products;

    protected $discount;

    protected $finalPrice;

    /**
     * Adds the given product to the cart
     *
     * @param Product $product
     * @return $this
     */
    public function addProduct(Product $product)
    {
        $this->products[$product->getId()][] = $product;

        return $this;
    }

    /**
     * Gets all the product in the cart
     *
     * @return array[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    public function getPrice()
    {
        return Collection::make($this->products)->map->getPrice()->sum();
    }

    public function applyDiscount(DiscountInterface $discount, int $amount)
    {
        $this->discount = $discount;
        $this->finalPrice = $this->getPrice() - $amount;
    }
}

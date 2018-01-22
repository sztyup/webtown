<?php

namespace App;

use App\Discounts\DiscountInterface;

class Cart
{
    /**
     * @var array|Product[]
     */
    protected $products = [];

    protected $discount;

    protected $finalPrice;

    /**
     * Adds the given product to the cart
     *
     * @param Product $product
     * @param $amount
     * @return $this
     */
    public function addProduct(Product $product, int $amount)
    {
        if ($amount == 0) {
            return $this;
        }

        if (!in_array($product->getId(), $this->products)) {
            $this->products[$product->getId()] = [
                'type' => $product,
                'amount' => $amount
            ];
        } else {
            $this->products[$product->getId()]['amount'] += $amount;
        }

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

    public function getOriginalPrice()
    {
        $price = 0;

        foreach ($this->products as $product) {
            $price = $product['amount'] * $product['type']->getPrice();
        }

        return $price;
    }

    public function getFinalPrice()
    {
        return $this->finalPrice ?? $this->getOriginalPrice();
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function applyDiscount(DiscountInterface $discount, int $amount)
    {
        $this->discount = $discount;
        $this->finalPrice = $this->getOriginalPrice() - $amount;
    }
}

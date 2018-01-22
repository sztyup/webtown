<?php

namespace App;

use App\Discounts\DiscountInterface;

class Cart
{
    /**
     * @var array|Product[]
     */
    protected $products = [];

    /** @var DiscountInterface */
    protected $discount;

    /** @var int */
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

    /**
     * Get the original price wihtout discounts applied
     *
     * @return int
     */
    public function getOriginalPrice()
    {
        $price = 0;

        foreach ($this->products as $product) {
            $price += $product['amount'] * $product['type']->getPrice();
        }

        return $price;
    }

    /**
     * Returns the final price after applying discounts
     *
     * @return int
     */
    public function getFinalPrice()
    {
        return $this->finalPrice ?? $this->getOriginalPrice();
    }

    /**
     * Gets the class representing the applied discount
     *
     * @return DiscountInterface
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Applies the given discount to the cart
     *
     * @param DiscountInterface $discount
     * @param int $amount
     */
    public function applyDiscount(DiscountInterface $discount, int $amount)
    {
        $this->discount = $discount;
        $this->finalPrice = $this->getOriginalPrice() - $amount;
    }

    /**
     * Get the amount of a given product in the cart
     *
     * @param Product $product
     * @return int
     */
    public function getAmountOf(Product $product)
    {
        if (array_key_exists($product->getId(), $this->products)) {
            return $this->products[$product->getId()]['amount'];
        }

        return 0;
    }
}

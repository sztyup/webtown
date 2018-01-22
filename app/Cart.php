<?php

namespace App;

class Cart
{
    protected $products;

    public function __construct()
    {
    }

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
}

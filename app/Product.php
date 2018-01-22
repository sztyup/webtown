<?php

namespace App;

class Product
{
    /**
     * @var string Internally generated unique id
     */
    protected $id;

    /**
     * @var string Name of the product
     */
    protected $name;

    /**
     * @var int Price of the product
     */
    protected $price;

    /**
     * @var bool Wheter the megapack discount can be applied to this product
     */
    protected $megapack;

    public function __construct(string $name, int $price, bool $megapack = false)
    {
        $this->id = md5($name);
        $this->name = $name;
        $this->price = $price;
        $this->megapack = $megapack;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function isMegapack()
    {
        return $this->megapack;
    }
}

<?php

namespace App;

class Product
{
    protected $id;

    protected $name;

    protected $price;

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

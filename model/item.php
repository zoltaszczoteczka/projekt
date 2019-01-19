<?php

class Item
{
    private $id_item;
    private $name;
    private $price;


    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setprice($price): void
    {
        $this->price = $price;
    }


    public function getId_item()
    {
        return $this->id_item;
    }

};
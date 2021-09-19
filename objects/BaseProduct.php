<?php
Abstract class BaseProduct{
    // product attributes
    protected $productId;
    protected $SKU;
    protected $name;
    protected $price;
    
    abstract protected function read();

    abstract protected function insert();

    abstract protected function delete();

    abstract protected function setProductId($productId);

    abstract protected function setSKU($SKU);

    abstract protected function setName($name);

    abstract protected function setPrice($price);

    abstract protected function getProductId();

    abstract protected function getSKU();

    abstract protected function getName();

    abstract protected function getPrice();
}
?>
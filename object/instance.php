<?php

class Product
{

    // アクセス修飾子
    private $product = [];

    // 関数
    // 初回
    function __construct($product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        echo $this->product;
    }

    public function addProduct($item)
    {
        $this->product .= $item;
    }

    public static function getStaticProduct($str)
    {
        echo $str;
    }
}

$instance = new Product("testです");

$instance->getProduct();
echo "<br>";

$instance->addProduct("追加しました");
echo "<br>";

$instance->getProduct();
echo "<br>";

var_dump($instance);

Product::getStaticProduct("静的");

<?php

abstract class ProductAbstract
{
    public function echoProduct()
    {
        echo "親クラスです";
    }

    abstract public function getProduct();
}


class Product extends ProductAbstract
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

$instance->echoProduct();

$instance->getProduct();
echo "<br>";

$instance->addProduct("追加しました");
echo "<br>";

$instance->getProduct();
echo "<br>";

var_dump($instance);

Product::getStaticProduct("静的");

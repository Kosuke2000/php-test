<?php

interface ProductInterface
{
    public function getProduct();
}

interface NewsInterface
{
    public function getNews();
}


class Product implements ProductInterface, NewsInterface
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

    public function getNews()
    {
        echo "インターフェイスが強制しました";
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

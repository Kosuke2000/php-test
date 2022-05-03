<?php

trait ProductTrait
{

    public function getProduct()
    {
        echo "プロダクト";
    }
}

trait NewsTrait
{

    public function getNews()
    {
        echo "ニュース";
    }
}

class Product1
{

    use ProductTrait;
    use NewsTrait;

    public function getInfomation()
    {
        echo "クラスです";
    }
}

$product = new Product1();

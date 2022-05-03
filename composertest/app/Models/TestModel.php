<?php

namespace APP\Models;

class TestModel
{
    public $text = "Hello world";

    public function getHello()
    {
        return $this->text;
    }
}

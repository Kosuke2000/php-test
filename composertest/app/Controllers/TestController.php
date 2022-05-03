<?php

namespace APP\Controllers;

use APP\Models\TestModel;

class TestController
{
    public function run()
    {
        $model = new TestModel;
        echo $model->getHello();
    }
}

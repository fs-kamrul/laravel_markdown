<?php

namespace kamrul\Press\Http\Controllers;

use Illuminate\Container\Container;

class TestController extends Container
{
    public function index()
    {
        return 'in controller';
    }
}

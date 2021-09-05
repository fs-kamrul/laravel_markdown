<?php

namespace kamrul\Press\Facades;


use Illuminate\Support\Facades\Facade;

class Press extends Facade
{
    protected static function getFacadeAccessor()
    {
        /**
         * Get the registered name of the component.
         *
         * @return string
         */
        return 'Press';
    }
}

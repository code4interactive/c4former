<?php namespace Code4\C4former\Facades;

use Illuminate\Support\Facades\Facade;

class C4former extends Facade
{
    /**
     * Get the registered component.
     *
     * @return object
     */
    protected static function getFacadeAccessor()
    {
        return 'c4former';
    }
}
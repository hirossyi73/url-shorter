<?php

namespace Hirossyi73\UrlShorter\Facades;

use Illuminate\Support\Facades\Facade;

class UrlShorterFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Hirossyi73\UrlShorter\UrlShorter::class;
    }
}

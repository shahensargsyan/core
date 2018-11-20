<?php namespace App\Other\Facades;

use Illuminate\Support\Facades\Facade;

class Misc extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'App\Other\Misc';
    }

}

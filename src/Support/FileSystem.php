<?php

namespace Maestriam\FileSystem\Support;

use Illuminate\Support\Facades\Facade;

class FileSystem extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'filesystem';
    }
}
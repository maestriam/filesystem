<?php

namespace Maestriam\FileSystem\Concerns;

use Illuminate\Support\Facades\Cache;

trait HandlesCache
{
    private function cache(string $key)
    {
        $exp  = "filesystem.default.%s";
        $name = sprintf($exp, $key);

        return Cache::get($name);
    }
}
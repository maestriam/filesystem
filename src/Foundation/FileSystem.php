<?php

namespace Maestriam\FileSystem\Foundation;

use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Foundation\Drive\PathSanitizer;

class FileSystem
{
    public function drive(string $name) : Drive
    {
        return new Drive($name);
    }

    public function sanitize(string $path) : string
    {
        return PathSanitizer::sanitize($path);
    }
}
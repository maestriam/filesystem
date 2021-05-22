<?php

namespace Maestriam\FileSystem\Foundation;

use Maestriam\FileSystem\Entities\folder;
use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Foundation\Drive\PathSanitizer;

class FileSystem
{
    public function drive(string $name) : Drive
    {
        return new Drive($name);
    }

    public function folder(string $path) : Folder
    {
        return new Folder($path);
    }

    public function sanitize(string $path) : string
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);

        return PathSanitizer::sanitize($path);
    }
}
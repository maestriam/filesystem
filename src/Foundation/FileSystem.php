<?php

namespace Maestriam\FileSystem\Foundation;

use Maestriam\FileSystem\Entities\Folder;
use Maestriam\FileSystem\Foundation\Drive;

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
}
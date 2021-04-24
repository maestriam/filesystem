<?php

namespace Maestriam\FileSystem\Foundation;

use Maestriam\FileSystem\Foundation\Drive;

class FileSystem
{
    public function drive(string $name) : Drive
    {
        return new Drive($name);
    }
}
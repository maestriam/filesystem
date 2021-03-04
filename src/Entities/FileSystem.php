<?php

namespace Maestriam\FileSystem\Entities;

use Illuminate\Support\Str;
use Maestriam\FileSystem\Contracts\FileSystemInterface;

class FileSystem implements FileSystemInterface
{        
    public function drive(string $name = null) : Drive
    {
        return (! $name) ? $this->default() : new Drive($name);
    }

    public function default() : Drive
    {
        return new Drive('filesystem.default');
    }
    
    
}
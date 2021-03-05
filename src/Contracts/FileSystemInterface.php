<?php

namespace Maestriam\FileSystem\Contracts;

use Maestriam\FileSystem\Foundation\Drive;

interface FileSystemInterface 
{   
    public function default() : Drive;
    
    public function drive(string $name = null) : Drive;
}
<?php

namespace Maestriam\FileSystem\Entities;

use Maestriam\FileSystem\Contracts\SystemInterface;

class Folder implements SystemInterface
{        
    public function create() : Folder
    {
        return $this;
    }

    public function delete() 
    {
        
    }

    public function exists() : bool
    {
        return false;
    }
    
    public function find() : Folder
    {
        return $this;
    }

    public function findOrFail() : Folder
    {
        return $this;
    }

    public function findOrCreate() : Folder
    {
        return $this;
    }
}
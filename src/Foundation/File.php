<?php

namespace Maestriam\FileSystem\Foundation;

use Maestriam\FileSystem\Contracts\SystemInterface;

class File extends Data
{        
    public function create() : File
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
    
    public function find() : File
    {
        return $this;
    }

    public function findOrFail() : File
    {
        return $this;
    }

    public function findOrCreate() : File
    {
        return $this;
    }
}
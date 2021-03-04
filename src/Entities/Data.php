<?php

namespace Maestriam\FileSystem\Entities;

use Maestriam\FileSystem\Contracts\SystemInterface;

abstract class Data implements SystemInterface
{      
    protected string $name;
    
    public function __construct(string $name)
    {
        $this->setName($name);
    }

    private function setName(string $name) : Data
    {
        $this->name = $name;
        return $this;
    }
}
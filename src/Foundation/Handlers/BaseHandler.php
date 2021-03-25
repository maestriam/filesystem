<?php

namespace Maestriam\FileSystem\Foundation;

abstract class BaseHandler
{      
    protected string $name;

    protected Drive $drive;
    
    public function __construct(string $name, Drive $drive)
    {
        $this->setName($name)->setDrive($drive);
    }

    private function setName(string $name) : BaseHandler
    {
        $this->name = $name;
        return $this;
    }

    private function setDrive(Drive $drive) : BaseHandler
    {
        $this->drive = $drive;
        return $this;
    }
}
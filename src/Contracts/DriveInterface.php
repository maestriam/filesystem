<?php

namespace Maestriam\FileSystem\Contracts;

use Maestriam\FileSystem\Foundation\Folder;
use Maestriam\FileSystem\Foundation\File\FileHandler;

interface DriveInterface 
{
    public function file(string $name) : FileHandler;

    public function folder(string $name) : Folder;

    public function save();
}
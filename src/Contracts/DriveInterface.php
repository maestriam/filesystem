<?php

namespace Maestriam\FileSystem\Contracts;

use Maestriam\FileSystem\Foundation\File;
use Maestriam\FileSystem\Foundation\Folder;

interface DriveInterface 
{
    public function file(string $name) : File;

    public function folder(string $name) : Folder;

    public function save();
}
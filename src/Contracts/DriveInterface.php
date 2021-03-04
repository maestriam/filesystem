<?php

namespace Maestriam\FileSystem\Contracts;

use Maestriam\FileSystem\Entities\File;
use Maestriam\FileSystem\Entities\Folder;

interface DriveInterface 
{
    public function file(string $name) : File;

    public function folder(string $name) : Folder;

    public function save();
}
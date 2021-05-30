<?php

namespace Maestriam\FileSystem\Entities;

use Maestriam\FileSystem\Foundation\Drive\PathSanitizer;

class Folder
{
    private string $path;

    public function __construct(string $path)
    {
        $this->setPath($path);
    }

    public function sanitize()
    {
        return PathSanitizer::sanitize($this->path);
    }

    public function create()
    {
        if ($this->exists()) {
            return true;
        }

        mkdir($this->path, 0755, true);
    }

    public function delete(string $path = null)
    {
        $folder = $path ?? $this->path;

        $files = array_diff(scandir($folder), array('.', '..'));

        foreach ($files as $file) { 

            $item = "$folder/$file";

            is_dir($item) ? $this->delete($item) : unlink($item); 
        }

        return rmdir($folder);
    }

    public function exists() : bool
    {
        return (is_dir($this->path));
    }

    private function setPath(string $path)
    {
        $this->path = $path;
        return $this;
    }
}
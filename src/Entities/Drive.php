<?php

namespace Maestriam\FileSystem\Entities;

use Maestriam\FileSystem\Concerns\FluentCalls;
use Maestriam\FileSystem\Concerns\HandlesCache;
use Maestriam\FileSystem\Entities\File;
use Illuminate\Support\Facades\Cache;
use Maestriam\FileSystem\Contracts\DriveInterface;

class Drive implements DriveInterface
{
    use FluentCalls, HandlesCache;

    private string $rootFolder;

    public function __construct(string $name)
    {
        $this->name($name);
    }


    public function file(string $name) : File
    {
        return new File($name);    
    }

    public function folder(string $name) : Folder
    {
        return new Folder($name);
    }

    public function save() : Drive
    {
        $this->setCache('root', $this->root());
        $this->setCache('template', $this->template());
        $this->setCache('structure', $this->structure());      
        
        return $this;
    }

    private function setName(string $name) : Drive
    {
        $this->name = strtolower($name);
        return $this;
    }

    private function getName() : string
    {
        return $this->name;
    }

    private function setTemplate(string $folder) : Drive
    {
        $this->templateFolder = $folder;
        return $this;
    }

    private function getTemplate() : string
    {
        $cached = Cache::get('filesystem.default.template');

        return $this->templateFolder ?? Cache::get('filesystem.default.template');
    }

    private function setStructure(array $structure) : Drive
    {
        $this->structure = $structure;
        return $this;
    }
    
    private function getStructure() : array
    {
        return $this->structure ?? Cache::get('filesystem.default.structure');
    }

    private function setRoot(string $rootFolder) : Drive
    {
        $this->rootFolder = $rootFolder;
        return $this;
    }
    
    private function getRoot() : string
    {
        return $this->rootFolder ?? Cache::get('filesystem.default.root');
    }

    private function setCache(string $key, $value)
    {
        $cache = sprintf("%s.%s", $this->name(), $key);
      
        Cache::put($cache, $value);
    }
}
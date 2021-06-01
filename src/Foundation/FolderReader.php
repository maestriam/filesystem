<?php

namespace Maestriam\FileSystem\Foundation;

abstract class FolderReader
{
    static private array $list = [];

    static public function read(string $path, int $level) : array
    {
        if (! is_dir($path)) return [];

        self::scan($path, 1, $level);

        return self::$list;
    }

    static private function scan(string $path, int $step, int $level) : void
    {
        $folder = '';
        $items  = array_diff(scandir($path), array('.', '..'));        
        
        foreach($items as $item) {

            $folder = "$path/$item"; 

            if (! is_dir($folder)) {
                continue;
            }
            
            if (is_dir($folder) && $step < $level) {
                self::scan($folder, $step+1, $level);
            }

            if ($step == $level) {
                self::add($folder, $level);
            }
        }
    }
    
    static private function add(string $path, int $level) : void
    {
        $folder = self::prepare($path, $level);
        
        array_push(self::$list, $folder);
    }

    static private function prepare(string $path, int $level) : string
    {
        $path = str_replace(DS, '/', $path);

        $pieces = explode('/', $path);
        $pieces = array_splice($pieces, - $level);

        return implode('/', $pieces);
    }
}
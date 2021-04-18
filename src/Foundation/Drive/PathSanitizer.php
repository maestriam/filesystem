<?php

namespace Maestriam\FileSystem\Foundation\Drive;

abstract class PathSanitizer
{    
    /**
     * Ajusta uma string de caminho para 
     *
     * @param string $path
     * @return string
     */
    public static function sanitize(string $path) : string
    {
        $path = self::replaceSeparator($path);
        $path = self::removeDoubleSlashes($path);
        
        return $path;
    }

    private static function replaceSeparator(string $path) : string
    {
        $anti = (DS == '/') ? '\\' : '/';

        return str_replace($anti, DS, $path);
    }

    private static function removeDoubleSlashes(string $path) : string
    {
        $search = DS . DS;

        return str_replace($search, DS, $path);
    }
}
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
        $path = self::replaceInverseSlashes($path);
        
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

    private static function replaceInverseSlashes(string $path) : string
    {
        $anti = '/\\';
        $path = str_replace($anti, DS, $path);
        
        $anti = '\//';
        $path = str_replace($anti, DS, $path);

        return $path;
    }
}
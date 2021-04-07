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
        $anti = (DS == '/') ? '\\' : '/';

        return str_replace($anti, DS, $path);
    }
}
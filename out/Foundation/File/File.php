<?php

namespace Maestriam\FileSystem\Foundation\File;

class File
{
    /**
     * Nome do arquivo
     */    
    public string $filename;
    
    /**
     * Caminho completo do arquivo
     */
    public string $path;

    /**
     * Diretório onde está armazenado
     */
    public string $location;

    /**
     * Conteúdo inserido no arquivo
     */
    public string $content;    
}
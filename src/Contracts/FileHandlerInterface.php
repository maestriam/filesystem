<?php

namespace Maestriam\FileSystem\Contracts;

use Maestriam\FileSystem\Foundation\File\File;

interface FileHandlerInterface 
{   
    public function delete();
    
    public function exists() : bool;

    public function find() : ?File;

    public function findOrFail() : File;
    
    /**
     * Executa a criação de um novo arquivo, baseado em um template
     *
     * @param array $args
     * @return File
     */
    public function create(array $args = []) : File;
    
    public function findOrCreate(array $args = []) : File;

    /**
     * Define que o arquivo irá se basear em um template
     *
     * @param string $template
     * @return File
     */
    public function basedOn(string $template) : FileHandlerInterface;
}
<?php

namespace Maestriam\FileSystem\Foundation;

use Maestriam\FileSystem\Foundation\File\FileHandler;
use Maestriam\FileSystem\Foundation\File\FileInfo;

class File
{
    /**
     * 
     */
    private string $name = '';

    /**
     * 
     */
    private string $folder = '';

    /**
     * 
     */
    private FileHandler $handler;

    /**
     * Undocumented function
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setName($name);
    }

    /**
     * Retorna/Define o nome e a extensão do arquivo
     *
     * @param string $name
     * @return void
     */
    public function name(string $name = null)
    {
        return (! $name) ? $this->getName() : 
                           $this->setName($name);
    }

    /**
     * Define o nome e a extensão do arquivo
     *
     * @param string $name
     * @return File
     */
    public function setName(string $name) : File
    {
        $this->name = $name;        
        return $this;
    }
    
    /**
     * Retorna o nome e a extensão do arquivo
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Retorna/Define o diretório onde 
     *
     * @param string $folder
     * @return void
     */
    public function folder(string $folder = null)
    {
        return (! $folder) ? $this->getFolder() : 
                             $this->setFolder($folder);
    }    

    /**
     * Retorna o diretório do arquivo
     *
     * @param string $folder
     * @return void
     */
    public function setFolder(string $folder) : File
    {
        $this->folder = $folder; 
               
        return $this;
    }

    /**
     * Retorna o nome e a extensão do arquivo
     *
     * @return string
     */
    public function getFolder() : string
    {
        return $this->folder;
    }

    /**
     * Undocumented function
     *
     * @return FileHandler
     */
    private function initHandler() : FileHandler
    {
        if (! $this->folder || ! $this->name) {
            throw new \Exception("Error Processing Request");            
        }

        return new FileHandler($this->folder, $this->name);
    }
    
    /**
     * Cria um novo arquivo com 
     *
     * @param string $content
     * @return FileInfo
     */
    public function create(string $content) : FileInfo
    {
        return $this->initHandler()->create($content);
    }
}
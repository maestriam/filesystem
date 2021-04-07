<?php

namespace Maestriam\FileSystem\Foundation;

class File
{
    private string $name = '';

    private string $folder = '';

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
    private function setName(string $name) : File
    {
        $this->name = $name;        
        return $this;
    }
    
    /**
     * Retorna o nome e a extensão do arquivo
     *
     * @return string
     */
    private function getName() : string
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
    private function setFolder(string $folder)
    {
        $this->folder = $folder;        
        return $this;
    }

    /**
     * Retorna o nome e a extensão do arquivo
     *
     * @return string
     */
    private function getFolder() : string
    {
        return $this->folder;
    }

    public function create(string $content)
    {
        
    }
}
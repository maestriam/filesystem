<?php

namespace Maestriam\FileSystem\Entities;

use Maestriam\FileSystem\Entities\File;
use Maestriam\FileSystem\Concerns\FluentCalls;
use Maestriam\FileSystem\Concerns\HandlesCache;
use Maestriam\FileSystem\Contracts\DriveInterface;

class Drive implements DriveInterface
{
    use FluentCalls, HandlesCache;

    /**
     * Caminho do diretório para criação de arquivos
     */
    private string $rootFolder;

    public function __construct(string $name)
    {
        $this->name($name);
    }

    /**
     * Retorna a instância de manipulação de arquivos
     *
     * @param string $name
     * @return File
     */
    public function file(string $name) : File
    {
        return new File($name);    
    }

    /**
     * Retorna a instância de manipulação de diretórios
     *
     * @param string $name
     * @return Folder
     */
    public function folder(string $name) : Folder
    {
        return new Folder($name);
    }

    /**
     * Salva as configurações definidas para o drive
     *
     * @return Drive
     */
    public function save() : Drive
    {
        $this->cache('root', $this->root());
        $this->cache('template', $this->template());
        $this->cache('structure', $this->structure());      
        
        return $this;
    }

    /**
     * Define o nome do drive
     *
     * @param string $name
     * @return Drive
     */
    private function setName(string $name) : Drive
    {
        $this->name = strtolower($name);
        return $this;
    }

    /**
     * Retorna o nome do drive
     *
     * @return string
     */
    private function getName() : string
    {
        return $this->name;
    }

    /**
     * Define o caminho de templates do drive
     *
     * @param string $folder
     * @return Drive
     */
    private function setTemplate(string $folder) : Drive
    {
        $this->templateFolder = $folder;
        return $this;
    }

    /**
     * Retorna o caminho de templates do drive
     *
     * @return string
     */
    private function getTemplate() : string
    {
        return $this->templateFolder ?? $this->default('template');
    }

    /**
     * Define a estrutura de diretórios de criação de arquivos gerados
     *
     * @param array $structure
     * @return Drive
     */
    private function setStructure(array $structure) : Drive
    {
        $this->structure = $structure;
        return $this;
    }
    
    /**
     * Retorna a estrutura de diretórios de criação de arquivos gerados
     *
     * @param array $structure
     * @return Drive
     */
    private function getStructure() : array
    {
        return $this->structure ?? $this->default('structure');
    }

    /**
     * Define o caminho de destino dos arquivos gerados
     *
     * @param string $rootFolder
     * @return Drive
     */
    private function setRoot(string $rootFolder) : Drive
    {
        $this->rootFolder = $rootFolder;
        return $this;
    }
    
    /**
     * Retorna o caminho de destino dos arquivos gerados
     *
     * @return string
     */
    private function getRoot() : string
    {
        return $this->rootFolder ?? $this->default('root');
    }
}
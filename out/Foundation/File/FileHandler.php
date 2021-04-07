<?php

namespace Maestriam\FileSystem\Foundation\File;

use Maestriam\FileSystem\Concerns\FluentCalls;
use Maestriam\FileSystem\Foundation\File\File;
use Maestriam\FileSystem\Contracts\FileHandlerInterface;
use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Foundation\Template\TemplateHandler;

class FileHandler implements FileHandlerInterface
{        
    private Drive $drive;
    
    public function __construct(string $name, Drive $drive)
    {
        $this->setName($name)->setDrive($drive);
    }

    /**
     * Define o nome do arquivo que será manipulado
     *
     * @param string $name
     * @return FileHandler
     */
    public function setName(string $name) : FileHandler
    {
        $this->name = $name;
        return $this;   
    }

    /**
     * Define o drive de configurações que será utilizado
     *
     * @param Drive $drive
     * @return FileHandler
     */
    private function setDrive(Drive $drive) : FileHandler
    {
        $this->drive = $drive;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $args = []) : File
    {
        return new File();
    }

    /**
     * {@inheritDoc}
     */
    public function basedOn(string $template) : FileHandler
    {
        return $this->loadTemplate($template);
    }

    /**
     * Carrega as regras de negócio para
     *
     * @param string $template
     * @return FileHandler
     */
    private function loadTemplate(string $template) : FileHandler
    {
        $this->template = new TemplateHandler($template, '');

        return $this;        
    }

    private function loadStructure(string $template)
    {
        // $this->structure = new Structure($template, $root);

        // return 
    }

    public function delete() 
    {
    }

    public function exists() : bool
    {
        return false;
    }
    
    public function find() : File
    {
        return new File();
    }

    public function findOrFail() : File
    {
        return new File();
    }

    public function findOrCreate(array $args = []) : File
    {
        return new File();
    }
}
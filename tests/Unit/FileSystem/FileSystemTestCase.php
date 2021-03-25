<?php

namespace Maestriam\FileSystem\Tests\Unit\FileSystem;

use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Foundation\FileSystem;
use Maestriam\FileSystem\Tests\TestCase;

class FileSystemTestCase extends TestCase
{
    /**
     * Retorna a instância de FileSystem
     *
     * @return FileSystem
     */
    protected function filesystem() : FileSystem
    {
        return new FileSystem();
    }

    /**
     * Retorna o caminho de arquivos de template
     *
     * @return string
     */
    protected function getTemplateFolder() : string
    {
        return config('filesystem.folders.template');
    }

    /**
     * Retorna o caminho de estrutura de diretórios
     *
     * @return array
     */
    protected function getFolderStructure() : array
    {
        return config('filesystem.structure');
    }

    /**
     * Retorna o caminho de destino dos arquivos gerados
     *
     * @return string
     */
    protected function getRootFolder() : string
    {
        return config('filesystem.folders.root');
    }
    
    /**
     * Instância/Retorna um drive padrão 
     *
     * @return Drive
     */
    protected function initDefaultDrive() : Drive
    {
        $root      = $this->getRootFolder(); 
        $template  = $this->getTemplateFolder();
        $structure = $this->getFolderStructure();

        $drive = $this->filesystem()->default();

        $drive
            ->structure($structure)
            ->template($template)
            ->root($root)
            ->save();

        return $drive;
    }
}
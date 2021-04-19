<?php

namespace Maestriam\FileSystem\Foundation\Drive;

use Exception;
use Maestriam\FileSystem\Foundation\Drive\StructureDirectory;

class PathFinder
{    
    private array $structureDirectory;

    /**
     * Pesquisa um
     *
     * @param array $structure
     */
    public function __construct(array $structure)
    {
        $this->setStructureDirectory($structure);
    }

    /**
     * Define a estrutura de diretórios baseada em templates
     *
     * @param array $structure
     * @return void
     */
    private function setStructureDirectory(array $structure)
    {
        $this->structureDirectory = $structure;
        
        return $this;
    }
    
    /**
     * Retorna a estrutura de diretórios, baseada em templates
     *
     * @return array
     */
    private function getStructureDirectory() : array
    {
        return $this->structureDirectory;
    }

    /**
     * Retorna o sub-diretório que o arquivo deverá ser armazenado,
     * de acordo com o tipo de template especificado
     *
     * @param string $template
     * @return string
     */
    public function findByTemplate(string $template) : string
    {
        $subfolder = $this->getSpecificSubFolder($template);

        if ($subfolder) {
            return $subfolder;
        }

        $subfolder = $this->getDefaultSubFolder($template);

        if ($subfolder) {
            return $subfolder;
        }
        
        throw new \Exception($template);        
    }

    /**
     * Verifica se o template tem algum diretório específico definido
     *
     * @param string $template
     * @return string|null
     */
    private function getSpecificSubFolder(string $template) : ?string
    {
        $structure = $this->getStructureDirectory();

        return $structure[$template] ?? null;
    }

    /**
     * Verifica se o template tem algum diretório padrão definido
     *
     * @param string $requested
     * @return string|null
     */
    private function getDefaultSubFolder(string $requested) : ?string
    {
        $structure = $this->getStructureDirectory();
        
        foreach($structure as $key => $path)
        {   
            if ($key == '*') {
                return $path;
            }

            $pattern = "/{$key}/";

            if (preg_match($pattern, $requested)) {
                return $path;
            }
        }
        
        return null;
    }
}
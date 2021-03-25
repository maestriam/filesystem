<?php

namespace Maestriam\FileSystem\Foundation;

use Exception;

class Structure
{        
    private array $directories;
    
    private string $rootPath;

    public function __construct(string $root, array $structure)
    {
        $this->setRoot($root)->setStructure($structure);
    }

    private function setRoot(string $path) : Structure
    {
        $this->rootPath = $path;

        return $this;
    }

    private function getRoot() : string
    {
        return $this->rootPath;
    }

    private function setStructure(array $dirs) : Structure
    {
        $this->directories = $dirs;

        return $this;
    }

    /**
     * Indica o caminho onde o arquivo deverá 
     *
     * @param string $file
     * @return string
     */
    public function target(string $template) : string
    {   
        $subfolder = $this->getSubFolder($template);

        return $this->getRoot() . DS . $subfolder;
    }

    /**
     * Retorna a lista de estrutura de diretórios
     *
     * @return array
     */
    private function getStructure() : array
    {
        return $this->directories;
    }

    /**
     * Retorna o sub-diretório que o arquivo deverá ser armazenado,
     * de acordo com o tipo de template especificado
     *
     * @param string $template
     * @return string
     */
    private function getSubFolder(string $template) : string
    {
        $subfolder = $this->getSpecificSubFolder($template);

        if ($subfolder) {
            return $subfolder;
        }

        $subfolder = $this->getDefaultSubFolder($template);

        if ($subfolder) {
            return $subfolder;
        }
        
        throw new Exception($template);        
    }

    /**
     * Verifica se o template tem algum diretório específico definido
     *
     * @param string $template
     * @return string|null
     */
    private function getSpecificSubFolder(string $template) : ?string
    {
        $structure = $this->getStructure();

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
        $structure = $this->getStructure();

        foreach($structure as $key => $path)
        {
            $pattern = "/{$key}/";
        
            if (preg_match($pattern, $requested)) {
                return $path;
            }
        }
        
        return null;
    }
}
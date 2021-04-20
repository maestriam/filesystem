<?php

namespace Maestriam\FileSystem\Foundation\Drive;

use Maestriam\FileSystem\Concerns\FluentGetter;

class StructureDirectory
{    
    use FluentGetter;

    /**
     * Caminho-raíz do projeto
     */
    private string $rootPath = '.';

    /**
     * Caminho onde está os arquivos de template
     */
    private string $templatePath = '.';

    /**
     * Lista de caminhos de template
     */
    private array $pathList = [];

    /**
     * Busc
     */
    private PathFinder $finder;

    /**
     * Define/Retorna o caminho-raíz do projeto, 
     * de acordo com o tipo de parâmetro 
     *
     * @param string $path
     * @return mixed
     */
    public function root(string $path = null)
    {
        return (! $path) ? $this->getRoot() : $this->setRoot($path);
    }
    
    /**
     * Define o caminho-raiz do projeto
     *
     * @param string $path
     * @return StructureDirectory
     */
    public function setRoot(string $path) : StructureDirectory
    {
        $this->rootPath = $path;
        
        return $this;
    }
    
    /**
     * Retorna o caminho-raiz do projeto
     *
     * @param string $path
     * @return StructureDirectory
     */
    private function getRoot() : string
    {
        return $this->rootPath;
    }

    /**
     * Define/Retorna o caminho de diretório de templates 
     *
     * @param string $path
     * @return mixed
     */
    public function template(string $path = null)
    {
        return (! $path) ? $this->getTemplate() : $this->setTemplate($path);
    }

    /**
     * Define o caminho de templates 
     *
     * @param string $path
     * @return mixed
     */    
    public function setTemplate(string $path) : StructureDirectory
    {
        $this->templatePath = $path;
        
        return $this;
    }

    /**
     * Retorna o caminho de templates 
     *
     * @param string $path
     * @return mixed
     */
    private function getTemplate() : string
    {
        return $this->templatePath;
    }
    
     /**
     * Retorna caminho baseado nas configurações de template
     *
     * @param string $file
     * @return string
     */
    public function findByTemplate(string $template) : string
    {   
        $folder = $this->finder->findByTemplate($template);

        $path = $this->root() . DS . $folder . DS;

        return PathSanitizer::sanitize($path); 
    }

    /**
     * 
     *
     * @param array $paths
     * @return mixed
     */
    public function paths(array $paths = null)
    {
        if (! $paths) {
            return $this->getPaths();
        }  
         
        return $this->setPaths($paths)->initFinder();
    }

    /**
     * Inicia a instância com as regras de negócio para pesquisar
     * o diretório apropriado de acordo com o template
     *
     * @return void
     */
    private function initFinder()
    {
        $structure = $this->getPaths();

        $this->finder = new PathFinder($structure);

        return $this;
    }
    
    /**
     * Define a lista de caminho de templates
     *
     * @param string $path
     * @return mixed
     */
    public function setPaths(array $list) : StructureDirectory
    {
        $this->pathList = $list;

        return $this;
    }

    /**
     * Retorna a lista de caminhos definidos dentro do projeto
     *
     * @return void
     */
    public function getPaths() : array
    {
        return $this->pathList;
    }
}
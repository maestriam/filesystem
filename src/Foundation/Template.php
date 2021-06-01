<?php

namespace Maestriam\FileSystem\Foundation;

use Maestriam\FileSystem\Foundation\Template\StubFile;
use Maestriam\FileSystem\Foundation\Drive\StructureDirectory;
use Maestriam\FileSystem\Foundation\File\FileInfo;

class Template
{
    /**
     * Nome do temmplate utilizado
     */
    private string $name;

    /**
     * Nome do arquivo stub
     */
    private StubFile $stub;

    private string $filename;

    private array $placeholders = [];
    
    /**
     * Regras de negócio de diretório 
     */
    private StructureDirectory $structure;

    /**
     * Regras de negócio para manipulação de arquivos baseado em template
     *
     * @param string $name
     * @param StructureDirectory $structure
     */
    public function __construct(string $name, StructureDirectory $structure)
    {
        $this->setStructure($structure)->loadStub($name)->setName($name);  
    }

    /**
     * Define a estrutura de diretórios utilizadas no template
     *
     * @param StructureDirectory $structure
     * @return Template
     */
    private function setStructure(StructureDirectory $structure) : Template
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * Carrega as informações de um arquivo stub
     *
     * @param string $name
     * @return Template
     */
    private function loadStub(string $name) : Template
    {
        $source = $this->structure->template;

        $this->stub = new StubFile($source, $name);

        return $this;
    }
    
    /**
     * Define o nome do arquivo de template
     *
     * @param string $name
     * @return Template
     */
    private function setName(string $name) : Template
    {
        $this->name = $name;
        
        return $this;
    }

    public function filename(string $filename) : Template
    {
        $this->filename = $filename;

        return $this;
    }

    public function placeholders(array $placeholders = []) : Template
    {
        $this->placeholders = $placeholders;

        return $this;
    }


    /**
     * Cria um arquivo baseado em um template
     *
     * @param string $filename
     * @param array $placeholders
     * @return void
     */
    public function create(string $filename = null, array $placeholders = null) : FileInfo
    {          
        $filename = $filename ?? $this->filename;

        $placeholders = $placeholders ?? $this->placeholders;

        $content = $this->stub->parse($placeholders);

        $folder = $this->structure->findByTemplate($this->name);

        $file = new File($filename);
                
        return $file->setFolder($folder)->create($content);
    }

    /**
     * Retorna o conteúdo de um template já interpretado
     *
     * @param array $placeholders
     * @return string
     */
    public function preview(array $placeholders) : string
    {
        return $this->stub->parse($placeholders);
    }

    /**
     * Retorna o arquivo, baseado em um modelo de template,
     * já existe no diretório definido
     *
     * @param array $placeholders
     * @return string
     */
    public function exists(string $filename) : bool
    {
        $file = $this->generateFilename($filename);

        return (is_file($file)) ? true : false;
    }

    public function load(string $filename) : ?string
    {
        if (! $this->exists($filename)) {
            return null;
        }

        $file = $this->generateFilename($filename);

        return file_get_contents($file);
    }

    private function generateFilename(string $filename) : string
    {
        $folder = $this->structure->findByTemplate($this->name);

        return $folder . DS . $filename;
    }
}
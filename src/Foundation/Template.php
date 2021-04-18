<?php

namespace Maestriam\FileSystem\Foundation;

use Maestriam\FileSystem\Foundation\Template\StubFile;
use Maestriam\FileSystem\Foundation\Drive\StructureDirectory;

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
    
    /**
     * 
     */
    private StructureDirectory $structure;

    /**
     * Undocumented function
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
     * Carrega as informações de um 
     *
     * @param string $name
     * @return Template
     */
    private function loadStub(string $name) : Template
    {
        $source = $this->structure->template();

        $this->stub = new StubFile($source, $name);

        return $this;
    }
    
    /**
     * Undocumented function
     *
     * @param string $name
     * @return Template
     */
    private function setName(string $name) : Template
    {
        $this->name = $name;
        
        return $this;
    }


    /**
     * Undocumented function
     *
     * @param string $filename
     * @param array $placeholders
     * @return void
     */
    public function create(string $filename, array $placeholders)
    {
        $content = $this->stub->parse($placeholders);
        $folder  = $this->structure->findByTemplate($this->name);

        $file = new File($filename);
                
        return $file->setFolder($folder)->create($content);
    }
}
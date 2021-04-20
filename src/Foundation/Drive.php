<?php

namespace Maestriam\FileSystem\Foundation;

use Illuminate\Support\Facades\Cache;
use Maestriam\FileSystem\Concerns\FluentGetter;
use Maestriam\FileSystem\Foundation\Drive\StructureDirectory;

class Drive
{
    use FluentGetter;
    
    /**
     * Nome do driver que será manipulado
     */
    private string $name;

    /**
     * Instância responsável pelas RNs sobre diretórios
     */
    private StructureDirectory $structure;    

    /**
     * Driver para manipulações de arquivos
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->initStructure();

        if ($this->exists($name)) {
            return $this->load($name);
        }

        return $this->setName($name);
    }

    /**
     * Carrega as informações do drive salvas no cache
     *
     * @param string $name
     * @return Drive
     */
    private function load(string $name) : Drive
    {
        $cached = Cache::get($name);

        $structure = $cached['structure'];

        $this->setName($cached['name']);

        $this->structure()->root($structure['root']);
        $this->structure()->template($structure['template']);        
        $this->structure()->paths($structure['paths']);

        return $this;
    }

    /**
     * Cria instância para manipulações de diretórios
     *
     * @return Drive
     */
    private function initStructure() : Drive
    {
        $this->structure = new StructureDirectory();

        return $this;
    }

    /**
     * Define o nome do drive que será manipulado
     *
     * @param string $name
     * @return Drive
     */
    private function setName(string $name) : Drive
    {
        $this->name = $name;

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
     * Retorna a instância para manipulação de arquivos baseado em um template,
     * sobre as configurações deste driver
     *
     * @param string $name
     * @return File
     */
    public function template(string $name) : Template
    {
        return new Template($name, $this->structure);
    }

    /**
     * Retorna a estrutura de diretórios defindos no drive
     *
     * @return StructureDirectory
     */
    public function structure() : StructureDirectory
    {
        return $this->structure;
    }

    /**
     * Converte as  informações do objeto para um array
     *
     * @return array
     */
    private function toArray() : array
    {
        return [
            'name' => $this->name,
            'structure' => [
                'root'     => $this->structure->root(),
                'paths'    => $this->structure->paths(),
                'template' => $this->structure->template(),
            ]
        ];
    }

    /**
     * Salva as informações definidas do drive no cache da aplicação
     *
     * @return void
     */
    public function save()
    {
        Cache::add($this->name, $this->toArray());

        return $this;   
    }

    /**
     * Retorna se o drive existe no cache
     *
     * @param string $name
     * @return boolean
     */
    private function exists(string $name) : bool
    {
        $cached = Cache::get($name);

        return (! $cached) ? false : true;
    }
}
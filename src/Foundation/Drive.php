<?php

namespace Maestriam\FileSystem\Foundation;

use Maestriam\FileSystem\Foundation\Drive\StructureDirectory;

class Drive
{
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
        $this->initStructure()->setName($name);
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
     * Salva as informações definidas sobre o drive no cache da aplicação
     *
     * @return void
     */
    public function save()
    {
        return $this;   
    }
}
<?php

namespace Maestriam\FileSystem\Foundation\Template;

use Exception;
use Maestriam\FileSystem\Foundation\Drive\PathSanitizer;
use Maestriam\FileSystem\Foundation\Drive\StructureDirectory;

class StubFile
{
    /**
     * Nome do arquivo stub
     */
    private string $name;

    /**
     * Conteúdo do arquivo .stub 
     */
    private string $content = '';

    /**
     * Caminho para o diretório onde está os arquivos .stubs
     */
    private string $source = '';
    
    /**
     * Extensão dos arquivos stubs
     */
    private string $ext = '.stub';

    /**
     * Carrega as informaçõea do arquivo stub de template
     *
     * @param string $source
     * @param string $name
     */
    public function __construct(string $source, string $name)
    {
        $this->setSourcePath($source)
             ->setName($name)
             ->loadContent();
    }

    /**
     * Define o caminho onde estão os arquivos de templates
     *
     * @param string $source
     * @return void
     */
    private function setSourcePath(string $source) : self
    {
        $source = PathSanitizer::sanitize($source);

        if (! is_dir($source)) {
            throw new \Exception('Template folder not found');
        }

        $this->source = $source;
        return $this;
    }

    /**
     * Define o nome do arquivo stub que será manipulado
     *
     * @param string $name
     * @return Stub
     */
    private function setName(string $name) : self
    {
        $file = $this->getStubFile($name);

        if (! is_file($file)) {
            throw new \Exception("Stub file called '{$file}' not found in folder template");
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Carrega o conteúdo do arquivo stub
     *
     * @return Stub
     */
    private function loadContent() : self
    {
        $file = $this->getStubFile();

        $this->content = file_get_contents($file);

        return $this;
    }

    /**
     * Forma a string do caminho completo do arquivo de stub
     *
     * @param string $name
     * @return string
     */
    private function getStubFile(string $name = null) : string
    {
        $name = $name ?? $this->name;

        if (! $name) {
            throw new \Exception('Stub name bad formatted');
        }

        return $this->source . $name . $this->ext;
    }    

    /**
     * Retorna o conteúdo, sem tratamentos, dentro do arquivo stub
     *
     * @return string
     */
    public function raw() : string
    {
        return $this->content;
    }    

    /**
     * Retorna o conteúdo do stub com as devidas conversões,
     * de acordo com os itens enviados pelo usuário
     *
     * @return void
     */
    public function parse(array $placeholders = []) : string
    {
        $content = $this->raw();

        return BraceParser::parse($content, $placeholders);
    }
}
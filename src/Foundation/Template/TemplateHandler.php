<?php

namespace Maestriam\FileSystem\Foundation\Template;

class TemplateHandler 
{
    /**
     * Nome do template que será carregado 
     */
    private string $name;

    /**
     * Caminho do diretório com os templates
     */
    private string $path;

    /**
     * Extensão do arquivo de template
     */
    private string $sulfix = '.stub';

    /**
     * Objeto para interpretação do conteúdo de template
     */
    private BraceParser $parser;    

    /**
     * Executa as operações principais para a manipulação do template
     *
     * @param string $name
     * @param Config $config
     */
    public function __construct(string $name, string $path)
    {
        $this
            ->setPath($path)
            ->setName($name)
            ->checkIsValid()
            ->initParser();
    }

    /**
     * Define o local onde está armazenados os templates
     *
     * @param string $path
     * @return TemplateHandler
     */
    private function setPath(string $path) : TemplateHandler
    {
        if (! is_dir($path)) {
            throw new \Exception("Invalid template directory", 1);            
        }

        $this->path = $path;
        
        return $this;
    }
    
    /**
     * Define o nome do template
     *
     * @param string $name
     * @return TemplateHandler
     */
    private function setName(string $name) : TemplateHandler
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Verifica se o arquivo de template definido é válido
     *
     * @return TemplateHandler
     */
    public function checkIsValid() : TemplateHandler
    {                
        if (! $this->isValidTemplate()) {
            throw new \Exception("Invalid template file", 1);  
        }        
        
        return $this;
    }
    
    /**
     * Retorna se é um arquivo de template válido
     *
     * @param string $name
     * @return boolean
     */
    public function isValidTemplate() : bool
    {
        $file = $this->absolute();

        return (is_file($file));
    }
     
    /**
     * Retorna o caminho absoluto do template
     *
     * @return string
     */
    public function absolute() : string
    {
        return $this->path . DS . $this->name . $this->sulfix;
    }

    /**
     * Instancia o objeto para interpretação do conteúdo de tempalte
     *
     * @return TemplateHandler
     */
    private function initParser() : TemplateHandler
    {
        $this->parser = new BraceParser();

        return $this;
    }

    /**
     * Retorna o conteúdo do arquivo de template sem tratamento
     *
     * @return string
     */
    public function raw() : string
    {
        $file = $this->absolute();

        return file_get_contents($file);
    }

    /**
     * Retorna o conteúdo do template interpretado com o
     * conteúdo das variáveis 
     *
     * @param array $dictionary
     * @return string
     */
    public function parse(array $dictionary = []) : string
    {
        $raw = $this->raw();

        return $this->parser->parse($raw, $dictionary);
    }
}
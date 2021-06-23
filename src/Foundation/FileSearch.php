<?php

namespace Maestriam\FileSystem\Foundation;

use Exception;

class FileSearch
{
    private string $path;

    private array $result = [];

    /**
     * Regras de negócio para pesquisa de arquivos dentro diretório
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->setPath($path);
    }

    /**
     * Retorna a lista de todos os arquivos encontrados em diretório e
     * seus sub-diretórios.  
     *
     * @return array
     */
    public function files(string $pattern = null) : array
    {
        $pattern = "/". $pattern ."/";

        $this->scan($this->path(), $pattern);

        return $this->result();
    }

    /**
     * Faz a busca de arquivos de dentro de diretórios e subdiretórios
     *
     * @param string $path
     * @return void
     */
    private function scan(string $path, string $pattern = null)
    {
        $items = array_diff(scandir($path), array('.', '..'));

        foreach ($items as $item) { 

            $item = "$path/$item";

            if (is_dir($item)) { 
                $this->scan($item, $pattern);
                continue;
            }            

            if ($pattern == null || preg_match($pattern, $item)) {
                $this->add($item); 
            }
        }
    }

    /**
     * Adiciona o caminho de um arquivo para a lista de resultado
     *
     * @param string $file
     * @return int
     */
    private function add(string $file) : int
    {
        return array_push($this->result, $file);
    }

    /**
     * Retorna a lista de arquivos encontrados
     *
     * @return array
     */
    public function result() : array
    {
        return $this->result;
    }

    /**
     * Retorna o caminho utilizado para a pesquisa
     *
     * @return string
     */
    private function path() : string
    {
        return $this->path;
    }

    /**
     * Define o caminho para a pesquisa
     *
     * @param string $path
     * @return FileSearch
     */
    private function setPath(string $path) : FileSearch
    {
        if (! is_dir($path)) {
            throw new Exception('Path not found.');
        }

        $this->path = $path;
        return $this;
    }
}
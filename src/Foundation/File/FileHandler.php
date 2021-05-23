<?php

namespace Maestriam\FileSystem\Foundation\File;

use Exception;
use Maestriam\FileSystem\Foundation\Drive\PathSanitizer;

class FileHandler
{
    /**
     * Nome do arquivo 
     * 
     * @var string
     */
    private string $name;

    /**
     * Nível de permissão
     * 
     * @var int
     */
    private int $permission = 0755;

    /**
     * Manipulação 
     *
     * @param string $location
     * @param string $name
     */
    public function __construct(string $location, string $name)
    {
        $this->setLocation($location)->setName($name);
    }
    
    /**
     * Define o local do arquivo
     *
     * @param string $location
     * @return FileHandler
     */
    private function setLocation(string $location) : FileHandler
    {
        if (! strlen($location)) {
            throw new \Exception('Folder not defined.');            
        }

        $this->location = $location;
        return $this;
    }

    /**
     * Define o nome do
     *
     * @param string $name
     * @return FileHandler
     */
    private function setName(string $name) : FileHandler
    {
        if (! strlen($name)) {
            throw new \Exception('File name not defined.');            
        }

        $this->name = $name;
        return $this;
    }

    /**
     * Executa a criação do arquivo
     * 
     * @param string $content
     * @return FileHandler
     */
    private function makeFile(string $content) : FileHandler
    {
        try {
            
            $location = $this->getLocation();
            $filename = sprintf("%s/%s", $location, $this->name);

            $handle = fopen($filename, 'w');
            
            fwrite($handle, $content);
            fclose($handle);
            
            $this->content = $content;
    
            return $this;

        } catch (\Exception $e) {
            throw new Exception('Error to create file: '.$e->getMessage());
        }
    }

    /**
     * Cria o diretório para inserção do arquivo
     *
     * @return FileHandler
     */
    private function makeFolder() : FileHandler
    {
        try {

            $location = $this->getLocation();                        

            if (! is_dir($location)) {
                mkdir($location, $this->permission, true);
            }
            
            return $this;
            
        } catch (\Exception $e) {
            throw new Exception("Error to create folder: ". $e->getMessage());
        }
    }

    /**
     * Undocumented function
     *
     * @return FileInfo
     */
    private function toObject() : FileInfo
    {
        $obj = new FileInfo();

        $obj->created_at    = now();
        $obj->updated_at    = now();  
        $obj->name          = $this->name;
        $obj->content       = $this->content;        
        $obj->folder        = $this->getLocation();
        $obj->absolute_path = $this->getLocation() . $this->name;

        return $obj;
    }

    public function getLocation()
    {
        return PathSanitizer::sanitize($this->location);
    }

    /**
     * Define o conteúdo que será inserido no arquivo
     *
     * @param string $content
     * @return FileHandler
     */
    private function setContent(string $content) : FileHandler
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Analisa o nome do arquivo se contém algum sub-diretório embutido
     * Se houver, separa e 
     *
     * @return FileHandler
     */
    private function analizeFilename() : FileHandler
    {
        if (! str_contains($this->name, '/')) {
            return $this;
        }

        $pieces = explode('/', $this->name);
        $flname = array_pop($pieces);
        $folder = implode('/', $pieces);
        
        $this->name = $flname;
        $this->location .= $folder . DS;

        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string $content
     * @return void
     */
    public function create(string $content) : FileInfo
    {
        return $this->analizeFilename()
                    ->makeFolder()
                    ->makeFile($content)
                    ->setContent($content)
                    ->toObject();
    }
}
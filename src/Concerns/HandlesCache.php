<?php

namespace Maestriam\FileSystem\Concerns;

use Illuminate\Support\Facades\Cache;

/**
 * Manipula a entrada/saída de itens no cache da aplicação
 */
trait HandlesCache
{
    /**
     * Define/Retorna itens no cache do sistema
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    private function cache(string $key, $value = null)
    {
        $name = $this->getCacheName($key);

        if ($value == null) {
            return $this->getCache($name);
        } 
                
        return $this->setCache($name, $value);
    }

    /**
     * Define/Retorna os itens no cache, definidos como padrão
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function default(string $key, $value = null)
    {
        $name = $this->getCacheName($key, 'filesystem.default');

        if ($value == null) {
            return $this->getCache($name);
        } 
                
        return $this->setCache($name, $value);
    }

    /**
     * Gera uma chave de acesso para item no cache
     *
     * @param string $key
     * @param string $prefix
     * @return string
     */
    private function getCacheName(string $key, string $prefix = null) : string 
    {
        $prefix = ($prefix == null) ? $this->name() : $prefix;        

        return sprintf("%s.%s", $prefix, $key);
    }    
    
    /**
     * Retorna um item do cache
     *
     * @param string $name
     * @return mixed
     */
    private function getCache(string $name)
    {
        return Cache::get($name);
    }

    /**
     * Define um item no cache
     *
     * @param string $name
     * @param mixed $value
     * @return mixed
     */
    private function setCache(string $name, $value)
    {        
        return Cache::put($name, $value);
    }
}
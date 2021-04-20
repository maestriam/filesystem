<?php

namespace Maestriam\FileSystem\Concerns;

/**
 * "Facilitador" para recuperar as funções getters da classe
 */
trait FluentGetter
{
    /**
     * Verifica o atributo acessado e vê se tem um get para retorna-la
     * 
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        $func = 'get' . ucfirst($name);

        if (! method_exists($this, $func)) {
            throw new \Exception("Has not attribute in class");            
        }

        return $this->$func();
    }
}
<?php

namespace Maestriam\FileSystem\Concerns;

/**
 * Configura as chamadas das funções para ficar de 
 * maneira mais flúida dentro da classe
 */
trait FluentMethods 
{       
    /**
     * Intercepta as chamadas de funções e verifica se há
     * alguma chamada do tipo getter ou setter
     *
     * @param string $name
     * @param array $params
     * @return void
     */
    public function __call($name, $params)
    {
        if (method_exists($this, $name)) {
            return $this->$name(...$params);
        }

        return (empty($params)) ? 
                    $this->getter($name) : 
                    $this->setter($name, $params);
    }

    /**
     * Verifica se há uma chamada do tipo getter.
     * Se houver, execute.
     *
     * @param string $name
     * @return void
     */
    private function getter(string $name)
    {
        $method = 'get' . ucfirst($name);

        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new \Exception("Method {$method} not found", 1);        
    }

    /**
     * Verifica se há uma chamada do tipo setter.
     * Se houver, execute.
     *
     * @param string $name
     * @param array $params
     * @return void
     */
    private function setter(string $name, array $params)
    {
        $method = 'set' . ucfirst($name);
        $param  = reset($params);

        if (method_exists($this, $method)) {
            return $this->$method($param);
        }

        throw new \Exception("Method {$method} not found", 1);        
    }
}
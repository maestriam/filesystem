<?php

namespace Maestriam\FileSystem\Contracts;

interface SystemInterface
{
    public function delete();
    
    public function exists() : bool;

    public function find() : ?SystemInterface;

    public function findOrFail() : SystemInterface;
    
    public function create(array $args = []) : SystemInterface;
    
    public function findOrCreate(array $args = []) : SystemInterface;
}
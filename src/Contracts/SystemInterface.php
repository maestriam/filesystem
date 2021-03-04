<?php

namespace Maestriam\FileSystem\Contracts;

interface SystemInterface
{
    public function delete();
    
    public function exists() : bool;

    public function create() : SystemInterface;

    public function find() : ?SystemInterface;

    public function findOrCreate() : SystemInterface;

    public function findOrFail() : SystemInterface;
}
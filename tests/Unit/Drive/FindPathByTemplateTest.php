<?php

namespace Maestriam\FileSystem\Tests\Unit\Drive;

use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Foundation\Drive\PathFinder;
use Maestriam\FileSystem\Tests\TestCase;

class FindPathByTemplateTest extends TestCase
{
    /**
     * Verifica se consegue encontrar um caminho específico de acordo
     * com o tipo de template
     *
     * @return void
     */
    public function testSpecificPath()
    {                
        $structure = ['template' => __DIR__ . '/Templates'];

        $finder = new PathFinder($structure);

        $path = $finder->findByTemplate('template');

        $this->assertIsString($path);
        $this->assertEquals($structure['template'], $path);
    }

    /**
     * Verifica se consegue encontrar um caminho default de acordo
     * com o tipo de template
     * 
     * @return void
     */
    public function testGenericPath()
    {
        $structure = ['template-*' => __DIR__ . '/Templates'];

        $finder = new PathFinder($structure);

        $path = $finder->findByTemplate('template-local');

        $this->assertIsString($path);
        $this->assertEquals($structure['template-*'], $path);
    } 

    /**
     * Verifica se é possível redirecionar todos os arquivos,
     * baseado em template, para uma unica rota
     *
     * @return void
     */
    public function testUniquePath()
    {
        $structure = ['*' => __DIR__ . '/Templates'];

        $finder = new PathFinder($structure);

        $path = $finder->findByTemplate('template');

        $this->assertIsString($path);
        $this->assertEquals($structure['*'], $path);
    }
}
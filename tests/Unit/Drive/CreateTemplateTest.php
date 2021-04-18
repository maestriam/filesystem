<?php

namespace Maestriam\FileSystem\Tests;

use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Tests\TestCase;

class CreateTemplateTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
    }

    /**
     * Cria um arquivo de template
     *
     * @return void
     */
    public function testCreateFileWithTemplate()
    {                
        $tpl  = 'template-file';
        $name = 'filename.txt';               
        $data = ['test' => '"Create Test File"'];        

        $drive = $this->getDrive();

        $file = $drive->template($tpl)->create($name, $data);

        $this->assertFileExists($file->absolute_path);
    }
    
    /**
     * Retorna o drive para a criação de template
     *
     * @return Drive
     */
    private function getDrive() : Drive
    {
        $root = __DIR__ . '/../../../sandbox/';        
        $tpl  = __DIR__ . '/../../../templates/';
        
        $paths = ['template-*' => 'Stubs'];
        $drive = new Drive('driver');

        $drive->structure()
              ->root($root)
              ->template($tpl)
              ->paths($paths);

        return $drive;
    }
}
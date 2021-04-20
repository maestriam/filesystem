<?php

namespace Maestriam\FileSystem\Tests\Unit\Drive;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Foundation\Drive;

class DriveTestCase extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
    }

    /**
     * Retorna o drive para a criação de template
     *
     * @return Drive
     */
    protected function createDrive(string $name) : Drive
    {
        $tpl   = __DIR__ . '/../../../templates/';        
        $root  = __DIR__ . '/../../../sandbox/';        
        $paths = ['template-*' => 'Stubs'];

        $drive = new Drive($name);

        $drive->structure()->root($root);
        $drive->structure()->template($tpl);
        $drive->structure()->paths($paths); 

        return $drive;
    }
}
<?php

namespace Maestriam\FileSystem\Tests\Unit\Drive;

use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Tests\TestCase;

class SaveDriveTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
    }

    public function testCreateAndRequestDrive()
    {
        $this->createDrive();

        $name = 'driver';

        $drive = new Drive($name);

        $this->assertNotEmpty($drive->name);
        $this->assertEquals($drive->name, $name);
    }

    /**
     * Cria um novo drive e salva as informações no cache
     *
     * @return void
     */
    private function createDrive()
    {
        $root = __DIR__ . '/../../../sandbox/';        
        $tpl  = __DIR__ . '/../../../templates/';
        
        $paths = ['template-*' => 'Stubs'];
        $drive = new Drive('driver');

        $drive->structure()
              ->setRoot($root)
              ->setTemplate($tpl)
              ->setPaths($paths);
        
        $drive->save();
    }
}
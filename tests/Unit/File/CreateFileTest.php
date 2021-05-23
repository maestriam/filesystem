<?php

namespace Maestriam\FileSystem\Tests;

use Maestriam\FileSystem\Foundation\File;
use Maestriam\FileSystem\Tests\TestCase;

class CreateFileTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
    }

    public function testCreateFile()
    {                
        $content = 'content file';
        $folder  = __DIR__ . '/../../../../sandbox/';
        
        $file = new File('unit-test-create-file.txt');

        $info = $file->setFolder($folder)->create($content);

        $this->assertFileExists($info->absolute_path);
    }
}
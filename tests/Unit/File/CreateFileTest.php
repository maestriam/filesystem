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
        $file = new File('file.txt');
        $path = __DIR__ . '../../../../sandbox/';
        $info = $file->setFolder($path)->create('content file');

        $this->assertFileExists($info->absolute_path);
    }
}
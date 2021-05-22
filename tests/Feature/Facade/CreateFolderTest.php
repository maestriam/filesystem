<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Support\FileSystem;
use Maestriam\FileSystem\Tests\TestCase;

class CreateFolderTest extends TestCase
{
    public function testCreatPath()
    {
        $path =  __DIR__ . '/../../../sandbox/foo';
        
        FileSystem::folder($path)->create();

        $this->assertDirectoryExists($path);
    }
}
<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Support\FileSystem;
use Maestriam\FileSystem\Tests\TestCase;

class DeleteFolderTest extends TestCase
{
    public function testDeletePath()
    {
        $path =  __DIR__ . '/../../../sandbox';
        
        FileSystem::folder($path)->delete();

        $this->assertDirectoryDoesNotExist($path);
    }
}
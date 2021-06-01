<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Support\FileSystem;

class ReadFolderTest extends TestCase
{
    public function testReadFolder()
    {
        $path =  __DIR__ . '/../../../vendor/';

        $folders = FileSystem::folder($path)->read(2);

        $this->assertIsArray($folders);
    }
}
<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Support\FileSystem;

class FileSearchTest extends TestCase
{
    public function testSearch()
    {
        $path = __DIR__ . '/../../../src';

        $files = FileSystem::folder($path)->files();

        $this->assertIsArray($files);
        $this->assertNotEmpty($files);
    }

    public function testSearchWithPattern()
    {
        $path = __DIR__ . '/../../../vendor/composer';

        $files = FileSystem::folder($path)->files('.json');

        $this->assertIsArray($files);
        $this->assertNotEmpty($files);
    }
}
<?php

namespace Maestriam\FileSystem\Tests\Unit\Foundation;

use Maestriam\FileSystem\Foundation\FileSearch;
use Maestriam\FileSystem\Tests\TestCase;

class FileSearchTest extends TestCase
{
    public function testSearchWithoutPattern()
    {
        $path = __DIR__ . '/../../../../vendor/composer';

        $search = new FileSearch($path);

        $result = $search->files();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function testSearchWithPattern()
    {
        $path = __DIR__ . '/../../../../vendor/composer';

        $search = new FileSearch($path);

        $result = $search->files('.json');

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}
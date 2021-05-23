<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Support\FileSystem;

class SanitizePathTest extends TestCase
{
    public function testSanitizePath()
    {
        $path =  __DIR__ . '/../../../sandbox/\foo';
        
        $ret = FileSystem::folder($path)->sanitize();

        $this->assertIsString($ret);
    }
}
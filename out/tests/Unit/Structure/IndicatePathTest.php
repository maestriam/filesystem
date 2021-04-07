<?php

namespace Maestriam\FileSystem\Tests\Unit\FileSystem;

use Maestriam\FileSystem\Foundation\Structure;

class IndicatePathTest extends FileSystemTestCase
{
    public function testIndicateTemplatePath()
    {
        $root = $this->getRootFolder();

        $directories = ['template-file' => 'Template/Files'];

        $structure = new Structure($root, $directories);     

        $target = $structure->target('template-file');

        $this->assertIsString($target);
    }
}
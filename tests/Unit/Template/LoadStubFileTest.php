<?php

namespace Maestriam\FileSystem\Tests\Unit\Template;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Foundation\Template\StubFile;

class LoadStubFileTest extends TestCase
{
    public function testLoadStub()
    {
        $fname  = 'template-file';
        $source = __DIR__ . '/../../../templates/';

        $stubfile = new StubFile($source, $fname);     
        $content  = $stubfile->raw();

        $this->assertIsString($content);
        $this->assertNotEmpty($content);
    }
}
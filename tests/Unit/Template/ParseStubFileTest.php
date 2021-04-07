<?php

namespace Maestriam\FileSystem\Tests\Unit\Template;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Foundation\Template\StubFile;

class ParseStubFileTest extends TestCase
{
    public function testLoadStub()
    {
        $fname  = 'template-file';
        $source = __DIR__ . '/../../../templates/';

        $stubfile = new StubFile($source, $fname);     
        $holders  = ['test' => 'parse'];

        $content  = $stubfile->parse($holders);

        $this->assertIsString($content);
        $this->assertNotEmpty($content);
        $this->assertStringNotContainsString("{{", $content);
        $this->assertStringNotContainsString("}}", $content);
    }
}
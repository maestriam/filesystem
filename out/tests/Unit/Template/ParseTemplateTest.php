<?php

namespace Maestriam\FileSystem\Tests\Unit\Template;

use Maestriam\FileSystem\Foundation\Template\TemplateHandler;
use Maestriam\FileSystem\Tests\Unit\FileSystem\FileSystemTestCase;

class ParseTemplateTest extends FileSystemTestCase
{
    public function testParseTemplate()
    {
        $this->initDefaultDrive();        
        
        $name = 'template-file';
        $path = $this->getTemplateFolder();
        
        $argument = ['test' => 'Load template'];
        $template = new TemplateHandler($name, $path);
        $content  = $template->parse($argument);
        
        $this->assertIsString($content);
        $this->assertStringNotContainsString("{{", $content);
        $this->assertStringNotContainsString("}}", $content);
    }
}
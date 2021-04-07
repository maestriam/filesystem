<?php

namespace Maestriam\FileSystem\Tests\Unit\Template;

use Maestriam\FileSystem\Foundation\Template\TemplateHandler;
use Maestriam\FileSystem\Tests\Unit\FileSystem\FileSystemTestCase;

class LoadTemplateTest extends FileSystemTestCase
{
    public function testLoadTemplate()
    {
        $this->initDefaultDrive();        
        
        $name = 'template-file';
        $path = $this->getTemplateFolder();
        $this->assertDirectoryExists($path);
        
        $template = new TemplateHandler($name, $path);

        $this->assertFileExists($template->absolute());
        $this->assertIsString($template->raw());        
    }
}
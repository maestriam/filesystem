<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Foundation\Template;
use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Support\FileSystem;

class LoadContentFileTest extends TestCase
{
    public function testLoadContent()
    {        
        $template = $this->template();
        
        $template->create();
        
        $content = $template->load('my-file.txt');

        $this->assertIsString($content);
        $this->assertStringContainsString('load', $content);
    }
    
    public function template() : Template
    {        
        $template = 'template-file';        
        $filename = 'my-file.txt';

        $placeholder = ['test' => 'load'];        
        $driveName   = 'file-template-drive-clear';

        $drive = $this->initDrive($driveName);
                
        $drive->structure()->paths(['template-file' => '.']);        
        $drive->save();

        return FileSystem
                    ::drive($driveName)
                    ->template($template)
                    ->filename($filename)
                    ->placeholders($placeholder);
    }
}
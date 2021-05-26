<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Support\FileSystem;

class PreviewTemplateTest extends TestCase
{
    public function testPreview()
    {
        $phrase = 'preview test';
        $drive  = 'preview-drive';

        $this->initDrive($drive);
        
        $placeholders = ['test' => $phrase];
        
        $ret = FileSystem
                ::drive($drive)
                ->template('template-file')
                ->preview($placeholders);

        $this->assertIsString($ret);
        $this->assertStringContainsString($phrase, $ret);
    }
}
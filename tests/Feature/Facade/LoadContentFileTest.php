<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Support\FileSystem;

class FileExistsByTemplateTest extends TestCase
{
    public function testLoadContent()
    {
        $drive = 'exists-file-template-drive';

        $this->getDrive($drive);

        $filename = 'my-file.txt';
        
        $ret = FileSystem
                    ::drive($drive)
                    ->template('template-file')
                    ->filename($filename)
                    ->load();

        $this->assertIsBool($ret);
        $this->assertFalse($ret);
        
    }


    private function createFile()
    {
        $drive = 'exists-file-template-drive';
        
        $this->getDrive($drive);

        $filename = 'my-files-xs.txt';
        
        FileSystem
            ::drive($drive)
            ->template('template-file')
            ->create($filename, ['test' => 'foo']);
    }
}
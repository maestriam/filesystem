<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Support\FileSystem;

class FileExistsByTemplateTest extends TestCase
{
    public function testPreview()
    {
        $drive = 'exists-file-template-drive';

        $this->getDrive($drive);

        $filename = 'my-file.txt';
        
        $ret = FileSystem
                    ::drive($drive)
                    ->template('template-file')
                    ->exists($filename);

        $this->assertIsBool($ret);
        $this->assertFalse($ret);
    }

    public function testExistsFile()
    {
        $drive = 'exists-file-template-drive';
        
        $this->getDrive($drive);

        $filename = 'my-files-xs.txt';
        
        FileSystem
            ::drive($drive)
            ->template('template-file')
            ->create($filename, ['test' => 'foo']);

        $ret = FileSystem
                    ::drive($drive)
                    ->template('template-file')
                    ->exists($filename);

        $this->assertIsBool($ret);
        $this->assertTrue($ret);
    }

    private function getDrive(string $driveName)
    {
        $drive = $this->initDrive($driveName);

        $drive->structure()->paths(['template-file' => '.']);
        
        $drive->save();

        return $drive;
    }
}
<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Support\FileSystem;

class PathFileTemplateTest extends TestCase
{
    public function testPreview()
    {
        $drive = 'preview-drive-path-file';

        $this->getDrive($drive);
        
        $ret = FileSystem::drive($drive)
                         ->template('template-file')
                         ->path('my-file.txt');
                
        $this->assertIsString($ret);
    }

    private function getDrive(string $driveName)
    {
        $drive = $this->initDrive($driveName);

        $drive->structure()->paths(['template-file' => '.']);
        
        $drive->save();

        return $drive;
    }
}
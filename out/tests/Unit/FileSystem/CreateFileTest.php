<?php

namespace Maestriam\FileSystem\Tests\Unit\FileSystem;

use Maestriam\FileSystem\Foundation\Drive;

class CreateFileTest extends FileSystemTestCase
{
    public function testCreateFile()
    {
        $this->initDefaultDrive();

        $filename  = 'file.txt';
        $drivename = 'drive.hiei';
        $template  = 'template-file.stub';
        $arguments = ['test' => 'Create file'];

        $file = $this
                    ->filesystem()
                    ->drive($drivename)
                    ->file($filename)
                    ->basedOn($template)
                    ->create($arguments);
        
        
    }

}
<?php

namespace Maestriam\FileSystem\Tests\Feature;

use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Support\FileSystem;
use Maestriam\FileSystem\Tests\TestCase;

class CreateDriveTest extends TestCase
{
    public function testDrive()
    {
        $drive = FileSystem::drive('drive-facade')->save();

        $this->assertInstanceOf(Drive::class, $drive);
        
        $this->assertTrue($drive->exists());
    }
}
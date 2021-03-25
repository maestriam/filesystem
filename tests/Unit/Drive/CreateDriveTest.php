<?php

namespace Maestriam\FileSystem\Tests\Unit\Drive;

use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Foundation\FileSystem;

class CreateDriveTest extends DriveTestCase
{
    /**
     * Tenta criar um drive com um nome válido
     *
     * @return void
     */
    public function testCreateDrive()
    {
        $drive = new Drive('drive');

        $this->assertDriveInstance($drive);
    }

    /**
     * Tenta criar drives com traços e pontos no nome
     *
     * @return void
     */
    public function testCreateWithSimbols()
    {
        $dash = 'drive-test';
        $dot  = 'drive.test';

        $drive1 = new Drive($dash);
        $drive2 = new Drive($dot);

        $this->assertDriveInstance($drive1);
        $this->assertDriveInstance($drive2);
    }
}
<?php

namespace Maestriam\FileSystem\Tests\Unit\Drive;

use Maestriam\FileSystem\Tests\TestCase;

class CheckExistsDriveTest extends DriveTestCase
{
    public function setUp() : void
    {
        parent::setUp();
    }

    /**
     * Verifica se um drive salvo no cache existe
     *
     * @return void
     */
    public function testCheckDriveExists()
    {
        $drive = $this->createDrive('motorhead');
        $drive->save();

        $this->assertIsBool($drive->exists());
        $this->assertTrue($drive->exists());
    }

    /**
     * Verifica se um drive NÃO salvo no cache existe
     *
     * @return void
     */
    public function testCheckDriveNotExists()
    {
        $drive = $this->createDrive('metallica');

        $this->assertIsBool($drive->exists());
        $this->assertFalse($drive->exists());
    }
}
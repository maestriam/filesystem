<?php

namespace Maestriam\FileSystem\Tests\Unit\FileSystem;

use Maestriam\FileSystem\Entities\Drive;
use Maestriam\FileSystem\Entities\FileSystem;
use Maestriam\FileSystem\Tests\TestCase;

class CreateDriveTest extends TestCase
{
    /**
     * Testa se é possível criar instanciar o drive default
     *
     * @return void
     */
    public function testCreateDefaultDrive()
    {
        $drive = $this->getDefaultDrive();       

        $this->assertDriveInstance($drive);
    }

    /**
     * Testa se é possível criar uma novo drive
     *
     * @return void
     */
    public function testCreateNewDrive()
    {
        $root      = $this->getRootFolder(); 
        $template  = $this->getTemplateFolder();
        $structure = $this->getFolderStructure();

        $name  = 'drive.yusuke';
        $drive = $this->filesystem()->drive($name);

        $drive
            ->root($root)
            ->template($template)
            ->structure($structure)
            ->save();
        
        $this->assertDriveInstance($drive);
    }

    /**
     * Testa se 
     *
     * @return void
     */
    public function testCreateDriveUsingDefaultConfig()
    {
        $default = $this->getDefaultDrive();
        
        $path  = '/var/www/kuabara';
        $drive = $this->filesystem()->drive('drive.kuabara');

        $drive->root($path)->save();

        $this->assertDriveInstance($drive);
        $this->assertEquals($drive->root(), $path);
    }

    private function filesystem() : FileSystem
    {
        return new FileSystem();
    }

    private function getTemplateFolder() : string
    {
        return config('filesystem.folders.template');
    }

    private function getFolderStructure() : array
    {
        return config('filesystem.structure');
    }

    private function getRootFolder() : string
    {
        return config('filesystem.folders.root');
    }

    private function getDefaultDrive() : Drive
    {
        $root      = $this->getRootFolder(); 
        $template  = $this->getTemplateFolder();
        $structure = $this->getFolderStructure();

        $drive = $this->filesystem()->default();

        $drive
            ->root($root)
            ->structure($structure)
            ->template($template)
            ->save();

        return $drive;
    }

    private function assertDriveInstance($drive)
    {
        $this->assertInstanceOf(Drive::class, $drive);
        $this->assertIsArray($drive->structure());
        $this->assertIsString($drive->root());
        $this->assertIsString($drive->template());
    }
}

<?php

namespace Maestriam\FileSystem\Tests\Unit\FileSystem;

class CreateDriveTest extends FileSystemTestCase
{
    /**
     * Testa se é possível criar instanciar o drive default
     *
     * @return void
     */
    public function testCreateinitDefaultDrive()
    {
        $drive = $this->initDefaultDrive();       

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
            ->structure($structure)
            ->template($template)
            ->root($root)
            ->save();
        
        $this->assertDriveInstance($drive);
    }

    /**
     * Testa se é possível criar um drive e 
     * utilizar configurações do drive default
     *
     * @return void
     */
    public function testCreateDriveOverridingDefault()
    {
        $this->initDefaultDrive();
        
        $name = 'drive.kuabara';
        $path = '/var/www/kuabara';
        
        $drive = $this->filesystem()->drive($name);
        $drive->root($path)->save();

        $this->assertDriveInstance($drive);
        $this->assertEquals($drive->root(), $path);
    }

    /**
     * Testa se é possível criar uma novo drive utilizando
     * dados do drive padrão
     *
     * @return void
     */
    public function testCreateDriveUsingDefaultConfig()
    {   
        $this->initDefaultDrive();
        
        $name  = 'drive.kurama';
        $drive = $this->filesystem()->drive($name)->save();

        $this->assertDriveInstance($drive);
    }
}

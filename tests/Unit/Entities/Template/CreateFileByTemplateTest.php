<?php

namespace Maestriam\FileSystem\Tests;

use Maestriam\FileSystem\Foundation\Drive;
use Maestriam\FileSystem\Foundation\File;
use Maestriam\FileSystem\Tests\TestCase;

class CreateFileByTemplateTest extends TestCase
{
    /**
     * Verifica se consegue criar um arquivo de forma simples
     *
     * @return void
     */
    public function testCreateFileByTemplate()
    {
        $flname = 'test.txt';
        $tplate = 'template-file';
        $hlders =  [$tplate => '.'];

        $drive = $this->drive();

        $info = $drive->template($tplate)->create($flname, $hlders);

        $this->assertFileExists($info->absolute_path);
    }

    /**
     * Verifica se consegue criar um arquivo com sub-folder,
     * utilizando template
     * 
     * @return void
     */
    public function testCreateFileWithSubfolderByTemplate()
    {
        $tplate = 'template-file';
        $holder =  ['test' => 'xxxxx'];
        $flname = 'myfolder/sub/file.txt';

        $drive = $this->drive();
        $info  = $drive->template($tplate)->create($flname, $holder);

        $this->assertFileExists($info->absolute_path);
    }

    /**
     * Retorna um drive para criação do arquivo
     *
     * @return Drive
     */
    private function drive() : Drive
    {
        $drive = $this->initDrive('drive-x');
        $paths = ['template-file' => '.'];

        $drive->structure()->paths($paths);

        return $drive;
    }
}
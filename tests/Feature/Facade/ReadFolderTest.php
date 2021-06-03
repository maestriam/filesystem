<?php

namespace Maestriam\FileSystem\Tests\Feature\Facade;

use Maestriam\FileSystem\Tests\TestCase;
use Maestriam\FileSystem\Support\FileSystem;

class ReadFolderTest extends TestCase
{
    public function testReadFolder()
    {
        $path =  __DIR__ . '/../../../vendor/';

        $folders = FileSystem::folder($path)->read(2);

        $this->assertIsArray($folders);
    }

    /**
     * Verifica se após executar a leitura de um diretórios, 
     * o sistema está limpando o resultado anterior da memória.  
     *
     * @return void
     */
    public function testDuplicateReadFolder()
    {
        $basedir =  __DIR__ . '/../../../sandbox/dirs/';
        $fstdir  = $basedir . 'level/folder1';
        $scndir  = $basedir . 'level/folder2';

        FileSystem::folder($fstdir)->create();
        FileSystem::folder($scndir)->create();

        $round1 = FileSystem::folder($basedir)->read(2);
        $round2 = FileSystem::folder($basedir)->read(2);

        $this->assertEquals(count($round1), 2);
        $this->assertEquals(count($round1), count($round2));
    }
}
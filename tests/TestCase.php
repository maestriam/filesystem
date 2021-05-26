<?php

namespace Maestriam\FileSystem\Tests;

use Maestriam\FileSystem\Foundation\Drive;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Maestriam\FileSystem\Providers\FileSystemProvider;

class TestCase extends BaseTestCase
{
    /**
     * {@inheritDoc}
     */
    public function setUp() : void
    {
        $this->setConst();        
        parent::setUp();
    }

    /**
     * Retorna o Service Provider para carregamento
     *
     * @param mixed $app
     * @return array
     */
    protected function getPackageProviders($app) : array
    {
        return [
            FileSystemProvider::class,
        ];
    }
  
    /**
     * {@inheritDoc}
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('filesystem', [
            'structure' => ['*' => '.'],
            'folders' => [
                'template' => __DIR__ . '/../templates',
                'root'     => __DIR__ . '/../sandbox',                
            ]
        ]);
    }

    /**
     * Verifica se é uma instância de drive
     *
     * @param Drive $drive
     * @return void
     */
    protected function assertDriveInstance(Drive $drive)    
    {
        $this->assertInstanceOf(Drive::class, $drive);
        $this->assertIsString($drive->root());
        $this->assertIsArray($drive->structure());
        $this->assertIsString($drive->template());
    }

    /**
     * Define as constantes utilizadas no package
     *
     * @return void
     */
    private function setConst()
    {
        if (! defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }
    }

    protected function initDrive(string $name) : Drive
    {
        $root = __DIR__ . '/../sandbox/'; 
        $stub = __DIR__ . '/../stubs/';

        $drive = new Drive($name);

        $drive->structure()->root($root);
        $drive->structure()->template($stub);

        $drive->save();

        return $drive;
    }
}
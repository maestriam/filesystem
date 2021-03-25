<?php

namespace Maestriam\FileSystem\Tests;

use Maestriam\FileSystem\Foundation\Drive;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * {@inheritDoc}
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->setConst();        
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

    private function setConst()
    {
        if (! defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }
    }
}
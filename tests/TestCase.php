<?php

namespace Maestriam\FileSystem\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * {@inheritDoc}
     */
    public function setUp() : void
    {
        parent::setUp();
    }

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
}
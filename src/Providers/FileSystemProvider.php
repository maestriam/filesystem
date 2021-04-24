<?php

namespace Maestriam\FileSystem\Providers;

use Illuminate\Support\ServiceProvider;
use Maestriam\FileSystem\Foundation\FileSystem;

class FileSystemProvider extends ServiceProvider
{
    public function boot()
    {
        $this->setConsts();
        $this->registerFacade();
    }

    private function setConsts()
    {
        if (! defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }
    }

    private function registerFacade()
    {
        $this->app->bind('filesystem',function() {
            return new FileSystem();
        });
    }
}
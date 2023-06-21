<?php

namespace App\Providers;

use GoogleTest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Config\filesystem;
use Flysystem\GoogleDrive\GoogleDriveAdapter;

use Google_Client;
//use Illuminate\Support\Facades\Google_Client;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}

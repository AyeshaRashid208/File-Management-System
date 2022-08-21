<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Storage::extend('google', function ($app, $config) {
            $client = new \Google_Client();
            $client->setClientId($config['56743642060-u7i26t7tds9pdv2r93nrqna0ft6ctv32.apps.googleusercontent.com']);
            $client->setClientSecret($config['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
            ']);
            $client->refreshToken($config['1//04oLPOVdAw7a_CgYIARAAGAQSNwF-L9Ir9WqhYH5UthtZsgokkRsSIGJ4g7rZEHWtxzvc-o050MFw_jW03JEextKvib-MLSlymug
            ']);
            $service = new \Google_Service_Drive($client);
            $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, $config['18o1iv4mUkopwkYIkyojyvVnI0ylERWFZ']);
     
            return new \League\Flysystem\Filesystem($adapter);
        });
    }
}

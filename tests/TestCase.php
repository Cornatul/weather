<?php

namespace Cornatul\Weather\Tests;


use Cornatul\Weather\WeatherProvider;
use Cornatul\Wordpress\WordpressServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

    }

    final protected function getPackageProviders($app):array
    {
        $app->register(WeatherProvider::class);

        return [
            WeatherProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        // perform environment setup
    }
}

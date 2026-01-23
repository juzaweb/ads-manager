<?php

namespace Juzaweb\Modules\AdsManagement\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Juzaweb\Modules\AdsManagement\Providers\AdManagementServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        // Load helpers
        require_once __DIR__ . '/Stubs/helpers.php';

        // Load stubs
        if (!class_exists('Juzaweb\Modules\Core\Providers\ServiceProvider')) {
            require_once __DIR__ . '/Stubs/ServiceProvider.php';
        }
        if (!class_exists('Juzaweb\Modules\Core\Models\Model')) {
            require_once __DIR__ . '/Stubs/Model.php';
        }
        if (!class_exists('Juzaweb\Modules\Core\Facades\Menu')) {
            require_once __DIR__ . '/Stubs/Menu.php';
        }
        if (!class_exists('Juzaweb\Modules\Core\Facades\Theme')) {
            require_once __DIR__ . '/Stubs/Theme.php';
        }
        if (!class_exists('Juzaweb\Modules\Core\Facades\RouteResource')) {
            require_once __DIR__ . '/Stubs/RouteResource.php';
        }
        if (!class_exists('Juzaweb\Modules\Core\Facades\Locale')) {
            require_once __DIR__ . '/Stubs/Locale.php';
        }

        parent::setUp();
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('core.admin_prefix', 'admin-cp');
    }

    protected function getPackageProviders($app)
    {
        return [
            AdManagementServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}

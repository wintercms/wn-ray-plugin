<?php namespace Winter\Ray;

use Composer\InstalledVersions;
use System\Classes\PluginBase;
use Winter\Ray\Classes\RayServiceProvider;

/**
 * Ray Plugin Information File
 */
class Plugin extends PluginBase
{
    public $elevated = true;

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Ray',
            'description' => 'Adds support for the Ray debugging tool to Winter CMS',
            'author'      => 'Winter CMS',
            'icon'        => 'icon-leaf'
        ];
    }

    public function register()
    {
        $this->app->register(RayServiceProvider::class);
    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot()
    {
        // Handle the requirements being installed in a plugin specific vendor directory
        // and then included by Winter instead of by composer when using Composer 2
        $localInstalled = __DIR__ . '/vendor/composer/installed.php';
        if (class_exists(InstalledVersions::class) && file_exists($localInstalled)) {
            $installed = InstalledVersions::getRawData();
            $extraInstalled = require $localInstalled;
            $installed['versions'] = array_merge($extraInstalled['versions'], $installed['versions']);
            InstalledVersions::reload($installed);
        }
    }
}

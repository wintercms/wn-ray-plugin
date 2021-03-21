<?php namespace Winter\Ray;

use Backend;
use System\Classes\PluginBase;

use Composer\InstalledVersions;

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
            'description' => 'No description provided yet...',
            'author'      => 'Winter CMS',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        // Register the service providers provided by the packages used by your plugin
        \App::register(\Spatie\LaravelRay\RayServiceProvider::class);

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

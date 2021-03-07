<?php namespace RainLab\Ray;

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
            'author'      => 'RainLab',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

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

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'RainLab\Ray\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'rainlab.ray.some_permission' => [
                'tab' => 'Ray',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'ray' => [
                'label'       => 'Ray',
                'url'         => Backend::url('rainlab/ray/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['rainlab.ray.*'],
                'order'       => 500,
            ],
        ];
    }
}

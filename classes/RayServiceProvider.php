<?php

namespace Winter\Ray\Classes;

use Spatie\LaravelRay\RayServiceProvider as BaseRayServiceProvider;
use Spatie\Ray\Settings\Settings;
use Spatie\Ray\Settings\SettingsFactory;

class RayServiceProvider extends BaseRayServiceProvider
{
    protected function registerSettings(): BaseRayServiceProvider
    {
        $this->app->singleton(Settings::class, function ($app) {
            $settings = SettingsFactory::createFromArray($app['config']->get('winter.ray::config', []));

            return $settings->setDefaultSettings([
                'enable' => env('RAY_ENABLED', ! app()->environment('production')),
                'send_cache_to_ray' => env('SEND_CACHE_TO_RAY', false),
                'send_dumps_to_ray' => env('SEND_DUMPS_TO_RAY', true),
                'send_jobs_to_ray' => env('SEND_JOBS_TO_RAY', false),
                'send_log_calls_to_ray' => env('SEND_LOG_CALLS_TO_RAY', true),
                'send_queries_to_ray' => env('SEND_QUERIES_TO_RAY', false),
                'send_duplicate_queries_to_ray' => env('SEND_DUPLICATE_QUERIES_TO_RAY', false),
                'send_slow_queries_to_ray' => env('SEND_SLOW_QUERIES_TO_RAY', false),
                'send_requests_to_ray' => env('SEND_REQUESTS_TO_RAY', false),
                'send_http_client_requests_to_ray' => env('SEND_HTTP_CLIENT_REQUESTS_TO_RAY', false),
                'send_views_to_ray' => env('SEND_VIEWS_TO_RAY', false),
                'send_exceptions_to_ray' => env('SEND_EXCEPTIONS_TO_RAY', true),
                'send_deprecated_notices_to_ray' => env('SEND_DEPRECATED_NOTICES_TO_RAY', false),
            ]);
        });

        return $this;
    }
}

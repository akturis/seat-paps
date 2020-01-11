<?php

namespace Seat\Akturis\Paps;

use Illuminate\Console\Scheduling\Schedule;
use Seat\Kassie\Calendar\Observers\OperationObserver;
use Seat\Kassie\Calendar\Models\Operation;
use Seat\Kassie\Calendar\Commands\RemindOperation;
use Seat\Services\AbstractSeatPlugin;

/**
 * Class CalendarServiceProvider.
 * @package Seat\Kassie\Calendar
 */
class PapsServiceProvider extends AbstractSeatPlugin
{
    public function boot()
    {
//        $this->addCommands();
        $this->addRoutes();
        $this->addViews();
        $this->addTranslations();
        $this->addMigrations();
        $this->addPublications();
        $this->addObservers();
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/package.sidebar.php', 'package.sidebar');
        $this->mergeConfigFrom(__DIR__ . '/Config/paps.character.menu.php', 'package.character.menu');
        $this->mergeConfigFrom(__DIR__ . '/Config/paps.corporation.menu.php', 'package.corporation.menu');
        $this->mergeConfigFrom(__DIR__ . '/Config/paps.permissions.php', 'web.permissions');
        $this->mergeConfigFrom(__DIR__ . '/Config/character.permission.php', 'web.permissions.character');
        $this->mergeConfigFrom(__DIR__ . '/Config/corporation.permission.php', 'web.permissions.corporation');
        $this->mergeConfigFrom(__DIR__ . '/Config/paps.config.php', 'paps.config');
    }

    private function addRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    private function addViews()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'paps');
    }

    private function addTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'paps');
    }

    private function addMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    private function addPublications() 
    {
        $this->publishes([
            __DIR__ . '/resources/assets/css' => public_path('web/css'),
            __DIR__ . '/resources/assets/vendors/css' => public_path('web/css'),
            __DIR__ . '/resources/assets/js' => public_path('web/js'),
            __DIR__ . '/resources/assets/vendors/js' => public_path('web/js'),
        ]);
    }

    private function addObservers() 
    {
        Operation::observe(OperationObserver::class);
    }

    private function addCommands() 
    {
    }

    /**
     * Return the plugin public name as it should be displayed into settings.
     *
     * @example SeAT Web
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Paps';
    }

    /**
     * Return the plugin repository address.
     *
     * @example https://github.com/eveseat/web
     *
     * @return string
     */
    public function getPackageRepositoryUrl(): string
    {
        return 'https://github.com/Akturis/seat-paps';
    }

    /**
     * Return the plugin technical name as published on package manager.
     *
     * @example web
     *
     * @return string
     */
    public function getPackagistPackageName(): string
    {
        return 'paps';
    }

    /**
     * Return the plugin vendor tag as published on package manager.
     *
     * @example eveseat
     *
     * @return string
     */
    public function getPackagistVendorName(): string
    {
        return 'akturis';
    }

    /**
     * Return the plugin installed version.
     *
     * @return string
     */
    public function getVersion(): string
    {
        return config('paps.config.version');
    }
}

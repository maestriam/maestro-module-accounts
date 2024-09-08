<?php

namespace Maestro\Accounts\Services\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Maestriam\Maestro\Foundation\Registers\FileRegister;
use Maestro\Accounts\Http\Rules\UniqueAccount;
use Maestro\Accounts\Support\Facades\ModuleFacade;
use Maestro\Accounts\Views\Components\AccountForm;

class AccountsServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Accounts';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'accounts';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerComponents();
        $this->registerSeeds();
        $this->registerFacade();
        $this->registerRules();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(FoundationServiceProvider::class);
    }

    public function registerComponents()
    {
        Livewire::component('accounts.account-form', AccountForm::class);            
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $file = 'Resources/config/config.php';

        $this->publishes([
            module_path($this->moduleName, $file) => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, $file), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }        
    }

    /**
     * Registra o facade de suporte, para fornecer 
     * funcionalidades para outros módulos.
     *
     * @return self
     */
    protected function registerFacade() : self
    {
        $this->app->bind('accounts',function() {
            return new ModuleFacade();
        });   
        
        return $this;
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    private function registerSeeds() : self
    {
        $path = __DIR__ . '/../../Database/Seeders';

        FileRegister::from($path);

        return $this;
    }

    
    private function registerRules()
    {
        /*$rule = 'Maestro\Accounts\Http\Rules\UniqueAccount@passes';
        
        $message = __('accounts::validations.unique');*/

        Validator::extend('accounts.unique', UniqueAccount::class);
    }
}

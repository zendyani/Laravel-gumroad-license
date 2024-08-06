<?php

namespace App\Providers;

use App\Services\ApiKeyService;
use App\Services\LicenseService;
use App\Repositories\LicenseRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\FigmaUserRepository;
use App\Modules\License\Port\ApiKeyServiceInterface;
use App\Modules\License\Port\LicenseServiceInterface;
use App\Modules\License\Repository\LicenseRepositoryInterface;
use App\Modules\License\Repository\FigmaUserRepositoryInterface;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        $this->app->bind(FigmaUserRepositoryInterface::class, FigmaUserRepository::class);
        $this->app->bind(LicenseRepositoryInterface::class, LicenseRepository::class);
        $this->app->bind(LicenseServiceInterface::class, LicenseService::class);
        $this->app->bind(ApiKeyServiceInterface::class, ApiKeyService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        //
    }
}

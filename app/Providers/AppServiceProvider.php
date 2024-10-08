<?php

namespace App\Providers;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;
use App\Modules\License\Domain\Port\ApiKeyServiceInterface;
use App\Modules\License\Domain\Port\LicenseServiceInterface;
use App\Modules\License\Application\Commands\GetTokenCommand;
use App\Modules\License\Infrastructure\Services\ApiKeyService;
use App\Modules\License\Infrastructure\Services\LicenseService;
use App\Modules\License\Application\CommandHandlers\GetTokenHandler;
use App\Modules\License\Application\Commands\GetLicenseOffersCommand;
use App\Modules\License\Domain\Repositories\LicenseRepositoryInterface;
use App\Modules\License\Domain\Repositories\FigmaUserRepositoryInterface;
use App\Modules\License\Application\Commands\ValidateAndSaveLicenseCommand;
use App\Modules\License\Application\CommandHandlers\GetLicenseOffersHandler;
use App\Modules\License\Infrastructure\Persistence\Eloquent\LicenseRepository;
use App\Modules\License\Infrastructure\Persistence\Eloquent\FigmaUserRepository;
use App\Modules\License\Application\CommandHandlers\ValidateAndSaveLicenseHandler;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {

        // Repositories
        $this->app->bind(FigmaUserRepositoryInterface::class, FigmaUserRepository::class);
        $this->app->bind(LicenseRepositoryInterface::class, LicenseRepository::class);

        // Services
        $this->app->bind(LicenseServiceInterface::class, LicenseService::class);
        $this->app->bind(ApiKeyServiceInterface::class, ApiKeyService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        // Commands
        Bus::map([
            GetLicenseOffersCommand::class => GetLicenseOffersHandler::class,
            GetTokenCommand::class => GetTokenHandler::class,
            ValidateAndSaveLicenseCommand::class => ValidateAndSaveLicenseHandler::class
        ]);
    }
}

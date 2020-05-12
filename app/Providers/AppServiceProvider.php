<?php

namespace App\Providers;

use App\Http\Repository\FinanceRepository;
use App\Http\Repository\FinanceRepositoryInterface;

use App\Http\Services\FinanceService;
use App\Http\Services\FinanceServiceInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FinanceServiceInterface::class, FinanceService::class);
        $this->app->bind(FinanceRepositoryInterface::class, FinanceRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

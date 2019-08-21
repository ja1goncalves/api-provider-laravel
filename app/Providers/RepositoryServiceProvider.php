<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\AddressRepository::class, \App\Repositories\AddressRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BankRepository::class, \App\Repositories\BankRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BanksProvidersSegmentRepository::class, \App\Repositories\BanksProvidersSegmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FidelityRepository::class, \App\Repositories\FidelityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderRepository::class, \App\Repositories\OrderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrdersProgramRepository::class, \App\Repositories\OrdersProgramRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrdersStatusRepository::class, \App\Repositories\OrdersStatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PreProviderRepository::class, \App\Repositories\PreProviderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProgramRepository::class, \App\Repositories\ProgramRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProgramsQuotationRepository::class, \App\Repositories\ProgramsQuotationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProviderRepository::class, \App\Repositories\ProviderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\QuotationRepository::class, \App\Repositories\QuotationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SegmentRepository::class, \App\Repositories\SegmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PasswordResetRepository::class, \App\Repositories\PasswordResetRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PendingEditionRepository::class, \App\Repositories\PendingEditionRepositoryEloquent::class);
        //:end-bindings:
    }
}

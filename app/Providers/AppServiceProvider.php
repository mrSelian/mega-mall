<?php

namespace App\Providers;

use App\DbAddressRepository;
use App\DbOrderRepository;
use App\DbProductRepository;
use App\DbSellerRepository;
use App\Domain\AddressRepositoryInterface;
use App\Domain\CartRepositoryInterface;
use App\Domain\OrderRepositoryInterface;
use App\Domain\ProductRepositoryInterface;
use App\Domain\SellerInfoRepositoryInterface;
use App\SessionCartRepository;
use Illuminate\Support\Facades\Schema;
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
        $this->app->bind(CartRepositoryInterface::class, SessionCartRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, DbProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, DbOrderRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, DbAddressRepository::class);
        $this->app->bind(SellerInfoRepositoryInterface::class, DbSellerRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @param CartRepositoryInterface $cartRepository
     * @return void
     */
    public function boot(CartRepositoryInterface $cartRepository)
    {
        Schema::defaultStringLength(191);
        view()->composer('*', fn($view) => $view->with('cart', $cartRepository->get()));
    }
}

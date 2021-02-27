<?php

namespace App\Providers;

use App\DbAddressRepository;
use App\DbCustomerRepository;
use App\DbOrderRepository;
use App\DbProductRepository;
use App\DbShopProfileRepository;
use App\Domain\AddressRepositoryInterface;
use App\Domain\CartRepositoryInterface;
use App\Domain\CustomerRepositoryInterface;
use App\Domain\OrderRepositoryInterface;
use App\Domain\ProductRepositoryInterface;
use App\Domain\ShopProfileRepositoryInterface;
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
        $this->app->bind(ShopProfileRepositoryInterface::class, DbShopProfileRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, DbCustomerRepository::class);

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

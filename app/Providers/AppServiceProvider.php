<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;

// Contracts
use App\Contracts\ClientServiceInterface;
use App\Contracts\EmployeeServiceInterface;
use App\Contracts\ServiceServiceInterface;
use App\Contracts\AppointmentServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\RoleServiceInterface;
use App\Contracts\ModuleServiceInterface;

use Illuminate\Support\Facades\View;

// Services
use App\Services\ClientService;
use App\Services\EmployeeService;
use App\Services\ServiceService;
use App\Services\AppointmentService;
use App\Services\UserService;
use App\Services\RoleService;
use App\Services\ModuleService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(ClientServiceInterface::class, ClientService::class);
        $this->app->bind(EmployeeServiceInterface::class, EmployeeService::class);
        $this->app->bind(ServiceServiceInterface::class, ServiceService::class);
        $this->app->bind(AppointmentServiceInterface::class, AppointmentService::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->bind(ModuleServiceInterface::class, ModuleService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
    }
}

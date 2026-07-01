<?php

namespace App\Providers;

use App\Modules\Livros\Domain\Contracts\LivroRepositoryInterface;
use App\Modules\Livros\Infrastructure\Repositories\LivroRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            LivroRepositoryInterface::class,
            LivroRepository::class
        );
    }

    public function boot(): void
    {
    }
}

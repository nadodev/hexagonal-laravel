<?php

namespace App\Providers;

use App\Modules\Books\Application\Ports\In\CreateBookUseCaseInterface;
use App\Modules\Livros\Application\UseCases\CadastrarLivroUseCase;
use App\Modules\Livros\Domain\Contracts\LivroRepositoryInterface;
use App\Modules\Livros\Infrastructure\Repositories\LivroRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
    }
}

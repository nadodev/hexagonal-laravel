<?php

namespace App\Modules\Livros\Infrastructure\Providers;

use App\Modules\Livros\Application\Ports\In\CadastrarLivroUseCaseInterface;
use App\Modules\Livros\Application\Ports\Out\LivroRepositoryInterface;
use App\Modules\Livros\Application\UseCases\CadastrarLivroUseCase;
use App\Modules\Livros\Infrastructure\Repositories\LivroRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class LivroServiceProvider extends ServiceProvider
{
  public function register(): void
  {
    $this->app->bind(
      CadastrarLivroUseCaseInterface::class,
      CadastrarLivroUseCase::class,
    );

    $this->app->bind(
      LivroRepositoryInterface::class,
      LivroRepository::class
    );
  }

  public function boot(): void
  {
    Route::middleware('web')
      ->group(
        app_path('Modules/Livros/Presentation/Http/Routes/web.php')
      );
  }
}

<?php

namespace App\Modules\Livros\Application\UseCases;


use App\Modules\Livros\Application\Ports\out\LivroRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ListaLivrosUseCase
{
  public function __construct(
    private readonly LivroRepositoryInterface $livroRepository,
  ) {
  }

  public function execute(): Collection
  {
    return $this->livroRepository->listar();
  }
}


<?php

namespace App\Modules\Livros\Domain\Contracts;

use App\Modules\Livros\Infrastructure\Models\Livro;
use Illuminate\Database\Eloquent\Collection;

interface LivroRepositoryInterface
{
  public function salvar(\App\Modules\Livros\Domain\Entities\Livro $livro): \App\Modules\Livros\Domain\Entities\Livro;
  public function existeComIsbn(string $isbn): bool;

  public function listar(): Collection;
}

<?php

namespace App\Modules\Livros\Application\Ports\out;


use App\Modules\Livros\Domain\Entities\Livro;
use Illuminate\Database\Eloquent\Collection;

interface LivroRepositoryInterface
{
  public function salvar(Livro $livro): Livro;
  public function existeComIsbn(string $isbn): bool;
  public function listar(): Collection;
}

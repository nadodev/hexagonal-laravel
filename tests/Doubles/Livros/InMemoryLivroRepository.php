<?php

namespace Tests\Doubles\Livros;

use App\Modules\Livros\Domain\Contracts\LivroRepositoryInterface;
use App\Modules\Livros\Domain\Entities\Livro;
use Illuminate\Database\Eloquent\Collection;

class InMemoryLivroRepository implements LivroRepositoryInterface
{
  /**
   * @var Livro[]
   */
  private array $livros = [];

  public function salvar(Livro $livro): Livro
  {
    $livroSalvo = new Livro(
      id: count($this->livros) + 1,
      nome: $livro->nome(),
      autor: $livro->autor(),
      descricao: $livro->descricao(),
      jaLeu: $livro->jaLeu(),
      paginas: $livro->paginas(),
      genero: $livro->genero(),
      isbn: $livro->isbn(),
    );

    $this->livros[] = $livroSalvo;

    return $livroSalvo;
  }

  public function existeComIsbn(string $isbn): bool
  {
    foreach ($this->livros as $livro) {
      if ($livro->isbn() === $isbn) {
        return true;
      }
    }

    return false;
  }

  public function listar(): Collection
  {
    return new Collection($this->livros);
  }
}

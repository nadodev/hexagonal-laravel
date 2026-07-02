<?php

namespace App\Modules\Livros\Infrastructure\Repositories;

use App\Modules\Livros\Application\Ports\out\LivroRepositoryInterface;
use App\Modules\Livros\Domain\Entities\Livro as LivroEntity;
use App\Modules\Livros\Infrastructure\Models\Livro;
use Illuminate\Database\Eloquent\Collection;

class LivroRepository implements LivroRepositoryInterface
{
  public function salvar(LivroEntity $livro): LivroEntity
  {
    $model = Livro::query()->create([
      'nome' => $livro->nome(),
      'autor' => $livro->autor(),
      'descricao' => $livro->descricao(),
      'ja_leu' => $livro->jaLeu(),
      'paginas' => $livro->paginas(),
      'genero' => $livro->genero(),
      'isbn' => $livro->isbn(),
    ]);

    return $this->toDomain($model);
  }

  public function existeComIsbn(string $isbn): bool
  {
    return Livro::query()
      ->where('isbn', $isbn)
      ->exists();
  }

  private function toDomain(Livro $model): LivroEntity
  {
    return new LivroEntity(
      id: $model->id,
      nome: $model->nome,
      autor: $model->autor,
      descricao: $model->descricao,
      jaLeu: $model->ja_leu,
      paginas: $model->paginas,
      genero: $model->genero,
      isbn: $model->isbn,
    );
  }

  public function listar(): Collection
  {
    $models = Livro::query()
      ->orderBy('id', 'desc')
      ->get();

    return $models;
  }
}

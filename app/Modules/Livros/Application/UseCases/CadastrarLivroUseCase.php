<?php

namespace App\Modules\Livros\Application\UseCases;

use App\Modules\Livros\Application\DTOs\CadastrarLivroData;
use App\Modules\Livros\Application\Ports\In\CadastrarLivroUseCaseInterface;
use App\Modules\Livros\Application\Ports\Out\LivroRepositoryInterface;
use App\Modules\Livros\Domain\Entities\Livro;
use App\Modules\Livros\Domain\Exceptions\LivroJaExisteException;

class CadastrarLivroUseCase implements CadastrarLivroUseCaseInterface
{
  public function __construct(
    private readonly LivroRepositoryInterface $livroRepository,
  ) {
  }

  public function execute(CadastrarLivroData $data): Livro
  {
    if ($this->livroRepository->existeComIsbn($data->isbn)) {
      throw LivroJaExisteException::comIsbn($data->isbn);
    }

    $livro = Livro::cadastrar(
      nome: $data->nome,
      autor: $data->autor,
      descricao: $data->descricao,
      jaLeu: $data->jaLeu,
      paginas: $data->paginas,
      genero: $data->genero,
      isbn: $data->isbn,
    );

    return $this->livroRepository->salvar($livro);
  }
}

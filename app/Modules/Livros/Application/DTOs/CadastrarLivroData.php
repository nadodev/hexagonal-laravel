<?php

namespace App\Modules\Livros\Application\DTOs;

class CadastrarLivroData
{
  public function __construct(
    public string $nome,
    public string $autor,
    public string $descricao,
    public bool $jaLeu,
    public int $paginas,
    public string $genero,
    public string $isbn
  ) {
  }


}

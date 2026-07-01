<?php

namespace App\Modules\Livros\Domain\Entities;

use InvalidArgumentException;

class Livro
{
  public function __construct(
    private ?int $id,
    private string $nome,
    private string $autor,
    private ?string $descricao,
    private bool $jaLeu,
    private int $paginas,
    private ?string $genero,
    private string $isbn,
  ) {
    $this->validar();
  }

  public static function cadastrar(
    string $nome,
    string $autor,
    ?string $descricao,
    bool $jaLeu,
    int $paginas,
    ?string $genero,
    string $isbn,
  ): self {
    return new self(
      id: null,
      nome: $nome,
      autor: $autor,
      descricao: $descricao,
      jaLeu: $jaLeu,
      paginas: $paginas,
      genero: $genero,
      isbn: $isbn,
    );
  }

  private function validar(): void
  {
    if (trim($this->nome) === '') {
      throw new InvalidArgumentException('O nome do livro é obrigatório.');
    }

    if (trim($this->autor) === '') {
      throw new InvalidArgumentException('O autor do livro é obrigatório.');
    }

    if (trim($this->isbn) === '') {
      throw new InvalidArgumentException('O ISBN do livro é obrigatório.');
    }

    if ($this->paginas <= 0) {
      throw new InvalidArgumentException('O livro precisa ter pelo menos uma página.');
    }
  }

  public function id(): ?int
  {
    return $this->id;
  }

  public function nome(): string
  {
    return $this->nome;
  }

  public function autor(): string
  {
    return $this->autor;
  }

  public function descricao(): ?string
  {
    return $this->descricao;
  }

  public function jaLeu(): bool
  {
    return $this->jaLeu;
  }

  public function paginas(): int
  {
    return $this->paginas;
  }

  public function genero(): ?string
  {
    return $this->genero;
  }

  public function isbn(): string
  {
    return $this->isbn;
  }
}

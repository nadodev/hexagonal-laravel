<?php

namespace App\Modules\Livros\Domain\Exceptions;


use DomainException;

class LivroJaExisteException extends DomainException
{
  public static function comIsbn(string $isbn): self
  {
    return new self("Já existe um livro cadastrado com o ISBN: {$isbn}");
  }
}

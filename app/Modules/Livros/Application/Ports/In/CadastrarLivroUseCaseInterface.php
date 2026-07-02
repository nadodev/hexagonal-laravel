<?php

namespace App\Modules\Livros\Application\Ports\In;


use App\Modules\Livros\Application\DTOs\CadastrarLivroData;
use App\Modules\Livros\Domain\Entities\Livro;

interface CadastrarLivroUseCaseInterface
{
    public function execute(CadastrarLivroData $dto): Livro;
}

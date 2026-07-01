<?php

namespace Tests\Unit\Livros;

use PHPUnit\Framework\TestCase;
use Tests\Doubles\Livros\InMemoryLivroRepository;
use App\Modules\Livros\Application\DTOs\CadastrarLivroData;
use App\Modules\Livros\Application\UseCases\CadastrarLivroUseCase;

class BookRegistrationTest extends TestCase
{
    public function test_deve_cadastrar_um_livro(): void
    {
        $repository = new InMemoryLivroRepository();

        $useCase = new CadastrarLivroUseCase($repository);

        $livro = $useCase->execute(
            new CadastrarLivroData(
                nome: 'O Senhor dos Anéis',
                autor: 'J.R.R. Tolkien',
                descricao: 'Uma épica jornada pela Terra-média.',
                jaLeu: true,
                paginas: 1178,
                genero: 'Fantasia',
                isbn: '978-0261102385',
            )
        );

        $this->assertNotNull($livro->id());
        $this->assertEquals('O Senhor dos Anéis', $livro->nome());
        $this->assertEquals('J.R.R. Tolkien', $livro->autor());
        $this->assertTrue($livro->jaLeu());
        $this->assertEquals(1178, $livro->paginas());
        $this->assertEquals('978-0261102385', $livro->isbn());
    }

    public function test_nao_deve_cadastrar_um_livro_com_isbn_duplicado(): void
    {
        $repository = new InMemoryLivroRepository();

        $useCase = new CadastrarLivroUseCase($repository);

        $useCase->execute(
            new CadastrarLivroData(
                nome: 'O Senhor dos Anéis',
                autor: 'J.R.R. Tolkien',
                descricao: 'Uma épica jornada pela Terra-média.',
                jaLeu: true,
                paginas: 1178,
                genero: 'Fantasia',
                isbn: '978-0261102385',
            )
        );

        $this->expectException(\App\Modules\Livros\Domain\Exceptions\LivroJaExisteException::class);

        $useCase->execute(
            new CadastrarLivroData(
                nome: 'O Hobbit',
                autor: 'J.R.R. Tolkien',
                descricao: 'A aventura de Bilbo Bolseiro.',
                jaLeu: false,
                paginas: 310,
                genero: 'Fantasia',
                isbn: '978-0261102385', // ISBN duplicado
            )
        );
    }
}

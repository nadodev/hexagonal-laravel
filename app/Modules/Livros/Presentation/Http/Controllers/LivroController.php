<?php

namespace App\Modules\Livros\Presentation\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Livros\Application\DTOs\CadastrarLivroData;
use App\Modules\Livros\Application\Ports\In\CadastrarLivroUseCaseInterface;
use App\Modules\Livros\Application\UseCases\ListaLivrosUseCase;
use App\Modules\Livros\Presentation\Http\Requests\CadastrarLivroRequest;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LivroController extends Controller
{
    public function __construct(
        private readonly CadastrarLivroUseCaseInterface $cadastrarLivroUseCase,
        private readonly ListaLivrosUseCase $listaLivrosUseCase,
    ) {
    }

    public function create(): View
    {
        return view('livros.create');
    }

    public function index(): View
    {
        $livros = $this->listaLivrosUseCase->execute();

        return view('livros.index', compact('livros'));
    }

    public function store(CadastrarLivroRequest $request): RedirectResponse
    {
        $this->cadastrarLivroUseCase->execute(
            new CadastrarLivroData(
                nome: $request->input('nome'),
                autor: $request->input('autor'),
                descricao: $request->input('descricao'),
                jaLeu: $request->boolean('ja_leu'),
                paginas: $request->integer('paginas'),
                genero: $request->input('genero'),
                isbn: $request->input('isbn'),
            )
        );

        return redirect()->route('livros.index')->with('success', 'Livro cadastrado com sucesso!');
    }
}

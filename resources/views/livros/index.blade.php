<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Livros</title>

    {{-- Se estiver usando Vite no Laravel --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Se NÃO estiver usando Vite, pode usar temporariamente o CDN abaixo --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                    Lista de Livros
                </h1>

                <p class="mt-2 text-sm text-slate-600">
                    Gerencie os livros cadastrados no sistema.
                </p>
            </div>

            <a
                href="{{ route('livros.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-slate-700"
            >
                Novo Livro
            </a>
        </div>

        @if(session('error'))
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if($livros->isEmpty())
            <div class="rounded-xl border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">
                    Nenhum livro cadastrado ainda
                </h2>

                <p class="mt-2 text-sm text-slate-600">
                    Cadastre seu primeiro livro para começar o gerenciamento.
                </p>

                <a
                    href="#"
                    class="mt-6 inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-700"
                >
                    Cadastrar livro
                </a>
            </div>
        @else
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    ID
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Nome
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Autor
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Gênero
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Páginas
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Já leu
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    ISBN
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach($livros as $livro)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-slate-900">
                                        {{ $livro->id }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                        {{ $livro->nome }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                        {{ $livro->autor }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                        {{ $livro->genero ?? '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                        {{ $livro->paginas }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm">
                                        @if($livro->ja_leu)
                                            <span class="inline-flex rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">
                                                Sim
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-700">
                                                Não
                                            </span>
                                        @endif
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-700">
                                        {{ $livro->isbn }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </main>
</body>
</html>

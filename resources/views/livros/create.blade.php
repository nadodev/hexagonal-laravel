<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro</title>

    {{-- Se estiver usando Vite no Laravel --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Se NÃO estiver usando Vite, pode usar temporariamente o CDN --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>

<body class="min-h-screen bg-slate-100 text-slate-900">
    <main class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a
                href="/livros"
                class="mb-4 inline-flex text-sm font-medium text-slate-600 transition hover:text-slate-900"
            >
                ← Voltar para lista
            </a>

            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Cadastrar Livro
            </h1>

            <p class="mt-2 text-sm text-slate-600">
                Preencha os dados abaixo para cadastrar um novo livro.
            </p>
        </div>

        @if(session('mensagem'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('mensagem') }}
            </div>
        @endif

        <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <form action="/livros" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="nome" class="mb-1.5 block text-sm font-medium text-slate-700">
                        Nome
                    </label>

                    <input
                        id="nome"
                        name="nome"
                        type="text"
                        value="{{ old('nome') }}"
                        required
                        placeholder="Ex: O Senhor dos Anéis"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"
                    >

                    @error('nome')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="autor" class="mb-1.5 block text-sm font-medium text-slate-700">
                        Autor
                    </label>

                    <input
                        id="autor"
                        name="autor"
                        type="text"
                        value="{{ old('autor') }}"
                        required
                        placeholder="Ex: J.R.R. Tolkien"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"
                    >

                    @error('autor')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="descricao" class="mb-1.5 block text-sm font-medium text-slate-700">
                        Descrição
                    </label>

                    <textarea
                        id="descricao"
                        name="descricao"
                        rows="4"
                        placeholder="Escreva uma breve descrição do livro..."
                        class="block w-full resize-none rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"
                    >{{ old('descricao') }}</textarea>

                    @error('descricao')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <label for="paginas" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Páginas
                        </label>

                        <input
                            id="paginas"
                            name="paginas"
                            type="number"
                            min="1"
                            value="{{ old('paginas') }}"
                            required
                            placeholder="Ex: 350"
                            class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"
                        >

                        @error('paginas')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="genero" class="mb-1.5 block text-sm font-medium text-slate-700">
                            Gênero
                        </label>

                        <input
                            id="genero"
                            name="genero"
                            type="text"
                            value="{{ old('genero') }}"
                            required
                            placeholder="Ex: Fantasia"
                            class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"
                        >

                        @error('genero')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="isbn" class="mb-1.5 block text-sm font-medium text-slate-700">
                        ISBN
                    </label>

                    <input
                        id="isbn"
                        name="isbn"
                        type="text"
                        value="{{ old('isbn') }}"
                        required
                        placeholder="Ex: 978-0261102385"
                        class="block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10"
                    >

                    @error('isbn')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="hidden" name="ja_leu" value="0">

                    <label
                        for="ja_leu"
                        class="flex cursor-pointer items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 transition hover:bg-slate-100"
                    >
                        <input
                            id="ja_leu"
                            name="ja_leu"
                            type="checkbox"
                            value="1"
                            {{ old('ja_leu') ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900"
                        >

                        <span class="text-sm font-medium text-slate-700">
                            Já li este livro
                        </span>
                    </label>

                    @error('ja_leu')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">
                    <a
                        href="/livros"
                        class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2"
                    >
                        Salvar Livro
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

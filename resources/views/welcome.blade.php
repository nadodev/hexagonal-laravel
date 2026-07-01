<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 24px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }
        h1 {
            margin-top: 0;
            color: #222;
        }
        .field {
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }
        textarea {
            min-height: 120px;
            resize: vertical;
        }
        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        button {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            color: white;
            background: #2563eb;
            cursor: pointer;
            font-size: 15px;
        }
        button:hover {
            background: #1d4ed8;
        }
        .message {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 6px;
            background: #ecfdf5;
            color: #166534;
            border: 1px solid #d1fae5;
        }
        .error {
            margin-top: 6px;
            color: #b91c1c;
            font-size: 13px;
        }
        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastrar Livro</h1>

        @if(session('mensagem'))
            <div class="message">{{ session('mensagem') }}</div>
        @endif

        <form action="/livros" method="POST">
            @csrf

            <div class="field">
                <label for="nome">Nome</label>
                <input id="nome" name="nome" type="text" value="{{ old('nome') }}" required>
                @error('nome')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="autor">Autor</label>
                <input id="autor" name="autor" type="text" value="{{ old('autor') }}" required>
                @error('autor')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao">{{ old('descricao') }}</textarea>
                @error('descricao')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field checkbox-row">
                <input type="hidden" name="ja_leu" value="0">
                <input id="ja_leu" name="ja_leu" type="checkbox" value="1" {{ old('ja_leu') ? 'checked' : '' }}>
                <label for="ja_leu">Já li este livro</label>
            </div>
            @error('ja_leu')<div class="error">{{ $message }}</div>@enderror

            <div class="field">
                <label for="paginas">Páginas</label>
                <input id="paginas" name="paginas" type="number" min="1" value="{{ old('paginas') }}" required>
                @error('paginas')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="genero">Gênero</label>
                <input id="genero" name="genero" type="text" value="{{ old('genero') }}" required>
                @error('genero')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label for="isbn">ISBN</label>
                <input id="isbn" name="isbn" type="text" value="{{ old('isbn') }}" required>
                @error('isbn')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="actions">
                <button type="submit">Salvar Livro</button>
            </div>
        </form>
    </div>
</body>
</html>

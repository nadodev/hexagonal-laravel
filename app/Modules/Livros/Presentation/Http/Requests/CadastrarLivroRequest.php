<?php

namespace App\Modules\Livros\Presentation\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CadastrarLivroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'ja_leu' => 'required|boolean',
            'paginas' => 'required|integer|min:1',
            'genero' => 'required|string|max:100',
            'isbn' => 'required|string|max:20|unique:livros,isbn',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'autor.required' => 'O campo autor é obrigatório.',
            'ja_leu.required' => 'O campo já leu é obrigatório.',
            'paginas.required' => 'O campo páginas é obrigatório.',
            'genero.required' => 'O campo gênero é obrigatório.',
            'isbn.required' => 'O campo ISBN é obrigatório.',
            'isbn.unique' => 'Já existe um livro cadastrado com este ISBN.',
        ];
    }
}

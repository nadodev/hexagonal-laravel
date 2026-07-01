# Hexagonal Laravel - Aplicação de Estudo

<div align="center">

[![Laravel](https://img.shields.io/badge/Laravel-13.8-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php&logoColor=white)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)

Um projeto de **estudo prático** sobre Arquitetura Hexagonal (Ports & Adapters) aplicada ao Laravel, demonstrando como implementar Domain-Driven Design com separação clara de responsabilidades.

</div>

---

##  O Que É Este Projeto?

Este é um **projeto educacional** que implementa os princípios de **Arquitetura Hexagonal** em uma aplicação Laravel. O foco é demonstrar como estruturar uma aplicação para que o domínio (lógica de negócio) seja completamente independente do framework, facilitando testes, manutenção e escalabilidade.

### Por Que Arquitetura Hexagonal?

A arquitetura hexagonal (também conhecida como Ports & Adapters) oferece:

**Isolamento do domínio** - A lógica de negócio não depende do framework

**Testabilidade** - Testes unitários sem dependências externas

**Flexibilidade** - Trocar frameworks, bancos de dados ou implementações sem afetar o core

**Manutenibilidade** - Código mais limpo e organizado

**Escalabilidade** - Fácil adicionar novos módulos seguindo o mesmo padrão

---

## Arquitetura do Projeto

### Estrutura de Camadas

```
app/Modules/Livros/
├── Domain/
│   ├── Entities/
│   │   └── Livro.php
│   ├── Contracts/
│   │   └── LivroRepositoryInterface.php
│   └── Exceptions/
│       └── LivroJaExisteException.php
│
├── Application/
│   ├── UseCases/
│   │   ├── CadastrarLivroUseCase.php
│   │   └── ListaLivrosUseCase.php
│   └── DTOs/
│       └── CadastrarLivroData.php
│
├── Infrastructure/
│   ├── Repositories/
│   │   └── LivroRepository.php
│   └── Models/
│       └── Livro.php
│
└── Presentation/
    ├── Controllers/
    │   └── LivroController.php
    └── Requests/
        └── CadastrarLivroRequest.php
```

### Fluxo de Dados

```
Request HTTP
    ↓
CadastrarLivroRequest (Validação)
    ↓
LivroController.store() (Entrada)
    ↓
CadastrarLivroUseCase.execute() (Orquestração)
    ↓
Livro::cadastrar() (Lógica de Negócio)
    ↓
LivroRepository.salvar() (Porta)
    ↓
Livro Model → Database
    ↓
Redirect com sucesso
```

---

## O Que Foi Implementado

### 1. **Módulo de Livros**

Um módulo completo de cadastro de livros demonstrando toda a arquitetura hexagonal.

#### Funcionalidades:
- **Cadastro de Livros** - Adicionar novos livros com validação
- **Validação de Domínio** - ISBN único, campos obrigatórios
- **Listagem de Livros** - Recuperar todos os livros cadastrados
- **Testes Automatizados** - Testes unitários sem banco de dados

#### Campos do Livro:
```php
- nome           // Título do livro (obrigatório)
- autor          // Autor (obrigatório)
- descricao      // Descrição (opcional)
- genero         // Gênero do livro (obrigatório)
- paginas        // Quantidade de páginas (obrigatório, > 0)
- isbn           // ISBN único (obrigatório, único)
- ja_leu         // Se o usuário já leu (booleano)
```

---

## Como Foi Implementado - Detalhes Técnicos

### 1. **Camada de Domínio (Domain Layer)**

#### Entidade: `Livro.php`

A entidade contém a lógica de negócio pura:

```php
// Validações internas
- Nome, autor e ISBN são obrigatórios
- Páginas deve ser maior que 0
- ISBN deve ser único

// Factory Method
Livro::cadastrar() - Cria e valida uma nova instância

// Getters Imutáveis
$livro->id(), $livro->nome(), etc.
```

**Princípio aplicado**: A entidade é **independente de qualquer framework**. Pode ser usada em CLI, API, scripts, etc.

#### Contrato: `LivroRepositoryInterface.php`

Define a **porta** de persistência:

```php
interface LivroRepositoryInterface {
    public function salvar(Livro $livro): Livro;
    public function existeComIsbn(string $isbn): bool;
    public function listar(): array;
}
```

**Princípio aplicado**: Inversão de Dependência - O domínio define a interface, não a implementação.

### 2. **Camada de Aplicação (Application Layer)**

#### Use Case: `CadastrarLivroUseCase.php`

Orquestra o fluxo de cadastro:

```php
public function execute(CadastrarLivroData $data): Livro
{
    // 1. Valida se ISBN já existe
    if ($this->repository->existeComIsbn($data->isbn)) {
        throw new LivroJaExisteException($data->isbn);
    }

    // 2. Cria a entidade
    $livro = Livro::cadastrar($data);

    // 3. Persiste
    $livro = $this->repository->salvar($livro);

    // 4. Retorna
    return $livro;
}
```

**Princípio aplicado**: Casos de uso orquestram, não implementam. A lógica fica na entidade.

#### DTO: `CadastrarLivroData.php`

Transfer Object com dados de entrada:

```php
public function __construct(
    public string $nome,
    public string $autor,
    public ?string $descricao,
    public bool $jaLeu,
    public int $paginas,
    public string $genero,
    public string $isbn,
) {}
```

**Princípio aplicado**: Objetos simples de transferência de dados. Nenhuma lógica.

### 3. **Camada de Infraestrutura (Infrastructure Layer)**

#### Repositório: `LivroRepository.php`

Implementa a **porta** definida no domínio:

```php
class LivroRepository implements LivroRepositoryInterface
{
    // Mapeia Livro Entity → Livro Model
    public function toDomain(Model $model): Livro { }

    // Usa Eloquent para persistir
    public function salvar(Livro $livro): Livro { }

    // Busca no banco
    public function existeComIsbn(string $isbn): bool { }
}
```

**Princípio aplicado**: Anti-corruption Layer - Separa Modelo Eloquent da Entidade de Domínio.

#### Model: `Livro.php`

Apenas configuração do Eloquent:

```php
class Livro extends Model
{
    protected $fillable = ['nome', 'autor', 'descricao', ...];
}
```

**Princípio aplicado**: Model é apenas adaptador, não contém lógica.

### 4. **Camada de Apresentação (Presentation Layer)**

#### Controller: `LivroController.php`

Entrada HTTP:

```php
public function store(CadastrarLivroRequest $request): RedirectResponse
{
    // Request já validou
    $livro = $this->useCase->execute(
        new CadastrarLivroData(...$request->validated())
    );

    return redirect()->route('livros.index')
        ->with('success', 'Livro cadastrado!');
}
```

**Princípio aplicado**: Controller é fino - apenas traduz HTTP para domínio.

#### Form Request: `CadastrarLivroRequest.php`

Validação centralizada:

```php
public function rules(): array
{
    return [
        'nome'      => 'required|string',
        'autor'     => 'required|string',
        'paginas'   => 'required|integer|min:1',
        'isbn'      => 'required|unique:livros',
        'genero'    => 'required|string',
    ];
}
```

**Princípio aplicado**: Validação na borda da aplicação.

### 5. **Testes Unitários**

#### `BookRegistrationTest.php`

Testes sem banco de dados real:

```php
public function test_deve_cadastrar_um_livro()
{
    // InMemory repository - sem dependência de BD
    $repository = new InMemoryLivroRepository();

    $useCase = new CadastrarLivroUseCase($repository);

    $livro = $useCase->execute(new CadastrarLivroData(...));

    $this->assertEquals('O Senhor dos Anéis', $livro->nome());
}
```

**Princípio aplicado**: Testes rápidos e isolados. A lógica é testada sem efeitos colaterais.

---

## Setup e Execução

### Pré-requisitos
- PHP 8.3+
- Composer
- Node.js + npm
- Git

### Instalação

```bash
# 1. Clone o repositório
git clone <seu-repositorio>
cd hexagonal-laravel

# 2. Instale dependências PHP e configure
composer run setup

# 3. Inicie o desenvolvimento
composer run dev
```

Isso vai:
- Instalar dependências
- Gerar .env
- Criar chave de app
- Rodar migrations
- Instalar npm
- Compilar assets

### Estrutura de Comandos

```bash
# Rodar testes
composer test

# Iniciar servidor de desenvolvimento
php artisan serve

# Compilar assets (Vite)
npm run dev

# Lint/Format (Pint)
./vendor/bin/pint

# Ver estrutura de módulos
php artisan module:list
```

---

## Testando a Aplicação

### Rodar Testes

```bash
# Todos os testes
php artisan test

# Apenas testes de um módulo
php artisan test tests/Unit/Livros

# Com cobertura
php artisan test --coverage
```

### Testes Inclusos

**test_deve_cadastrar_um_livro** - Cadastro bem-sucedido

**test_nao_deve_cadastrar_um_livro_com_isbn_duplicado** - Validação de ISBN

---

## Pontos-Chave da Implementação

### 1. **Separação em Camadas**

Cada camada tem uma responsabilidade clara:

| Camada | Responsabilidade | Exemplo |
|--------|-----------------|---------|
| **Domain** | Lógica de negócio pura | Validação, factory methods |
| **Application** | Orquestração de casos de uso | Use cases, DTOs |
| **Infrastructure** | Implementações técnicas | Repositório, Model |
| **Presentation** | Interface com exterior | Controller, Form Request |

---

## Recursos para Aprender

### Conceitos Implementados

- **Domain-Driven Design (DDD)** - Foco na lógica de negócio
- **Ports & Adapters** - Arquitetura hexagonal
- **Inversion of Control (IoC)** - Inversão de dependências
- **Clean Code** - Código limpo e compreensível
- **Test-Driven Development** - Testes prioritários

### Estrutura Escalável

Para adicionar um novo módulo, basta seguir:

```
app/Modules/NovoModulo/
├── Domain/
│   ├── Entities/
│   ├── Contracts/
│   └── Exceptions/
├── Application/
│   ├── UseCases/
│   └── DTOs/
├── Infrastructure/
│   ├── Repositories/
│   └── Models/
└── Presentation/
    ├── Controllers/
    └── Requests/
```
---

## Próximos Passos (Ideias para Expandir)

- [ ] Adicionar autenticação com JWT
- [ ] Implementar eventos de domínio
- [ ] API REST completa
- [ ] Caching e otimizações
- [ ] Mais testes de integração
- [ ] Observability (logs, traces)

---

**Desenvolvido como projeto de estudo em Arquitetura Hexagonal com Laravel**

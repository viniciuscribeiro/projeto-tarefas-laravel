# Gerenciador de Tarefas (To-do List)

Este é um projeto de um Gerenciador de Tarefas (To-do list) desenvolvido como desafio técnico, utilizando o framework Laravel. A aplicação permite o cadastro, listagem, edição, exclusão (com soft-delete) e restauração de tarefas, seguindo as melhores práticas do framework.

O projeto também inclui um sistema de autenticação (Bônus), onde apenas usuários logados podem gerenciar suas tarefas.

## Requisitos Cobertos

  - [x] **1. Cadastro de tarefas:** Título, descrição opcional, status e data.
  - [x] **2. Listagem de tarefas:** Paginação e filtro por status.
  - [x] **3. Edição de tarefas:** Edição de título, descrição e status.
  - [x] **4. Exclusão de tarefas:** Botão de excluir.
  - [x] **5. Soft delete:** Lixeira e restauração de tarefas.
  - [x] **6. Validação:** Uso de `FormRequest` para validação no backend.
  - [x] **7. Rotas:** Uso de `Route::resource` e rotas customizadas.
  - [x] **8. Banco de dados:** Uso de *Migrations* do Laravel.
  - [x] **9. Modelo Eloquent:** Modelo `Task` configurado com `fillable` e `SoftDeletes`.
  - [x] **10. Views com Blade:** Uso de *layouts* e *partials* (`@extends`, `@yield`).
  - [x] **11. (Bônus) Autenticação:** Rotas protegidas com `middleware('auth')`.

-----

### 1\. Código Fonte

(Disponível neste repositório)

### 2\. Instruções para rodar a aplicação localmente

Para executar este projeto em seu ambiente de desenvolvimento, siga os passos abaixo:

1.  **Clonar o Repositório:**

    ```bash
    git clone https://github.com/viniciuscribeiro/projeto-tarefas-laravel.git
    cd projeto-tarefas
    ```

2.  **Copiar Arquivo de Ambiente:**

      * O arquivo `.env` não é enviado para o GitHub por segurança. Copie o arquivo de exemplo:

    <!-- end list -->

    ```bash
    cp .env.example .env
    ```

3.  **Configurar o Banco de Dados (XAMPP/WAMP):**

      * Abra seu painel de controle e inicie os serviços **Apache** e **MySQL**.
      * Crie um novo banco de dados (ex: `laravel_tarefas`).
      * Abra o arquivo `.env` e configure suas credenciais:

    <!-- end list -->

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_DATABASE=laravel_tarefas
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Instalar Dependências (PHP):**

    ```bash
    composer install
    ```

5.  **Gerar a Chave da Aplicação:**

    ```bash
    php artisan key:generate
    ```

6.  **Rodar as Migrations:**

      * Este comando irá criar todas as tabelas no banco de dados (tarefas, usuários, etc.).

    <!-- end list -->

    ```bash
    php artisan migrate
    ```

7.  **Iniciar o Servidor:**

    ```bash
    php artisan serve
    ```

8.  **Acessar a Aplicação:**

      * Abra seu navegador no endereço: **`http://127.0.0.1:8000`**
      * Você será redirecionado para a tela de Login. **Crie uma conta** para começar a usar.

*(Nota: Este projeto foi configurado para **NÃO** depender do `npm run dev`. O CSS é auto-contido no layout principal, garantindo funcionalidade imediata).*

-----

### 3\. Breve descrição das decisões tomadas e eventuais melhorias futuras

#### Decisões Tomadas

  * **Framework:** O projeto foi desenvolvido em **Laravel 12**, seguindo estritamente o padrão MVC (Model-View-Controller) solicitado.
  * **Banco de Dados (Req. 8, 9):** Foi utilizado o **Eloquent ORM** com *Migrations* para estruturar a tabela `tasks`. O `SoftDeletes` (Req. 5) foi implementado no *Model* e na *Migration* para permitir a restauração de tarefas.
  * **Rotas (Req. 7):** As rotas principais do CRUD foram implementadas usando `Route::resource()`. Rotas customizadas (`/tasks/trash` e `/tasks/{id}/restore`) foram adicionadas para gerenciar a lixeira.
  * **Validação (Req. 6):** Toda a validação dos dados de entrada é centralizada em uma classe `TaskRequest`, seguindo a melhor prática do Laravel para manter os *controllers* limpos.
  * **Views (Req. 10):** A interface foi construída com **Blade**, utilizando um layout principal (`layouts/app.blade.php`) que é estendido por todas as outras views (`@extends` e `@yield`). O CSS foi contido no layout principal para simplicidade e para evitar a complexidade do pipeline de *assets* (Vite/NPM), garantindo que o projeto funcione "fora da caixa".
  * **Bônus (Req. 11):** A autenticação foi implementada usando o *backend* do pacote **Laravel Breeze**. Todas as rotas de gerenciamento de tarefas foram agrupadas sob o *middleware* `auth` no arquivo `routes/web.php`, garantindo que apenas usuários logados possam acessá-las.

#### Melhorias Futuras

1.  **Tarefas por Usuário:** Atualmente, todos os usuários logados veem todas as tarefas. A melhoria mais importante seria adicionar um `user_id` na tabela `tasks` para que cada usuário veja e gerencie apenas as *suas próprias* tarefas.
2.  **Testes Automatizados:** Implementar testes unitários e de funcionalidade (PHPUnit/PEST) para garantir a estabilidade do CRUD e das regras de validação.
3.  **Front-end (AJAX):** Substituir os *reloads* de página ao criar ou editar uma tarefa por requisições assíncronas (AJAX/Fetch API), tornando a interface mais rápida e dinâmica.
4.  **Prioridades e Prazos:** Adicionar campos de `priority` (baixa, média, alta) e `due_date` (data de vencimento) ao *Model* `Task`.

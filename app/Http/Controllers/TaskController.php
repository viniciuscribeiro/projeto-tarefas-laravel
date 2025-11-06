<?php

namespace App\Http\Controllers;

// 1. Imports necessários
use App\Models\Task; // Nosso Model de Tarefa
use App\Http\Requests\TaskRequest; // Nosso Request de validação (Req. 6)
use Illuminate\Http\Request; // Request padrão para o 'index'

class TaskController extends Controller
{
    /**
     * Requisito 2: Listagem de tarefas
     * Exibe uma lista paginada das tarefas.
     * Inclui o filtro por status.
     */
    public function index(Request $request)
    {
        // Pega o 'status' da URL (query string)
        $status = $request->query('status');

        // Começa a query para buscar Tarefas
        $query = Task::query();

        // Requisito 2: Filtro por status
        if ($status === 'pendente' || $status === 'concluída') {
            $query->where('status', $status);
        }

        // Requisito 2: Paginação
        // Ordena pelas mais recentes e pagina (5 por página)
        $tasks = $query->latest()->paginate(5);

        // Retorna a view 'tasks.index' e passa as tarefas para ela
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Mostra o formulário para criar uma nova tarefa.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Requisito 1: Cadastro de tarefas
     * Salva uma nova tarefa no banco de dados.
     */
    public function store(TaskRequest $request)
    {
        // A validação (Req. 6) já foi feita pelo TaskRequest!
        // Pega os dados validados (title, description, status)
        $validatedData = $request->validated();

        // Cria a tarefa no banco
        Task::create($validatedData);

        // Redireciona para a página de listagem com uma msg de sucesso
        return redirect()->route('tasks.index')
                         ->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Mostra o formulário para editar uma tarefa existente.
     */
    public function edit(Task $task)
    {
        // O Laravel automaticamente encontra a Task pelo ID da URL
        // Isso se chama "Route Model Binding"

        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Requisito 3: Edição de tarefas
     * Atualiza uma tarefa específica no banco de dados.
     */
    public function update(TaskRequest $request, Task $task)
    {
        // A validação (Req. 6) também já foi feita!
        // O Laravel também já encontrou a $task.

        // Pega os dados validados
        $validatedData = $request->validated();

        // Atualiza a tarefa no banco
        $task->update($validatedData);

        // Redireciona de volta para a listagem com msg de sucesso
        return redirect()->route('tasks.index')
                         ->with('success', 'Tarefa atualizada com sucesso!');
    }

    /**
     * Requisito 4 e 5: Exclusão de tarefas (Soft Delete)
     * Remove logicamente uma tarefa.
     */
    public function destroy(Task $task)
    {
        // O Laravel já encontrou a $task.
        $task->delete(); // Isso executa o Soft Delete (Req. 5)

        return redirect()->route('tasks.index')
                         ->with('success', 'Tarefa movida para a lixeira!');
    }


    /*
     * --- MÉTODOS EXTRAS PARA SOFT DELETE (Req. 5) ---
     * O Route::resource não cria rotas para "lixeira" ou "restaurar".
     * Vamos precisar adicioná-las manualmente depois.
     * Por enquanto, vamos apenas criar os métodos.
     */

    /**
     * Requisito 5: Poder ser restauradas
     * Mostra a lista de tarefas que sofreram soft delete.
     */
    public function trash()
    {
        // Busca APENAS tarefas que estão na lixeira (soft deleted)
        $tasks = Task::onlyTrashed()->latest()->paginate(5);

        return view('tasks.trash', ['tasks' => $tasks]);
    }

    /**
     * Requisito 5: Poder ser restauradas
     * Restaura uma tarefa que estava na lixeira.
     */
    public function restore($id)
    {
        // Encontra uma tarefa na lixeira pelo ID
        $task = Task::onlyTrashed()->findOrFail($id);

        // Restaura a tarefa
        $task->restore();

        return redirect()->route('tasks.trash')
                         ->with('success', 'Tarefa restaurada com sucesso!');
    }
}

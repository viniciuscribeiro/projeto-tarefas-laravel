<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest; // Request de validação (Req. 6)
use Illuminate\Http\Request; // Request padrão para o 'index'

class TaskController extends Controller
{
    /**
     * Requisito 2: Listagem de tarefas
     */
    public function index(Request $request)
    {

        $status = $request->query('status');


        $query = Task::query();

        // Requisito 2: Filtro por status
        if ($status === 'pendente' || $status === 'concluída') {
            $query->where('status', $status);
        }

        // Requisito 2: Paginação

        $tasks = $query->latest()->paginate(5);


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
     */
    public function store(TaskRequest $request)
    {
        // A validação (Req. 6) já foi feita pelo TaskRequest!
        $validatedData = $request->validated();

        Task::create($validatedData);

        return redirect()->route('tasks.index')
            ->with('success', 'Tarefa criada com sucesso!');
    }

    /**
     * Mostra o formulário para editar uma tarefa existente.
     */
    public function edit(Task $task)
    {


        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Requisito 3: Edição de tarefas
     */
    public function update(TaskRequest $request, Task $task)
    {
        // A validação (Req. 6) também já foi feita!

        $validatedData = $request->validated();

        $task->update($validatedData);

        return redirect()->route('tasks.index')
            ->with('success', 'Tarefa atualizada com sucesso!');
    }

    /**
     * Requisito 4 e 5: Exclusão de tarefas (Soft Delete)
     */
    public function destroy(Task $task)
    {
        $task->delete(); // Isso executa o Soft Delete (Req. 5)

        return redirect()->route('tasks.index')
            ->with('success', 'Tarefa movida para a lixeira!');
    }


    /*
     * --- MÉTODOS EXTRAS PARA SOFT DELETE (Req. 5) ---

     */

    /**
     * Requisito 5: Poder ser restauradas
     */
    public function trash()
    {
        $tasks = Task::onlyTrashed()->latest()->paginate(5);

        return view('tasks.trash', ['tasks' => $tasks]);
    }

    /**
     * Requisito 5: Poder ser restauradas
     */
    public function restore($id)
    {
        $task = Task::onlyTrashed()->findOrFail($id);

        $task->restore();

        return redirect()->route('tasks.trash')
            ->with('success', 'Tarefa restaurada com sucesso!');
    }
}

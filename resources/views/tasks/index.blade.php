@extends('layouts.app')

@section('content')
    <h2>Lista de Tarefas</h2>

    <div class="filter-form">
        <form action="{{ route('tasks.index') }}" method="GET">
            <div class="form-group" style="max-width: 200px; display: inline-block;">
                <label for="status">Filtrar por Status:</label>
                <select name="status" id="status" onchange="this.form.submit()">
                    <option value="">Todas</option>
                    <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="concluída" {{ request('status') == 'concluída' ? 'selected' : '' }}>Concluída</option>
                </select>
            </div>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Status</th>
                <th>Data de Criação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->created_at->format('d/m/Y H:i') }}</td>
                    <td class="action-links">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-secondary">Editar</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja mover para a lixeira?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhuma tarefa encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $tasks->appends(request()->query())->links() }}
    </div>
@endsection

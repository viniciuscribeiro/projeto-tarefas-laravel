@extends('layouts.app')

@section('content')
    <h2>Lixeira de Tarefas</h2>

    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Status</th>
                <th>Data da Exclusão</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->deleted_at->format('d/m/Y H:i') }}</td>
                    <td class="action-links">

                        <form action="{{ route('tasks.restore', $task->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success">Restaurar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">A lixeira está vazia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $tasks->links() }}
    </div>
@endsection

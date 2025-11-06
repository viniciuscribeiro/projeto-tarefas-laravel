@extends('layouts.app')

@section('content')
    <h2>Editar Tarefa</h2>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf           {{-- Token de segurança --}}
        @method('PUT')  {{-- Define o método HTTP como PUT para atualização --}}

        <div class="form-group">
            <label for="title">Título (obrigatório, max 255):</label>
            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descrição (opcional):</label>
            <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="pendente" {{ old('status', $task->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="concluída" {{ old('status', $task->status) == 'concluída' ? 'selected' : '' }}>Concluída</option>
            </select>
        </div>

        <button type="submit" class="btn">Atualizar Tarefa</button>
    </form>
@endsection

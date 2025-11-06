@extends('layouts.app')

@section('content')
    <h2>Criar Nova Tarefa</h2>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf {{-- Token de segurança do Laravel --}}

        <div class="form-group">
            <label for="title">Título (obrigatório, max 255):</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descrição (opcional):</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="concluída" {{ old('status') == 'concluída' ? 'selected' : '' }}>Concluída</option>
            </select>
        </div>

        <button type="submit" class="btn">Salvar Tarefa</button>
    </form>
@endsection

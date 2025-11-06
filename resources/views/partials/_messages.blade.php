{{-- Este arquivo irá checar se existe uma mensagem 'success' na sessão --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Este bloco mostrará os erros de validação do TaskRequest (Req. 6) --}}
@if ($errors->any())
    <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">
        <strong>Ops! Ocorreram alguns erros:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

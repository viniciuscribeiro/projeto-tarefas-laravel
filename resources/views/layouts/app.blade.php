<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            color: #2c3e50;
        }

        nav a {
            text-decoration: none;
            color: #3498db;
            font-weight: 500;
            margin-right: 15px;
        }

        nav a:hover {
            color: #2980b9;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-secondary {
            background-color: #f39c12;
        }

        .btn-danger {
            background-color: #e74c3c;
        }

        .btn-success {
            background-color: #2ecc71;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .action-links a,
        .action-links button {
            margin-right: 10px;
        }

        .filter-form {
            margin-bottom: 20px;
        }

        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header-title-nav h1 {
            margin: 0;
            padding: 0;
        }

        .header-title-nav nav {
            margin-top: 10px;
        }

        .header-user-info {
            text-align: right;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="container">

        <header class="header-flex">

            <div class="header-title-nav">
                <h1>Gerenciador de Tarefas</h1>
                <nav>
                    <a href="{{ route('tasks.index') }}">Tarefas Ativas</a>
                    <a href="{{ route('tasks.create') }}">Nova Tarefa</a>
                    <a href="{{ route('tasks.trash') }}">Lixeira</a>
                </nav>
            </div>

            <div class="header-user-info">
                @auth
                <span style="display: block; margin-bottom: 5px;">Olá, {{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                            this.closest('form').submit();"
                        style="color: #e74c3c; font-weight: bold; text-decoration: none;">
                        Sair
                    </a>
                </form>
                @endauth
            </div>

        </header>

        <main>
            @include('partials._messages')
            @yield('content')
        </main>
    </div>
</body>

</html>

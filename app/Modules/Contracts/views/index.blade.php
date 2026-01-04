@extends('layouts.app')

@section('title', 'Договоры')

@section('content')
    <h2>Список договоров</h2>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Клиент</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contracts ?? [] as $contract)
                <tr>
                    <td>{{ $contract->id }}</td>
                    <td>{{ $contract->title }}</td>
                    <td>{{ $contract->client_id }}</td>
                    <td>
                        <a href="{{ route('contracts.edit', $contract->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить договор?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

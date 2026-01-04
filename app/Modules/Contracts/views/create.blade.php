@extends('layouts.module-layout')

@section('title', 'Создать договор')

@section('module_content')
    <h2>Создать договор</h2>
    <form action="{{ route('contracts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Название</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="mb-3">
            <label>ID клиента</label>
            <input type="number" name="client_id" class="form-control">
        </div>
        <button class="btn btn-success">Сохранить</button>
    </form>
@endsection
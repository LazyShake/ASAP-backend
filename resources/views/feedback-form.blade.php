@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Форма обратной связи</h2>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form action="{{ route('feedback.submit') }}" method="POST">
    @csrf <!-- Токен безопасности для защиты от CSRF-атак -->
    <div class="form-group">
        <label for="name">Ваше имя</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Ваш Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="message">Сообщение</label>
        <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-success mt-3">Отправить</button>
</form>
</div>
@endsection
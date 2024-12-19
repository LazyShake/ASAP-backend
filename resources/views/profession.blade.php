@extends('layouts.app')

@section('content')
<div class="profession-info">
    <h1>{{ $profession->name_profession }}</h1>
    <p class="description">{{ $profession->program }}</p>

    <div class="details">
        <p><strong>Стоимость обучения:</strong> {{ number_format($profession->price, 2) }} руб.</p>
        <p><strong>Продолжительность:</strong> {{ $profession->period ? $profession->period . ' дней' : 'Не указано' }}</p>
        <p><strong>Дата ближайшего старта:</strong> {{ \Carbon\Carbon::parse($profession->start_of_training)->format('d.m.Y') ?? 'Не указано' }}</p>
    </div>
</div>
@include('components.why-choose-us')
@include('components.how-we-teach')
@include('components.mentors-by-profession')
@include('components.what-youll-learn')
@include('components.grades')
@include('components.program')
@include('components.feedback')
@include('components.articles')
@include('components.progress')
@endsection




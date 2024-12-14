<div class="container">
        <h1>Менторы для профессии: {{ $profession->name_profession }}</h1>

        <div class="mentor-list">
            @foreach ($mentors as $mentor)
                <div class="mentor-card">
                    <img src="{{ $mentor->picture }}" alt="{{ $mentor->name_mentors }}" class="mentor-picture">
                    <div class="mentor-info">
                        <h3>{{ $mentor->name_mentors }}</h3>
                        <p><strong>Роль:</strong> {{ $mentor->role ?? 'Не указана' }}</p>
                        <p><strong>Описание:</strong> {{ $mentor->description ?? 'Нет описания' }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Список трекеров -->
        <h2>Трекеры</h2>
        <div class="tracker-list">
            @foreach ($trackers as $tracker)
                <div class="mentor-card">
                    <img src="{{ $tracker->picture }}" alt="{{ $tracker->name_mentors }}" class="mentor-picture">
                    <div class="mentor-info">
                        <h3>{{ $tracker->name_mentors }}</h3>
                        <p><strong>Роль:</strong> {{ $tracker->role ?? 'Не указана' }}</p>
                        <p><strong>Описание:</strong> {{ $tracker->description ?? 'Нет описания' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>
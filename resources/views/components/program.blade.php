<div class="container mt-5">
    <h1>Программа курса для профессии {{ $profession->name_profession }}</h1>

    @if($programs->isEmpty())
        <p>Программа для данной профессии отсутствует.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Название модуля</th>
                    <th>Тип программы</th>
                    <th>Содержание модуля</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programs as $program)
                <tr>
                    <td>{{ $program->number_module }}</td>
                    <td>{{ $program->name_module }}</td>
                    <td>{{ $program->type_program }}</td>
                    <td>{{ $program->content_module }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
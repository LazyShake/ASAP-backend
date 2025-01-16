@if($articles->isNotEmpty())
    <h3>Кейсы по этой профессии:</h3>
    <ul>
                @foreach($articles as $article)
                    <li>
                        <h4>{{ $article->name_article }}</h4>
                        <p>{{ $article->text }}</p>
                        @if($article->picture)
                            <img src="{{ asset($article->picture) }}" alt="Image for {{ $article->name_article }}" width="200">
                        @endif
                    </li>
                @endforeach
            </ul>
@else
    <p>Нет кейсов для этой профессии.</p>
@endif
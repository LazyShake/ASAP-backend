<div class="progress-images">
    @foreach($progress as $row)
        <div class="pair">
            <div class="image-container">
                <img src="{{ asset($row->before) }}" alt="Изображение до" class="image">
                <p class="caption">До</p>
            </div>
            <div class="image-container">
                <img src="{{ asset($row->after) }}" alt="Изображение после" class="image">
                <p class="caption">После</p>
            </div>
        </div>
    @endforeach
</div>


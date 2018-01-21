@foreach($movies as $movie)
    <a href="/movies/{{$movie->id}}">
        <div class="card">
            <div class="poster" style="background-image: url('{{ asset('img/uploads/poster/'.$movie->cover_image) }}');">
            </div>
            <div class="card-container">
                <h4><b>{{$movie->title}}</b></h4>
                <p><b>Genre: </b>{{ucwords($movie->genre)}}</p>
                <input type="text" class="rating" data-size="sm" value="{{$movie->avg_rating}}">
                <p><b>Release Date: </b>{{\Carbon\Carbon::parse($movie->release_date)->format('j F Y')}}</p>
                <p><b>Main Actors: </b>{{$movie->main_actors}}</p>
                <p><b>Director: </b>{{$movie->director}}</p>
                <p><b>Producer: </b>{{$movie->producer}}</p>
            </div>
        </div>
    </a>
@endforeach
<div style="text-align: center">
    {{ $movies->appends(request()->query())->links() }}
</div>
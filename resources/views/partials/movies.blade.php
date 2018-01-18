<div class="panel-body">
    @foreach($movies as $movie)
        <a href="/movies/{{$movie->id}}">
            <div class="card">
                <div class="poster" style="background-image: url('{{ asset('img/uploads/poster/'.$movie->cover_image) }}');">
                </div>
                <div class="card-container">
                    <h4><b>{{$movie->title}}</b></h4>
                    <input type="text" class="rating" data-size="sm" value="{{$movie->avg_rating}}">
                </div>
            </div>
        </a>
    @endforeach
</div>
<div class="panel-body" style="text-align: center">
    {{ $movies->links() }}
</div>
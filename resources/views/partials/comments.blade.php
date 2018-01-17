@foreach($ratings as $rating)
    <h4>{{$rating->user->name}}</h4>
    <input type="text" required class="other-rating" data-size="sm"
           value="{{$rating->rating}}">
    <p>{{$rating->comment ? $rating->comment : ''}}</p>
    <hr>
@endforeach
{{ $ratings->links() }}
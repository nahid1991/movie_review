@if($otherUsersRatings)
    @foreach($otherUsersRatings as $otherUsersRating)
        <h4>{{$otherUsersRating->user->name}}</h4>
        <input type="text" required class="others-rating" data-size="sm"
               value="{{$otherUsersRating->rating}}">
        <p>{{$otherUsersRating->comment ? $otherUsersRating->comment : ''}}</p>
        <br>
    @endforeach
    {{ $otherUsersRatings->links() }}
@else
    <h4>No ratings yet.</h4>
@endif
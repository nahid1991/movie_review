<?php

namespace App\QueryHandlers;

use App\Models\Movie;
use App\Models\MovieRating;
use Illuminate\Support\Facades\Auth;

class MovieQueries {
    public function moviesWithPagination() {
        $movies = Movie::with('ratings')
            ->orderBy('movies.created_at', 'desc')
            ->paginate(15);

        return $movies;
    }

    public function findMovieById($id) {
        $movie = Movie::with('ratings')
            ->where('id', '=', $id)
            ->orderBy('movies.created_at', 'desc')
            ->first();

        return $movie;
    }

    public function findMovieRatingForUser($id) {
        $userComment = MovieRating::where('user_id', '=', Auth::user()->id)
                                    ->where('movie_id', '=', $id)
                                    ->first();

        return $userComment;
    }

    public function movieRatings($id) {
        $ratings = MovieRating::where('movie_id', '=', $id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(5);

        return $ratings;
    }
}
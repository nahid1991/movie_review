<?php

namespace App\QueryHandlers;

use App\Models\Movie;

class MovieQueries {
    public function moviesWithPagination() {
        $movies = Movie::with('ratings')
            ->orderBy('movies.created_at', 'desc')
            ->paginate(15);

        return $movies;
    }
}
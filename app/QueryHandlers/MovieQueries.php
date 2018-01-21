<?php

namespace App\QueryHandlers;

use App\Models\Movie;
use App\Models\MovieRating;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class MovieQueries {
    public function moviesWithPagination($data = []) {
        $movies = Movie::query();
        $movies = $movies->with('ratings');

        if(!empty($data['genre'])) {
            $movies = $movies->where('genre', '=', $data['genre']);
        }

        if(!empty($data['keyword'])) {
            $movies = $movies->where(function($m) use($data){
                $m->where('title', 'LIKE', '%'.$data['keyword'].'%')
                    ->orWhere('description', 'LIKE', '%'.$data['keyword'].'%')
                    ->orWhere('main_actors', 'LIKE', '%'.$data['keyword'].'%')
                    ->orWhere('director', 'LIKE', '%'.$data['keyword'].'%')
                    ->orWhere('producer', 'LIKE', '%'.$data['keyword'].'%');
            });
        }

        $movies = $movies->orderBy('movies.release_date', 'desc')
            ->paginate(3);

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

    public function otherUsersRatings($id) {
        $ratings = MovieRating::where('movie_id', '=', $id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(5);

        return $ratings;
    }

    public function storeOrUpdateMovieReview($data) {
        try {
            $ratingExists = $this->storeOrUpdate($data['user_id'], $data['movie_id']);
            $saved = $this->processRating($ratingExists, $data);

            if($saved) {
                $avgRating = MovieRating::where('movie_id', '=', $data['movie_id'])
                    ->avg('rating');

                $avgRating = round($avgRating, 1, PHP_ROUND_HALF_UP);

                $movie = Movie::where('id', '=', $data['movie_id'])
                    ->first();

                $movie->avg_rating = $avgRating;
                return $movie->save();
            }

            return false;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function storeOrUpdate($id, $movieId) {
        $check = MovieRating::where('user_id', '=', $id)
                                ->where('movie_id', '=', $movieId)
                                ->get();

        return $check->count() > 0;
    }

    public function processRating($exists, $data) {
        if($exists == true) {
            $movieRating = MovieRating::where('user_id', '=', $data['user_id'])
                ->where('movie_id', '=', $data['movie_id'])
                ->first();

            $movieRating->rating = $data['rating'];
            $movieRating->comment = $data['comment'];
        } else {
            $movieRating = new MovieRating();

            $movieRating->user_id = $data['user_id'];
            $movieRating->movie_id = $data['movie_id'];
            $movieRating->rating = $data['rating'];
            $movieRating->comment = $data['comment'];
        }

        return $movieRating->save();
    }

    public function updateMovie($data) {
        $movie = Movie::where('id', '=', $data['id'])->first();

        $movie->title = $data['title'];
        $movie->description = $data['description'];
        $movie->main_actors = $data['main_actors'];
        $movie->director = $data['director'];
        $movie->producer = $data['producer'];
        $movie->genre = $data['genre'];
        $movie->release_date = $data['release_date'];
        $movie->cover_image = $data['cover_image'] != '' ? $data['cover_image'] : $movie->cover_image;

        return $movie->save();
    }

    public function storeMovie($data) {
        $movie = new Movie();

        $movie->title = $data['title'];
        $movie->description = $data['description'];
        $movie->main_actors = $data['main_actors'];
        $movie->director = $data['director'];
        $movie->producer = $data['producer'];
        $movie->genre = $data['genre'];
        $movie->release_date = $data['release_date'];
        $movie->cover_image = $data['cover_image'] != '' ? $data['cover_image'] : $movie->cover_image;

        return [$movie->save(), $movie->id];
    }
}
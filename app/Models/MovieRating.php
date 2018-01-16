<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieRating extends Model
{
    protected $table='movie_ratings';

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

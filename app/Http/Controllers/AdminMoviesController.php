<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminMoviesController extends Controller
{
    public function create() {
        return "Test";
    }

    public function edit($id) {
        return view('admin.movies.edit');
    }
}

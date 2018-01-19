<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\QueryHandlers\MovieQueries;
use Mockery\Exception;

class AdminMoviesController extends Controller
{
    protected $movies;

    public function __construct(MovieQueries $movies)
    {
        $this->movies = $movies;
    }

    public function create() {
        return view('admin.movies.create');
    }

    public function store(Request $request) {
        $fileName = '';
        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
            try {
                $coverImageUpload   = $request->file('cover_image');
                $destinationPath    = 'img/uploads/poster';
                $fileName           = md5($coverImageUpload) . '.' . $coverImageUpload->getClientOriginalExtension();
                $coverImageUpload->move($destinationPath, $fileName);
            } catch (Exception $e) {
                $request->session()->flash('alert-danger', 'An error occured!');
                return redirect()->back();
            }
        }

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'main_actors' => $request->input('main_actors'),
            'director' => $request->input('director'),
            'producer' => $request->input('producer'),
            'release_date' => Carbon::createFromFormat('j F Y', $request->input('release_date')),
            'genre' => $request->input('genre'),
            'cover_image' => strlen($fileName) > 0 ? $fileName : ''
        ];

        $stored = $this->movies->storeMovie($data);
        if($stored[0]) {
            $request->session()->flash('alert-success', 'Movie data was successfully added!');
            return redirect('admin/movies/'.$stored[1].'/edit');
        } else {
            $request->session()->flash('alert-danger', 'An error occured!');
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function edit($id) {
        $movie = $this->movies->findMovieById($id);
        return view('admin.movies.edit', compact('movie'));
    }

    public function update($id, Request $request) {
        $fileName = '';
        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
            try {
                $coverImageUpload   = $request->file('cover_image');
                $destinationPath    = 'img/uploads/poster';
                $fileName           = md5($coverImageUpload) . '.' . $coverImageUpload->getClientOriginalExtension();
                $coverImageUpload->move($destinationPath, $fileName);
            } catch (Exception $e) {
                $request->session()->flash('alert-danger', 'An error occured!');
                return redirect()->back();
            }
        }

        $data = [
            'id' => $id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'main_actors' => $request->input('main_actors'),
            'director' => $request->input('director'),
            'producer' => $request->input('producer'),
            'release_date' => Carbon::createFromFormat('j F Y', $request->input('release_date')),
            'genre' => $request->input('genre'),
            'cover_image' => strlen($fileName) > 0 ? $fileName : ''
        ];

        if($this->movies->updateMovie($data)) {
            $request->session()->flash('alert-success', 'Movie data was successfully updated!');
        } else {
            $request->session()->flash('alert-danger', 'An error occured!');
        }
        return redirect()->back();
    }
}

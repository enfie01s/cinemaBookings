<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use \Waavi\Sanitizer\Sanitizer;

class MovieController extends Controller
{
    /**
     * Display a listing of the movies.
     *
     * @return Response
     */
    public function index()
    {
        $data = array(
            'title' => 'Movie list',
            'active_movies' => 'active',
            'movies' => Movie::orderBy('created_at')->paginate(10),
        );
        return view('movies.index')->with($data);
    }

    /**
     * Display the form for creating a new movie.
     *
     * @return Response
     */
    public function create()
    {
        $title = "Create movie listing";
        return view('movies.create')->with('title', $title);
    }

    /**
     * Store a newly created movie in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'seo_title' => 'required',
            'synopsis' => 'required',
        ]);

        // Create new movie
        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->seo_title = $request->input('seo_title');
        $movie->synopsis = $request->input('synopsis');
        $movie->save();

        return redirect('/movies')->with('success');
    }

    /**
     * Display the specified movie.
     *
     * @param  string  $seo_title
     * @return Response
     */
    public function show($seo_title)
    {
        $data = array(
            'title' => 'This is a movie',
            'movie' => Movie::where('seo_title', $seo_title),
        );
        return view('movies.show')->with($data);
    }

    /*
    
    API Responses

     */
    
    /**
     * Return a listing of the movies.
     *
     * @return json Response
     */
    public function returnAll()
    {
        return Movie::all();
    }

    /**
     * Return the specified movie.
     *
     * @param  int  $movie
     * @return json Response
     */
    
    public function returnOne(Movie $movie)
    {
        return $movie;
    }
    /**
     * Store a newly created movie in storage.
     *
     * @param  obj  $request
     * @return json Response
     */
    public function storeViaApi(Request $request)
    {
        // Validate the postedd data.
        $this->validate($request, [
            'title' => 'required',
            'seo_title' => 'required|unique:movies',
            'synopsis' => 'required',
        ]);

        // Validation passed, now sanitize the data.
        $filters = [
            'title' => 'trim|escape|capitalize',
            'seo_title' => 'trim|escape|lowercase',
            'certification' => 'trim|escape|uppercase',
            'synopsis' => 'strip_tags',
        ];        
        $data = \Sanitizer::make($request->all(), $filters)->sanitize();

        $movie = Movie::create($data);

        return response()->json($movie, 201);
    }

    /**
     * Update the specified movie in storage.
     *
     * @param  obj  $request
     * @param  int  $movie
     * @return Response
     */
    public function updateViaApi(Request $request, Movie $movie)
    {
        $movie->update($request->all());

        return response()->json($movie, 200);
    }

    /**
     * Remove the specified movie from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteViaApi(Movie $movie)
    {
        $movie->delete();

        return response()->json(null, 204);
    }
}

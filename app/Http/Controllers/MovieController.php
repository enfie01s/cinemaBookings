<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = array(
            'title' => 'Movie list',
            'movies' => Movie::orderBy('created_at')->paginate(10),
        );
        return view('movies.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $title = "Create movie listing";
        return view('movies.create')->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'seo_title' => 'required',
        ]);

        // Create new movie
        $movie = new Movie;
        $movie->title = $request->input('title');
        $movie->seo_title = $request->input('seo_title');
        $movie->save();

        return redirect('/movies')->with('success');
    }

    /**
     * Display the specified resource.
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

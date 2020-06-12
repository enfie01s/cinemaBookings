@extends('layouts.app')

@section('content')
    <h1>Movie {{ $movie->first()->title }}</h1>
    <ul>
      <li>Certificate: {{ $movie->first()->certification }}</li>
      <li>Synopsis: {{ $movie->first()->synopsis }}</li>
    </ul>
@endsection

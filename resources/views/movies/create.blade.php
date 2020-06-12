@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    {!! Form::open(['action' => 'MovieController@store', 'method' => 'POST']) !!}
    <div class='form-group'>
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', [ 'class' => 'form-control', 'placeholder' => 'Title']) }}
    </div>
    <div class='form-group'>
        {{ Form::label('seo_title', 'SEO Title') }}
        {{ Form::text('seo_title', '', [ 'class' => 'form-control', 'placeholder' => 'SEO Title']) }}
    </div>
    <div class='form-group'>
        {{ Form::label('synopsis', 'Synopsis') }}
        {{ Form::textarea('synopsis', '', [ 'class' => 'form-control', 'placeholder' => 'Synopsis']) }}
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection

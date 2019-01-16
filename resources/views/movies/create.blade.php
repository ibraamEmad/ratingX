@extends('layouts.app')
@section('content')
{{-- @if (Gate::allows('systemAdmin', auth()->user())) --}}

    <h1>Add movie</h1>
    {!! Form::open(['action' => 'MovieController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      
    <div class="form-group">
        {{Form::label('name', 'Movie name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Movie name'])}}
    </div>
    <div class="form-group">
        {{Form::label('description', 'description')}}
        {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'description'])}}
    </div>
    <div class="form-group">
        {{Form::label('releaseDate', 'Release date')}}
        {{Form::text('releaseDate', '', ['class' => 'form-control', 'placeholder' => 'Release date'])}}
    </div>
    <div class="form-group">
        {{Form::label('genre', 'Genre')}}
        {{Form::text('genre', '', ['class' => 'form-control', 'placeholder' => 'Genre'])}}
    </div>
    
        {!! Form::file('image', array('class' => 'image')) !!}

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}

        {{-- @else
<h1>you are not a system admin</h1> --}}

{{-- @endif --}}

@endsection

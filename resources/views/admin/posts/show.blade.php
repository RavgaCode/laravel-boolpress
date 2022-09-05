@extends('layouts.dashboard')


@section('content')
    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>
    <div>Slug: {{$post->slug}}</div>
    <div>Creato il: {{$post->created_at}}</div>
    <div>Ultima modifica avvenuta il: {{$post->updated_at}}</div>
@endsection
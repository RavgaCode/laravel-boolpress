@extends('layouts.dashboard')


@section('content')
    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>
    <div>Slug: {{$post->slug}}</div>
    <div>Creato il: {{$post->created_at->format('d/m/Y')}}</div>
    <div>Ultima modifica avvenuta il: {{$post->updated_at->format('d/m/Y')}}</div>
    {{-- Inserisco il pulsante per modificare l'articolo --}}
    <div>
        <a href="{{route('admin.posts.edit', ['post'=>$post->id])}}" class="btn btn-primary">Modifica articolo</a>
    </div>
    {{-- Inserisco il pulsante per eliminare l'articolo--}}
    <div>
        <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('DELETE')

            <input type="submit" value="Cancella" onClick="return confirm('Sei sicuro di voler cancellare?');" class="btn btn-danger">
        </form>
    </div>

@endsection
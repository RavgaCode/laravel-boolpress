@extends('layouts.dashboard')


@section('content')

    <img src="{{ asset('/storage/'.$post->cover)}}" alt="" >
    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>
    <div>Slug: {{$post->slug}}</div>
    <div>Creato il: {{$post->created_at->format('d/m/Y')}}</div>
    {{-- If statement for created days ago message --}}
    @if($days_ago > 0)
        <div>Creato {{$days_ago}} giorn{{$days_ago > 1 ? 'i' : 'o'}} fa</div>   
    @else
        <div>Creato oggi</div>
    @endif
    <div>Ultima modifica avvenuta il: {{$post->updated_at->format('d/m/Y')}}</div>


    <div>Categoria: {{$post->category ? $post->category->name : 'Nessuna'}}</div>

    {{-- Inserisco la logica per le tags --}}
    <div>Tags: 
        @if($post->tags->isNotEmpty()) 
            @foreach ($post->tags as $tag)
                {{$tag->name}}{{!$loop->last ? ',' : ''}}
            @endforeach
        @else
            nessuno
        @endif
    
    </div>

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
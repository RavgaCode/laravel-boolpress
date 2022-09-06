@extends('layouts.dashboard')

@section('content')
    <h1>Modifica l'articolo</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Edit form --}}
<form action="{{route('admin.posts.update', ['post'=> $post->id])}}" method="post">
    @csrf
    {{-- Inserisco il metodo put, che deve essere messo a parte perchè i browser leggono solo get e post --}}
    @method('PUT')

    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Contenuto</label>
        <textarea class="form-control" id="content" name="content" rows="5">{{old('content', $post->content)}}</textarea>
    </div>

    <input type="submit" class="btn-primary" value="Salva modifiche">
</form>

@endsection
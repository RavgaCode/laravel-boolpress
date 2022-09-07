@extends('layouts.dashboard')

@section('content')
<h1>Crea un nuovo Post</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('admin.posts.store')}}" method="post">
    @csrf


    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
    </div>

    <div class="mb-3">
        <label for="category_id"></label>
        <select class="form-select" id="category_id" name="category_id">
            <option selected>Nessuna</option>

            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Contenuto</label>
        <textarea class="form-control" id="content" name="content" rows="5">{{old('content')}}</textarea>
    </div>

    <input type="submit" class="btn-primary" value="Salva post">
</form>
@endsection
@extends('layouts.dashboard')

@section('content')
<h1>Crea un nuovo Post</h1>

<form action="{{route('admin.posts.store')}}" method="post">
    @csrf


    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Contenuto</label>
        <textarea class="form-control" id="content" name="content" rows="5"></textarea>
    </div>

    <input type="submit" class="btn-primary" value="Salva post">
</form>
@endsection
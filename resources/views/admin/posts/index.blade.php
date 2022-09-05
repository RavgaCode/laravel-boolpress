@extends('layouts.dashboard')


@section('content')
<h1>Test index dei posts</h1>

<div class="row">
    @foreach($posts as $post)
    {{-- Single col template --}}
    <div class="col-3 my-3">
        <div class="card">
            {{-- <img src="..." class="card-img-top" alt="..."> --}}
            <div class="card-body">
              <h5 class="card-title">{{$post->title}}</h5>
              {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
            </div>
        </div>
    </div>
    {{-- End col template --}}
    @endforeach
</div>
    

@endsection

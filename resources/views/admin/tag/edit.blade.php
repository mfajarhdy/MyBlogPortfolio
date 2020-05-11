@extends('layout_admin.main')

@section('title','Halaman Edit Tags')

@section('title_page', 'Edit Tags')

@section('content')


    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <!-- validation gagal -->
        <div class="alert alert-danger" role="alert">
            {{ $error }} 
        </div>
        @endforeach
    @endif

    @if(Session::has('success_update'))
            <!-- validation berhasil -->
            <div class="alert alert-success" role="alert">
                {{ Session('success_update') }}
            </div>
    @endif


    <form action="{{ route('tag.update' , $tag->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="name"> Tags</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $tag->name }}">
        </div>

        <div class="form-group">
            <button class="btn btn-primary btn-block"> Update </button>
        </div>

    </form>

@endsection
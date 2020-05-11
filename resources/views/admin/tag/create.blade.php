@extends('layout_admin.main')

@section('title','Halaman Tambah Tags')

@section('title_page', 'Tambah Tags')

@section('content')

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{ $error }} 
    </div>
    @endforeach
@endif

@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session('success') }}
    </div>
@endif

<form action="{{ route('tag.store') }}" method="post">
@csrf
    <div class="form-group">
        <label for="name"> Tags</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block"> Simpan </button>
    </div>

</form>

@endsection
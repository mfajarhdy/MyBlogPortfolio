@extends('layout_admin.main')

@section('title','Halaman Tambah Post')

@section('title_page', 'Tambah Post')

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

<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group">
        <label for="judul"> Judul</label>
        <input type="text" class="form-control" id="judul" name="judul">
    </div>

    <div class="form-group">
        <label> Pilih Tags </label>
        <select class="form-control select2" multiple="" name="tags[]"> 
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag -> name}}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group">   
        <label for="category_id"> Kategori</label>
        <select name="category_id" id="category_id" class="form-control">
        <option value="" halder>Pilih Kategori</option>
        @foreach($category as $result)
            <option value="{{ $result->id }}"> {{ $result -> name }} </option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="content"> Konten</label>
        <textarea name="content" id="content" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="gambar"> Thumbnail </label><br>
        <input type="file" id="gambar" name="gambar" >
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block"> Simpan </button>
    </div>

</form>

@endsection
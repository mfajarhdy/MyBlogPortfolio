@extends('layout_admin.main')

@section('title','Halaman Edit Post')

@section('title_page', 'Edit Post')

@section('content')



<!-- VALIDASI -->
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



<!-- FORM EDIT -->
<form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
@csrf
@method('patch')
    <div class="form-group">
        <label for="judul"> Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ $post->judul }}">
    </div>

    <div class="form-group">
        <label> Pilih Tags </label>
        <select class="form-control select2" multiple="" name="tags[]"> 
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}"
            @foreach($post->tags as $value)
                @if($tag->id == $value->id)
                selected
                @endif
            @endforeach
            >{{ $tag -> name }} </option>
        @endforeach
        </select>
    </div>

    <div class="form-group">   
        <label for="category_id"> Kategori</label>
        <select name="category_id" id="category_id" class="form-control">
        <option value="" halder>Pilih Kategori</option>
        @foreach($category as $result)
            <option value="{{ $result->id }}"

            @if($post->category_id == $result->id)
            selected
            @endif
            
            > {{ $result -> name }} </option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="content"> Konten</label>
        <textarea name="content" id="content" class="form-control">{{ $post->content }} </textarea>
    </div>

    <div class="form-group">
        <label for="gambar"> Thumbnail </label><br>
        <input type="file" id="gambar" name="gambar" >
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block"> Ubah </button>
    </div>

</form>

@endsection
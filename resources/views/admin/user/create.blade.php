@extends('layout_admin.main')

@section('title','Halaman Tambah Users')

@section('title_page', 'Tambah Users')

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

<form action="{{ route('user.store') }}" method="post">
@csrf
    <div class="form-group">
        <label for="name"> Nama Users</label>
        <input type="text" class="form-control" id="name" name="name">
    </div>
    <div class="form-group">
        <label for="email"> Email</label>
        <input type="text" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
        <label for="tipe"> Tipe Users</label>
        <select name="tipe" class="form-control" id="tipe">
            <option value="" helder>Pilih Tipe Users</option>
            <option value="1">Administrator</option>
            <option value="0">Penulis</option>
        </select>
    </div>
    <div class="form-group">
        <label for="password"> Password</label>
        <input type="text" class="form-control" id="password" name="password">
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block"> Simpan </button>
    </div>

</form>

@endsection
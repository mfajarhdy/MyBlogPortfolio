@extends('layout_admin.main')

@section('title','Halaman Edit Users')

@section('title_page', 'Edit Users')

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

<form action="{{ route('user.update', $user->id) }}" method="post">
@csrf
@method('put')
    <div class="form-group">
        <label for="name"> Nama Users</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
    </div>
    <div class="form-group">
        <label for="email"> Email</label>
        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
    </div>
    <div class="form-group">
        <label for="tipe"> Tipe Users</label>
        <select name="tipe" class="form-control" id="tipe">
            <option value="" holder>Pilih Tipe Users</option>
            <option value="1" holder 
            @if($user->tipe == 1)
            selected
            @endif
            >Administrator</option>
            <option value="0" holder
            @if($user->tipe == 0)
            selected
            @endif>Penulis</option>
        </select>
    </div>
    <div class="form-group">
        <label for="password"> Password</label>
        <input type="text" class="form-control" id="password" name="password">
    </div>

    <div class="form-group">
        <button class="btn btn-primary btn-block"> Ubah </button>
    </div>

</form>

@endsection
@extends('layout_admin.main')

@section('title','Halaman Kategori')
@section('title_page', 'Kategori')

@section('content')

    @if(Session::has('success'))
            <!-- validation berhasil -->
            <div class="alert alert-success" role="alert">
                {{ Session('success') }}
            </div>
    @endif

    <a href="{{ route('category.create') }}" class="btn btn-info btn-sm ">Tambah Katgeori</a>
    <br><br>

        <table class="table table-striped table-hover table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($category as $result)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $result -> name}}</td>
                    <td>
                        <a href="{{ route('category.edit',  $result->id ) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('category.destroy', $result->id ) }}" class="d-inline" method="post">
                            @csrf  
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    </td>
                </tr>
    @endforeach
            </tbody>
        </table>
    {{ $category-> links() }}
@endsection
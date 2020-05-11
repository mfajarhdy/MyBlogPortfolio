@extends('layout_admin.main')

@section('title','Halaman User')
@section('title_page', 'Users')

@section('content')

    @if(Session::has('success'))
            <!-- validation berhasil -->
            <div class="alert alert-success" role="alert">
                {{ Session('success') }}
            </div>
    @endif

    <a href="{{ route('user.create') }}" class="btn btn-info btn-sm ">Tambah User</a>
    <br><br>

        <table class="table table-striped table-hover table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Users</th>
                    <th>Email</th>
                    <th>Tipe</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($user as $result)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $result -> name}}</td>
                    <td>{{ $result -> email}}</td>
                    <td>
                        @if($result->tipe)
                            <span class="badge badge-info">Administrator</span>
                            @else
                            <span class="badge badge-warning">Penulis</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user.edit',  $result->id ) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('user.destroy', $result->id ) }}" class="d-inline" method="post">
                            @csrf  
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    </td>
                </tr>
    @endforeach
            </tbody>
        </table>
    {{ $user-> links() }}
@endsection
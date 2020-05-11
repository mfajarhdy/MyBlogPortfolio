@extends('layout_admin.main')

@section('title','Halaman Post')
@section('title_page', 'Post')

@section('content')

    @if(Session::has('success'))
            <!-- validation berhasil -->
            <div class="alert alert-success" role="alert">
                {{ Session('success') }}
            </div>
    @endif

    <a href="{{ route('post.create') }}" class="btn btn-info btn-sm ">Tambah Post</a>
    <br><br>

        <table class="table table-striped table-hover table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Post</th>
                    <th>Kategori</th>
                    <th>Konten</th>
                    <th>Daftar Tags</th>
                    <th>Creator</th>
                    <th>Thumbnail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($post as $result)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $result -> judul}}</td>
                    <td>{{ $result -> category -> name }}</td>
                    <td>{{ $result -> content}}</td>
                    <td>@foreach($result->tags as $tag)
                            <ul>
                                <h6><span class="badge badge-info">{{ $tag->name }} </span></h6>
                            </ul>
                        @endforeach
                    </td>
                    <td> {{ $result->users->name }} </td>
                    <td><img src="{{ url('public/uploads/post/'.$result->gambar) }}" class="img-fluid" style="width:100px;"></td>
                    <td>
                        <a href="{{ route('post.edit',  $result->id ) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('post.destroy', $result->id ) }}" class="d-inline" method="post">
                            @csrf  
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    </td>
                </tr>
    @endforeach
            </tbody>
        </table>
    {{ $post-> links() }}
@endsection
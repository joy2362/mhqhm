@extends('admin.layout.master')
@section('title')
    Admin
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 fw-bold">Admin
                @if(Auth::guard('admin')->user()->can('create admin'))
                    <a href="{{route('admin.admin.create')}}" class="float-end rounded btn btn-sm btn-success" >Add admin</a>
                @endif
            </h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-border text-center" id="data">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($admins as $row)
                                    <tr>
                                        <td> {{ $loop->index + 1 }}</td>
                                        <td><a href="{{$row->avatar}}"><img src="{{$row->avatar}}" alt="{{$row->name}}" width="100" height="70"></a> </td>
                                        <td> {{ $row->name }}</td>
                                        <td> {{ $row->email }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <span class="btn btn-success rounded btn-sm px-3 " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </span>
                                                <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <form method="post" action="{{ route('admin.admin.destroy', $row->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <span type="submit" id="destroy" class="m-2">Delete</span>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#data').DataTable({
                "order":false
            });
            $(document).on("click", "#destroy", function(e){
                e.preventDefault();
                var form = $(this).parents('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {form.submit();}
                });

            });

        });

    </script>
@endsection

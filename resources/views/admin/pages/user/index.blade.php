@extends('admin.layout.master')
@section('title')
    <title>User</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 fw-bold">User</h1>
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
                                    <th>email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $row)
                                    <tr>
                                        <td> {{ $loop->index + 1 }}</td>
                                        <td><a href="{{$row->avatar}}"><img src="{{$row->avatar}}" alt="{{$row->name}}" width="100" height="70"></a> </td>
                                        <td> {{ $row->name }}</td>
                                        <td> {{ $row->email }}</td>
                                        <td>
                                            <form method="post" action="{{ route('admin.user.destroy', $row->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="destroy" class="m-2 rounded btn btn-sm btn-danger">Delete</button>
                                            </form>
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

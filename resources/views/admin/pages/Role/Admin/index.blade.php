@extends('admin.layout.master')
@section('title')
    <title>Role</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Role
                @if(Auth::guard('admin')->user()->can('Create Role'))
                    <a href="{{route('admin.adminrole.create')}}" class="float-end rounded btn btn-sm btn-success" >Add Role</a>
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
                                    <th>Name</th>
                                    <th>User Group</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $row)
                                    <tr>
                                        <td> {{ $loop->index + 1 }}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{ucfirst($row->guard_name)}}</td>
                                        <td>
                                            <a class="m-2 edit_button rounded btn btn-sm btn-success" href="{{route('admin.adminrole.edit',$row->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
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
        $(document).ready(function() {
            $('#data').DataTable({
                "order": false
            });
        });
    </script>
@endsection

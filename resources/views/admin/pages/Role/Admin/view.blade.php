@extends('admin.layout.master')
@section('title')
    Admin Role
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">View Role
                @if(auth()->user()->can('index admin-role'))
                    <a href="{{route('admin.admin-role.index')}}" class="float-end rounded btn btn-sm btn-success">View Admin Role</a>
                @endif
            </h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="fw-bold ">Role Details</h3>
                        </div>
                        <div class="card-body">
                            <h4 class="m-2 ">{{$role->name}}</h4>
                            <p class="m-2 ">Permission</p>
                            <ul>
                                @foreach($role->permissions as $permission)
                                    <li class="fw-bold">
                                        {{ucfirst($permission->name)}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@section('script')
    <script>

    </script>
@endsection

@extends('admin.layout.master')
@section('title')
    <title>Edit Admin Role</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Edit Role
                @if(auth()->user()->can('View All Role'))
                    <a href="{{route('admin.adminrole.index')}}" class="float-end rounded btn btn-sm btn-success">View Admin Role</a>
                @endif
            </h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{route('admin.adminrole.update',$role->id)}}">
                                @csrf
                                @method('put')
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{$role->name}}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    @foreach($permissions as $row)
                                        <div class="col-md-6 col-lg-4 g-2">
                                            <div class="form-check form-check-inline form-switch">
                                                <input class="form-control form-control-lg form-check-input" type="checkbox" role="switch" @if( $role->permissions->contains($row->id) ) {{'checked'}}  @endif  id="permissions_{{$row->id}}" name="permissions[]" value="{{$row->id}}">
                                                <label class="fs-4 form-control-lg form-check-label" for="permissions_{{$row->id}}">{{$row->name}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Update</button>
                            </form>
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

@extends('admin.layout.master')
@section('title')
    <title>Module</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>Module</strong> </h1>

            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-xxl-5 ">
                    <div class="w-100">
                        <div class="row">
                            <form action="{{route('admin.module.store')}}" method="POST">
                                @csrf
                                <div class="card ">
                                    <div class="card-header text-center">
                                        <h1 class="card-title ">Add new module</h1>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter module name" value="{{old('name')}}">
                                            <ul class="text-danger d-none" id="errorList"></ul>
                                            <p class="text-danger d-none" id="errors"></p>
                                            <p class="text-success d-none" id="message"></p>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
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
@extends('admin.layout.master')
@section('title')
    <title>Module</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row d-flex justify-content-center">
                <div class="col-6  ">
                    <div class="w-100">
                        <div class="row">
                            <form action="{{route('admin.module.store')}}" method="POST" id="module">
                                @csrf
                                <div class="card ">
                                    <div class="card-header text-center">
                                        <h3>Add new module</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter module name" value="{{old('name')}}">
                                            <ul class="text-danger d-none" id="errorList"></ul>
                                            <p class="text-danger d-none" id="errors"></p>
                                            <p class="text-success d-none" id="message"></p>
                                        </div>
                                    </div>
                                    <div class="card-footer ">
                                        <div class="form-group float-end">
                                            <button type="submit" class="btn btn-success">Submit</button>
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
        //custom validation that check is name start with capital letter or not
        $.validator.addMethod("ucFirst", function(value, element) {
            return this.optional(element) || /^[A-Z][a-zA-Z0-9_-]{1,198}$/.test(value);
        }, "Name must be start with capital letter");


        $( "#module" ).validate({
            errorClass: "error text-danger fw-bold",
            rules: {
                name: {
                    required : true,
                    ucFirst : true
                }
            },
        });
    </script>
@endsection
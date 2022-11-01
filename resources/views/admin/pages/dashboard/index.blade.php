@extends('admin.layout.master')
@section('title') Dashboard @endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>Welcome to</strong> {{$setting->name}}</h1>

            <div class="row">
                <div class="col-xl-6 col-xxl-5 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <h1>Add your dashboard Content here</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
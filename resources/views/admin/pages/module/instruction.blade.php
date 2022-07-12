@extends('admin.layout.master')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3"><strong>Module</strong> Instruction</h1>
            <div class="row ">
                <div class="col-xl-6 col-xxl-5 ">
                    <div class="w-100">
                        <div class="row">
                            <div class="container mt-5 mb-5">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>{{ucfirst($name)}}</h4>
                                        <ul class="timeline">
                                            <li>
                                                <p class="text-primary fw-bold ">Route</p>
                                                <p> New Route Registered on <span class="text-success">routes/Backend.php</span> </p>
                                            </li>
                                            <li>
                                                <p class="text-primary fw-bold ">Controller</p>
                                                <p> New controller file added in <span class="text-success">app/http/controller/Backend/{{ucfirst($name)}}Controller.php</span></p>
                                                <p> Necessary code added for complete Crud operation.</p>
                                                <p> Controller File extends BaseController which have all functionality of controller and added functionality. <span class="text-danger">Don't change it.</span></p>
                                            </li>
                                            <li>
                                                <p class="text-primary fw-bold ">Model</p>
                                                <p>Model created with  <span class="text-success">mandatory </span> relationship.</p>
                                            </li>
                                            <li>
                                                <p class="text-primary fw-bold ">Migration</p>
                                                <p class="text-warning ">Use php Artisan migrate</p>
                                                <p>Migration created with  <span class="text-success fw-bold">mandatory </span> field and example title field change title and add necessary field.</p>
                                                <p class="text-danger fw-bold">Don't remove or modify  mandatory field </p>
                                            </li>
                                            <li >
                                                <p class="text-primary fw-bold ">View</p>
                                                <p> View file locate in  <span class="text-success fw-bold">resources/views/admin/pages/{{ucfirst($name)}}/index.blade.php </span> </p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
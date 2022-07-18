@extends('admin.layout.master')
@section('title')
    <title>Menu</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Activity Log</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-border text-center" id="data">
                                <thead>
                                <tr>
                                    <th>Subject type</th>
                                    <th>Subject id</th>
                                    <th>Description</th>
                                    <th>causer Type</th>
                                    <th>causer id</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $row)
                                    <tr>
                                        <td> {{$row->subject_type}}</td>
                                        <td> {{$row->subject_id}}</td>
                                        <td> {{$row->description}}</td>
                                        <td> {{$row->causer_type}}</td>
                                        <td> {{$row->causer_id}}</td>
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
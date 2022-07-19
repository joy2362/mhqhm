@extends('admin.layout.master')
@section('title')
    <title>Recycle Bin</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            @foreach($modules as $row)
            <h1 class="h3 fw-bold">{{$row->name}}</h1>

            <div class="row mb-5">
                <div class="col-12">
                    <table class="table table-border text-center" id="" >
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Delete By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($dates as $key => $data)
                                @if($key == $row->name)
                                @foreach($data as $value)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->deletedBy->name}}</td>
                                    <td>
                                        <a class="m-2 edit_button rounded btn btn-sm btn-success" href="{{route('admin.recycle.recover',[ 'model' =>$row->name , 'id' => $value->id ])}}" id="delete"><i class="fa-solid fa-trash-arrow-up"></i></a>
                                        <a class="m-2 rounded btn btn-sm btn-danger" href="{{route('admin.recycle.delete',[ 'model' =>$row->name , 'id' => $value->id ])}}"  id="delete"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.table').DataTable({
                "order":false
            });
        });
    </script>
@endsection

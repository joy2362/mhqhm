@extends('admin.layout.master')
@section('title')
    <title>Menu</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Menu</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-border text-center" id="data">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Icon</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($menus as $row)
                                        <tr>
                                            <td> {{ $loop->index + 1 }}</td>
                                            <td><a href="{{route($row->route)}}" class="fw-bold ">{{$row->title}}</a></td>
                                            <td><i class=" {{ $row->icon }}" style="font-size: 20px"></i>  </td>
                                            <td>
                                                <button class="m-2 edit_button rounded btn btn-sm btn-success" value="{{$row->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
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
        <!-- Modal for update  -->
        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit_Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_Label">Edit Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="editForm">
                        <div class="modal-body">
                            <ul class="alert alert-danger d-none" id="errorList"></ul>
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="title" >
                                <input type="hidden" id="edit_id" name="id" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="icon" class="form-label">Icon</label>
                                <input type="text" class="form-control" id="icon" name="icon" aria-describedby="iconHelp">
                                <small id="iconHelp" class="form-text text-danger">Only support Feather Icons. Available Feather icons list <a href="https://feathericons.com/" target="_blank">here</a></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end Modal for update  -->
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#data').DataTable({
                "order":false
            });

            $(document).on('click','.edit_button',function(e){
                e.preventDefault();
                let id = $(this).val();

                ajaxsetup();
                $.ajax({
                    type:'get',
                    url:`/admin/menu/${id}/edit`,
                    dataType:'json',
                    success: function(res){
                        if(res.status === 200){
                            $('#edit_id').val(res.data.id);
                            $('#name').val(res.data.title);
                            $('#icon').val(res.data.icon);
                            $('#edit').modal('show');
                        }
                    }
                })
            });
            $(document).on('submit','#editForm',function(e){
                e.preventDefault();
                let  id = $('#edit_id').val();
                let editFormData = new FormData($('#editForm')[0]);

                $.ajax({
                    type:'post',
                    enctype: 'multipart/form-data',
                    url:`/admin/menu/${id}/update`,
                    data: editFormData,
                    contentType:false,
                    processData:false,
                    success: function(res){
                        if(res.status === 400){
                            $('#errorList').html("");
                            $('#errorList').removeClass("d-none");
                            $.each(res.errors,function(key,err_value){
                                $('#errorList').append('<li>'+ err_value+'</li>');
                            });
                        }
                        else if(res.status === 200){

                            location.reload();

                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: res  .message,
                                showConfirmButton: false,
                                timer: 1500,
                                toast:true
                            });

                        }
                    }

                })
            });

            $( "#editForm" ).validate({
                rules: {
                    icon: {
                        required : true
                    },
                    title: {
                        required : true
                    }
                }
            });
        });

    </script>
@endsection

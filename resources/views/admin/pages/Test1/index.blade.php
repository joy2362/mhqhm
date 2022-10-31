<!-- @abdullah zahid joy-->
@extends('admin.layout.master')
@section('title')
    <title>Test1</title>
@endsection
@section('content')
<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 fw-bold">Test1
			<a href="#" class="float-end btn btn-sm btn-success rounded" data-bs-toggle="modal" data-bs-target="#add">Add New</a>
		</h1>

		<!-- Modal for add  -->
		<div class="modal fade" id="add" tabindex="-1" aria-labelledby="add_Label" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="add_Label">Add Test1</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" enctype="multipart/form-data" id="addForm">
						<div class="modal-body">
							<ul class="alert alert-danger d-none" id="save_errorList"></ul>
							<div class="form-group mb-3"> 
	<label for="name" class="form-label ">Name</label>
	<input type="text" class="form-control" id="name" name="name"  required>
</div>
<div class="form-group mb-3"> 
	<label for="logo" class="form-label ">Logo</label>
	<input type="file" class="form-control" id="logo" name="logo"  required accept="image/*">
</div>
<div class="form-group mb-3"> 
	<label for="description" class="form-label ">Description</label>
	<textarea class="form-control" id="description" name="description"  required></textarea>
</div>
<div class="form-group mb-3"> 
	<label>Res</label>
	<br>
	 <input class="form-check-input" type="radio" name="res" id="res_1" value="1">
	  <label class="form-check-label" for="res_1">1</label>
	 <input class="form-check-input" type="radio" name="res" id="res_2" value="2">
	  <label class="form-check-label" for="res_2">2</label>
</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- end Modal for add-->

		<!-- Modal for update  -->
		<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit_Label" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="edit_Label">Edit Test1</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" enctype="multipart/form-data" id="editForm">
						<div class="modal-body">
							<ul class="alert alert-danger d-none" id="edit_errorList"></ul>
							<input type="hidden" id="edit_id" name="id" >

							<div class="form-group mb-3 edit_name"> 
	<label for="edit_name" class="form-label ">Name</label>
	<input type="text" class="form-control" id="edit_name" name="name"  required>
</div>
<div class="form-group mb-3 edit_logo"> 
	<p  class="form-label">Current logo</p>
	<a href="#" class="edit_logo_link"><img src="#" width="100px" height="100px" alt="image" class="edit_logo_preview"></a>
	</div>
<div class="form-group mb-3">
	<label for="edit_logo" class="form-label ">Logo</label>
	<input type="file" class="form-control" id="edit_logo" name="logo"  required accept="image/*">
</div>
<div class="form-group mb-3 edit_description"> 
	<label for="edit_description" class="form-label ">Description</label>
	<textarea class="form-control" id="edit_description" name="description"  required></textarea>
</div>
<div class="form-group mb-3 edit_res"> 
	<label>Res</label>
	<br>
	 <input class="form-check-input" type="radio" name="res" id="edit_res_1" value="1">
	  <label class="form-check-label" for="edit_res_1">1</label>
	 <input class="form-check-input" type="radio" name="res" id="edit_res_2" value="2">
	  <label class="form-check-label" for="edit_res_2">2</label>
</div>


							<div class="form-group mb-3 edit_status">
                            								<label  >Status: </label>
                            								<br>
                            								<input class="form-check-input" type="radio" name="status" id="edit_status_active" value="active" >
                            								<label class="form-check-label" for="edit_status_active">
                            									Active
                            								</label>
                            								<input class="form-check-input" type="radio" name="status" id="edit_status_inactive" value="inactive">
                            								<label class="form-check-label" for="edit_status_inactive">
                            									Inactive
                            								</label>
                            							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--end Modal for update  -->

		<!-- data table -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
                        <table class="table table-border" id="data">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th> 
<th>Res</th> 

                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

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
	    //url for edit ,fetch ,delete
		const model = "/admin/test1";
		const textAreas = ["description","edit_description"];
		$(document).ready(function(){

		    for (let textArea of textAreas){
                $(`#${textArea}`).ckeditor();
            }
			fetch();

			//fetch data
			function fetch(){
				ajaxsetup();
				$('#data').DataTable({
					"order": [[ 0, "desc" ]],
					responsive: true,
					language: {
						searchPlaceholder: 'Search...',
						sSearch: '',
						lengthMenu: '_MENU_ items/page',
					},
					processing: true,
					serverSide:true,
					ajax:"{{route('admin.test1.index')}}",
					columns:[
						{data:"id",name:'#'},
						{data:'name',name:'Name'}, 
{data:'res',name:'Res'}, 

						{data:"actions",name:'Actions'},
					]
				});
			}
		});

		//create form handle
        $(document).on('submit','#addForm',function(e){
            e.preventDefault();
            let formData = new FormData($('#addForm')[0]);

            store_handler( "{{route('admin.test1.store')}}" ,formData );
        });

        //edit form handle
        $(document).on('submit','#editForm',function(e){
            e.preventDefault();
            let formData = new FormData($('#editForm')[0]);

            edit_form_handle(model, $('#edit_id').val(), formData);
        });

        //prepare edit form for specific recode
        $(document).on('click','.edit_button',function(e){
            e.preventDefault();
            edit_btn_handler(model,$(this).val()).then(function(res){
                if(res.status === 200){
                    $('#edit_id').val(res.data.id);
                    $('#edit_name').val(res.data.name);
$(".edit_logo_preview").attr("src",res.data.logo);
$(".edit_logo_link").attr("href",res.data.logo);
$('#edit_description').val(res.data.description);
$(`.edit_res > input[type="radio"]`).each((index , input) =>{
	 if(res.data.res === input.value){
	 input.checked= true;
	}
	 });
$('#edit_res').val(res.data.res);

                    $(`.edit_status > input[type="radio"]`).each((index , input) =>{
                        if(res.data.status === input.value){
                            input.checked= true;
                        }
                    });
                }
            });
        });

        //delete recode
        $(document).on('click','.delete_button', function(e){
            e.preventDefault();
            delete_handler(model,$(this).val());
        });

	</script>
@endsection
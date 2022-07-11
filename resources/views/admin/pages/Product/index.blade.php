<!-- @dev abdullah zahid -->
@extends('admin.layout.master')
@section('content')
<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Product
			<a href="#" class="float-end btn btn-sm btn-success rounded" data-bs-toggle="modal" data-bs-target="#add">Add New</a>
		</h1>

		<!-- Modal for add  -->
		<div class="modal fade" id="add" tabindex="-1" aria-labelledby="add_Label" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="add_Label">Add Product</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" enctype="multipart/form-data" id="addForm">
						<div class="modal-body">
							<ul class="alert alert-danger d-none" id="save_errorList"></ul>
							<div class="form-group mb-3">
								<label for="title" class="form-label">Title</label>
								<input type="text" class="form-control" id="title" name="title" required>
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
						<h5 class="modal-title" id="edit_Label">Edit Product</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" enctype="multipart/form-data" id="editForm">
						<div class="modal-body">
							<ul class="alert alert-danger d-none" id="edit_errorList"></ul>
							<div class="form-group mb-3">
								<label for="edit_title" class="form-label">Title</label>
								<input type="text" class="form-control" id="edit_title" name="title" required>
								<input type="hidden" id="edit_id" name="id" >
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
						<div class="table-responsive">
							<table class="table table-border" id="data">
								<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>

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
	</div>
</main>
@endsection
@section('script')
	<script>
		const model = "product";
		$(document).ready(function(){
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
					ajax:"{{route('admin.product.index')}}",
					columns:[
						{data:"id",name:'ID'},
						{data:"title",name:'Name'},
						{data:"actions",name:'Actions'},
					]
				});
			}
		});

		//create form handle
		$(document).on('submit','#addForm',function(e){
			e.preventDefault();
			let formData = new FormData($('#addForm')[0]);
			ajaxsetup();
			$.ajax({
				type:'post',
				enctype: 'multipart/form-data',
				  url:"{{route('admin.product.store')}}",
				data:formData,
				processData: false,
				contentType: false,
				success: function(response){
					if(response.status === 400){
						$('#save_errorList').html("");
						$('#save_errorList').removeClass("d-none");
						$.each(response.errors,function(key,err_value){
							$('#save_errorList').append('<li>'+ err_value+'</li>');
						});
					}
					else if(response.status === 200){
						$('#save_errorList').html("");
						$('#save_errorList').addClass("d-none");

						//clear form and hide modal
						$('#addForm').trigger("reset");
						$('#add').modal('hide');

						//call resource api for update data
						$('#data').DataTable().draw();
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: response.message,
							showConfirmButton: false,
							timer: 1500,
							toast:true
						});

					}
				}

			})
		});

		$(document).on('submit','#editForm',function(e){
			e.preventDefault();
			let  id = $('#edit_id').val();
			//console.log(id);
			let editFormData = new FormData($('#editForm')[0]);
			editFormData.append('_method', 'PUT');
			ajaxsetup();
			//console.log(editFormData);
			$.ajax({
				type:'post',
				enctype: 'multipart/form-data',
				url:"/product/"+id,
				data: editFormData,
				contentType:false,
				processData:false,
				success: function(response){
					if(response.status === 400){
						$('#edit_errorList').html("");
						$('#edit_errorList').removeClass("d-none");
						$.each(response.errors,function(key,err_value){
							$('#edit_errorList').append('<li>'+ err_value+'</li>');
						});
					}
					else if(response.status === 200){
						$('#edit_errorList').html("");
						$('#edit_errorList').addClass("d-none");
						$('#editForm').trigger("reset");
						$('#edit').modal('hide');
						$('#data').DataTable().draw();
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: response.message,
							showConfirmButton: false,
							timer: 1500,
							toast:true
						});

					}
				}

			})

		});

		$(document).on('click','.edit_button',function(e){
			e.preventDefault();
			let id = $(this).val();
			//console.log(id);
			$('#edit').modal('show');
			ajaxsetup();
			$.ajax({
				type:'get',
				url:"/product/"+id+"/edit",
				dataType:'json',
				success: function(response){
					if(response.status === 200){
						$('#edit_id').val(response.data.id);
						$('#edit_title').val(response.data.title);
					}
				}
			})
		});

		$(document).on('click','.delete_button',function(e){
			e.preventDefault();
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					let id = $(this).val();
					ajaxsetup();
					$.ajax({
						type:'DELETE',
						url:"/product/"+id,
						dataType:'json',
						success: function(response){
							if(response.status === 404){
								Swal.fire({
									position: 'top-end',
									icon: 'error',
									title: response.message,
									showConfirmButton: false,
									timer: 1500,
									toast:true
								});
							}
							else{
								$('#data').DataTable().draw();
								Swal.fire({
									position: 'top-end',
									icon: 'success',
									title: response.message,
									showConfirmButton: false,
									timer: 1500,
									toast:true
								})
							}
						}
					})
				}
			})
		});
	</script>
@endsection
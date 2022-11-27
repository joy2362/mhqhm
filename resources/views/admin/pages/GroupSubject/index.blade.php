<!-- @abdullah zahid joy-->
@extends('admin.layout.master')
@section('title')
    Group-Subject
@endsection
@section('content')
<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 fw-bold">Group-Subject
			<a href="#" class="float-end btn btn-sm btn-primary rounded" data-bs-toggle="modal" data-bs-target="#add"> <i class="fa-solid fa-plus"></i> </a>
		</h1>

		<!-- Modal for add  -->
		<div class="modal fade" id="add" tabindex="-1" aria-labelledby="add_Label" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="add_Label">Add Group-Subject</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" enctype="multipart/form-data" id="addForm">
						<div class="modal-body">
							<ul class="alert alert-danger d-none" id="save_errorList"></ul>
							<div class="form-group mb-3"> 
							<label for="group_id" class="form-label ">Group</label>
							<select class="form-select" id="group_id" name="group_id"  required>
							<option selected>Choose...</option>
								@foreach($relation['Group'] as $group)
									<option value="{{$group->id}}">{{$group->name}} / {{$group->bn_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group mb-3">
							<label for="subject_id" class="form-label ">Subject</label>
							<select class="form-select" id="subject_id" name="subject_id"  required>
							<option selected>Choose...</option>
								@foreach($relation['Subject'] as $subject)
									<option value="{{$subject->id}}">{{$subject->name}} / {{$subject->bn_name}}</option>
								@endforeach
							</select>
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
						<h5 class="modal-title" id="edit_Label">Edit Group-Subject</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" enctype="multipart/form-data" id="editForm">
						<div class="modal-body">
							<ul class="alert alert-danger d-none" id="edit_errorList"></ul>
							<input type="hidden" id="edit_id" name="id" >

							<div class="form-group mb-3 edit_group_id"> 
								<label for="edit_group_id" class="form-label ">Group</label>
								<select class="form-select" id="edit_group_id" name="group_id"  required>
								<option selected>Choose...</option>
									@foreach($relation['Group'] as $group)
										<option value="{{$group->id}}">{{$group->name}} / {{$group->bn_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group mb-3 edit_subject_id">
								<label for="edit_subject_id" class="form-label ">Subject</label>
								<select class="form-select" id="edit_subject_id" name="subject_id"  required>
								<option selected>Choose...</option>
									@foreach($relation['Subject'] as $subject)
										<option value="{{$subject->id}}">{{$subject->name}} / {{$subject->bn_name}}</option>
									@endforeach
								</select>
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
                                <th>Group</th>
								<th>Subject</th>
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
		const model = "/admin/groupSubject";
		const textAreas = [];
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
					ajax: model,
					columns:[
						{data:"id",name:'#'},
						{data:'group.name',name:'Group'},
						{data:'subject.name',name:'Subject'},

						{data:"actions",name:'Actions'},
					]
				});
			}
		});

		//create form handle
        $(document).on('submit','#addForm',function(e){
            e.preventDefault();
            let formData = new FormData($('#addForm')[0]);

            store_handler( "{{route('GroupSubject.store')}}" ,formData );
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
                    $('#edit_group_id').val(res.data.group_id);
					$('#edit_subject_id').val(res.data.subject_id);

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
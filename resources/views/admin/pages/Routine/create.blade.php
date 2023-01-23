@extends('admin.layout.master')
@section('title')
    Routine
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Routine
                @if(auth()->user()->can('index Routine'))
                    <a href="{{route('Routine.index')}}" class="float-end rounded btn btn-sm btn-success">Routine</a>
                @endif
            </h1>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data" action="{{route('Routine.store')}}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="academic_year" class="form-label ">Academic year</label>
                                    <select class="form-select" id="academic_year" name="academic_year"  required>
                                        <option selected>Choose...</option>
                                        @foreach($years as $year)
                                            <option value="{{$year}}">{{$year}} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <fieldset class="border border-secondary p-2 mt-2">
                                    <legend class="float-none w-auto p-2">Class Routine</legend>
                                    <div class="row sub" >
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label for="teacher_id" class="form-label ">Teacher</label>
                                                <select class="form-select" id="teacher_id" name="teacher_id" required>
                                                    <option selected>Choose...</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{$teacher->id}}">{{$teacher->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label for="group_id_1" class="form-label ">Group</label>
                                                <select class="form-select" id="group_id_1" name="group_id[]" required onchange="changeGroup(this , 1)">
                                                    <option selected>Choose...</option>
                                                    @foreach($groups as $group)
                                                        <option value="{{$group->id}}">{{$group->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <label for="group_id" class="form-label ">Subject</label>
                                                <select class="form-select" id="subject_id" name="subject_id" required>
                                                    <option selected>Choose...</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group mb-3">
                                                <label for="class_time_id" class="form-label ">Class Time</label>
                                                <select class="form-select" id="class_time_id" name="class_time_id" required>
                                                    <option selected>Choose...</option>
                                                    @foreach($times as $time)
                                                        <option value="{{$time->id}}">{{$time->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group mb-3">
                                                <label for="note_1" class="form-label ">Note</label>
                                                <input type="text" class="form-control mx-sm-3" id="note_1" name="note[]" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary g-2 mt-3 " id="add_sub"> <i class="align-middle" data-feather="plus"></i> </button>
                                    </div>

                                </fieldset>

                                <button type="submit" class="btn btn-primary float-end">Save</button>
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
        $(document).ready(function(){

        });
        function changeGroup(group,count){
            if(group.value !== 'Choose...'){
                ajaxsetup();
                $.ajax({
                    type:'get',
                    url:"/admin/district/fetch/"+id,
                    dataType:'json',
                    success: function(response){
                        if(response.status === 404){
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            )
                        }
                        else{
                            let district =  $('#district').empty();
                            $.each(response.district,function(key,val){
                                district.append('<option value ="'+val.id+'">'+val.name+'</option>');
                            });
                        }
                    }
                })
                console.log( group.value);
            }

        }
    </script>
@endsection

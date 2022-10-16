@extends('admin.layout.master')
@section('title')
    <title>Module</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row d-flex justify-content-center">
                <div class="col-12  ">
                    <div class="w-100">
                        <div class="row">
                            <form action="{{ route('admin.module.store') }}" method="POST" id="module">
                                @csrf
                                <div class="card ">
                                    <div class="card-header ">
                                        <h3>Add New Module</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="name">Module Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           placeholder="Enter module name" value="{{ old('name') }}">
                                                    <ul class="text-danger d-none" id="errorList"></ul>
                                                    <p class="text-danger d-none" id="errors"></p>
                                                    <p class="text-success d-none" id="message"></p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="radio" name="type" id="spa"
                                                           checked value="spa">
                                                    <label class="form-check-label" for="spa">SPA</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type" id="regular"
                                                           value="regular">
                                                    <label class="form-check-label" for="regular">Regular</label>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="mt-4">DB Design</h4>
                                        <div id="field" class="mt-3">
                                            <div id="field_1">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="row "  >
                                                            <div class="col-md-2 ">
                                                                <div class="form-inline">
                                                                    <div class="form-group ">
                                                                        <label for="field_name_1">Name</label>
                                                                        <input type="text" class="form-control "
                                                                               id="field_name_1" name="field[name][]" required>
                                                                        <ul class="text-danger d-none" id="errorList"></ul>
                                                                        <p class="text-danger d-none" id="errors"></p>
                                                                        <p class="text-success d-none" id="message"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="datatype_1">Data Type</label>
                                                                    <select class="form-control" id="datatype_1"
                                                                            name="field[type][]" required
                                                                            onchange="dataTypeSelect('1')">
                                                                        <option value="">.....</option>
                                                                        @foreach ($dataType as $type)
                                                                            <option value="{{ $type }}">{{ ucFirst($type) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="inputType_1">Input Type</label>
                                                                    <select class="form-control" id="inputType_1"
                                                                            name="field[inputType][]" required>
                                                                        <option value="">.....</option>
                                                                        @foreach ($inputType as $type)
                                                                            <option value="{{ $type }}">{{ ucFirst($type) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="nullable_1">Nullable</label>
                                                                    <select class="form-control" id="nullable_1" name="field[is_nullable][]">
                                                                        <option value="yes">Yes</option>
                                                                        <option value="no" selected>No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="unique_1">Unique</label>
                                                                    <select class="form-control" id="unique_1" name="field[is_unique][]">
                                                                        <option value="yes">Yes</option>
                                                                        <option value="no" selected>No</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2" >
                                                                <div class="form-inline">
                                                                    <div class="form-group ">
                                                                        <label for="default_1">Default Value</label>
                                                                        <input type="text" class="form-control "
                                                                               id="default_1" name="field[default][]" >
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-2 d-none" id="foreign_model_1">
                                                                <div class="form-group">
                                                                    <label for="foreign_1">Model</label>
                                                                    <select class="form-control" id="foreign_1"
                                                                            name="field[foreign][]" >
                                                                        <option value="">...select model...</option>
                                                                        @foreach ($availableModels as $row)
                                                                            <option value="{{ $row->name }}">
                                                                                {{ ucFirst($row->name) }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 d-none" id="precision_1">
                                                                <div class="form-inline">
                                                                    <div class="form-group ">
                                                                        <label for="field_precision_1">Precision</label>
                                                                        <input type="text" class="form-control "
                                                                               id="field_precision_1" name="field[precision][]"
                                                                        >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 d-none" id="char_1">
                                                                <div class="form-inline">
                                                                    <div class="form-group ">
                                                                        <label for="field_char_1">Char length</label>
                                                                        <input type="text" class="form-control "
                                                                               id="field_char_1" name="field[char][]" max="255">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 d-none" id="scale_1">
                                                                <div class="form-inline">
                                                                    <div class="form-group ">
                                                                        <label for="field_scale_1">Scale</label>
                                                                        <input type="text" class="form-control "
                                                                               id="field_scale_1" name="field[scale][]" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 d-none" id="enum1_1">
                                                                <div class="form-inline">
                                                                    <div class="form-group ">
                                                                        <label for="enum1_value_1">Enum Value 1</label>
                                                                        <input type="text" class="form-control "
                                                                               id="enum1_value_1" name="field[enum1][]" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 d-none" id="enum2_1">
                                                                <div class="form-inline">
                                                                    <div class="form-group ">
                                                                        <label for="enum2_value_1">Enum Value 2</label>
                                                                        <input type="text" class="form-control "
                                                                               id="enum2_value_1" name="field[enum2][]" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group my-auto">
                                                            <button type="button" class="btn btn-primary g-2 mt-3 " id="add_1" onclick="handle_add('1')">
                                                                <span >+</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
        let field_count = 2;
        let lastRemovedId = [];
        const field = $("#field");

        function dataTypeSelect(id) {
            const val = $(`#datatype_${id}`).val();
            if (val === 'enum') {
                if ($(`#enum1_${id}`).hasClass('d-none')) {
                    $(`#enum1_${id}`).removeClass('d-none');
                }
                if ($(`#enum2_${id}`).hasClass('d-none')) {
                    $(`#enum2_${id}`).removeClass('d-none');
                }
            } else if (val !== 'enum') {
                if (!$(`#enum1_${id}`).hasClass('d-none')) {
                    $(`#enum1_${id}`).addClass('d-none');
                }
                if (!$(`#enum2_${id}`).hasClass('d-none')) {
                    $(`#enum2_${id}`).addClass('d-none');
                }
            }
            if (val === 'bigInteger' || val === 'unsignedBigInteger' || val === 'unsignedInteger' || val ===
                'unsignedMediumInteger' || val ===
                'unsignedSmallInteger' || val === 'unsignedTinyInteger') {
                if ($(`#foreign_model_${id}`).hasClass('d-none')) {
                    $(`#foreign_model_${id}`).removeClass('d-none');
                }
            } else if (val !== "bigInteger" || val !== "unsignedBigInteger" || val !== "unsignedInteger" || val !==
                "unsignedMediumInteger" || val !==
                "unsignedSmallInteger" || val !== "unsignedTinyInteger") {
                if (!$(`#foreign_model_${id}`).hasClass('d-none')) {
                    $(`#foreign_model_${id}`).addClass('d-none');
                }
            }

            if (val === 'decimal' || val === 'double' || val === 'float' || val === "unsignedDecimal") {
                if ($(`#scale_${id}`).hasClass('d-none')) {
                    $(`#scale_${id}`).removeClass('d-none');
                }
                if ($(`#precision_${id}`).hasClass('d-none')) {
                    $(`#precision_${id}`).removeClass('d-none');
                }
            } else if (val != 'decimal' || val != 'double' || val != 'float' || val != 'unsignedDecimal') {
                if (!$(`#scale_${id}`).hasClass('d-none')) {
                    $(`#scale_${id}`).addClass('d-none');
                }
                if (!$(`#precision_${id}`).hasClass('d-none')) {
                    $(`#precision_${id}`).addClass('d-none');
                }
            }
            if (val === 'char') {
                if ($(`#char_${id}`).hasClass('d-none')) {
                    $(`#char_${id}`).removeClass('d-none');
                }

            } else if (val != 'char') {
                if (!$(`#char_${id}`).hasClass('d-none')) {
                    $(`#char_${id}`).addClass('d-none');
                }

            }
        }

        //custom validation that check is name start with capital letter or not
        $.validator.addMethod("ucFirst", function(value, element) {
            return this.optional(element) || /^[A-Z][a-zA-Z0-9_-]{1,198}$/.test(value);
        }, "Name must be start with capital letter");


        $("#module").validate({
            errorClass: "error text-danger fw-bold",
            rules: {
                name: {
                    required: true,
                    ucFirst: true
                }
            },
        });

        function findPreviousId(id){
            for(var i = id-1 ; i => 1 ;i--){
                var prevField = document.getElementById(`field_${ i }`);
                    if(  prevField ) {
                        return i;
                    }
            }
        }

        function findNextId(id){
            for(var i = id+1 ; i <= field_count ;i++){
                var nextField = document.getElementById(`field_${ i }`);
                if(  nextField ) {
                    console.log(i)
                    return i;
                }
            }
            return 0;
        }

        function handle_remove(id){
            if( !lastRemovedId.includes(id-1) ){
                var next =  findNextId(id);
                if(next === 0){
                    if ($(`#add_${id-1}`).hasClass('d-none')) {
                        $(`#add_${id-1}`).removeClass('d-none');
                    }
                }

            }else if( lastRemovedId.includes(id-1) ){
              var prevId =  findPreviousId(id);
                var next =  findNextId(id);
                if(next === 0){
                    if ($(`#add_${ prevId }`).hasClass('d-none')) {
                        $(`#add_${ prevId }`).removeClass('d-none');
                    }
                }
            }else{
                if ($(`#add_${id-1}`).hasClass('d-none')) {
                    $(`#add_${id-1}`).removeClass('d-none');
                }

            }
            document.getElementById(`field_${id}`).remove();
            lastRemovedId[lastRemovedId.length] = id;
        }

        function handle_add(id){
            if (!$(`#add_${id}`).hasClass('d-none')) {
                $(`#add_${id}`).addClass('d-none');
            }
            let formField = `<div id="field_${field_count}">
                  <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-inline">
                                    <div class="form-group ">
                                        <label for="field_name_${field_count}">Name</label>
                                        <input type="text" class="form-control"
                                               id="field_name_${field_count}" name="field[name][]" required>
                                        <ul class="text-danger d-none" id="errorList"></ul>
                                        <p class="text-danger d-none" id="errors"></p>
                                        <p class="text-success d-none" id="message"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="datatype_${field_count}">Data Type</label>
                                    <select class="form-control" id="datatype_${field_count}"
                                            name="field[type][]" required
                                            onchange="dataTypeSelect('${field_count}')">
                                        <option value="">.....</option>
                                        @foreach ($dataType as $type)
            <option value="{{ $type }}">{{ ucFirst($type) }}
            </option>
@endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
             <label for="inputType_${field_count}">Input Type</label>
                                     <select class="form-control" id="inputType_${field_count}"
                                             name="field[inputType][]" required>
                                         <option value="">.....</option>
                                        @foreach ($inputType as $type)
            <option value="{{ $type }}">{{ ucFirst($type) }}
            </option>
@endforeach
            </select>
       </div>
   </div>
   <div class="col-md-2">
       <div class="form-group">
            <label for="nullable_${field_count}">Nullable</label>
                                     <select class="form-control" id="nullable_${field_count}" name="field[is_nullable][]">
                                         <option value="yes">Yes</option>
                                         <option value="no" selected>No</option>
                                     </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                     <label for="unique_${field_count}">Unique</label>
                                     <select class="form-control" id="unique_${field_count}" name="field[is_unique][]">
                                         <option value="yes">Yes</option>
                                         <option value="no" selected>No</option>
                                     </select>
                                </div>
                            </div>
                            <div class="col-md-2" >
                                <div class="form-inline">
                                     <div class="form-group ">
                                         <label for="default_${field_count}">Default Value</label>
                                         <input type="text" class="form-control "
                                                id="default_${field_count}" name="field[default][]" >
                                     </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2 d-none" id="foreign_model_${field_count}">
                                <div class="form-group">
                                     <label for="foreign_${field_count}">Model</label>
                                     <select class="form-control" id="foreign_${field_count}"
                                             name="field[foreign][]" >
                                         <option value="">...select model...</option>
                                    @foreach ($availableModels as $row)
            <option value="{{ $row->name }}">
                                          {{ ucFirst($row->name) }}
            </option>
@endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2 d-none" id="precision_${field_count}">
                                <div class="form-inline">
                                     <div class="form-group ">
                                         <label for="field_precision_${field_count}">Precision</label>
                                         <input type="text" class="form-control "
                                                id="field_precision_${field_count}" name="field[precision][]"
                                         >
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-2 d-none" id="char_${field_count}">
                                <div class="form-inline">
                                     <div class="form-group ">
                                         <label for="field_char_${field_count}">Char length</label>
                                         <input type="text" class="form-control "
                                                id="field_char_${field_count}" name="field[char][]" max="255">
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-2 d-none" id="scale_${field_count}">
                                <div class="form-inline">
                                     <div class="form-group ">
                                         <label for="field_scale_${field_count}">Scale</label>
                                         <input type="text" class="form-control "
                                                id="field_scale_${field_count}" name="field[scale][]" >
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-2 d-none" id="enum1_${field_count}">
                                <div class="form-inline">
                                     <div class="form-group ">
                                         <label for="enum1_value_${field_count}">Enum Value 1</label>
                                         <input type="text" class="form-control "
                                                id="enum1_value_${field_count}" name="field[enum1][]" >
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-2 d-none" id="enum2_${field_count}">
                                <div class="form-inline">
                                     <div class="form-group ">
                                         <label for="enum2_value_${field_count}">Enum Value 2</label>
                                         <input type="text" class="form-control "
                                                id="enum2_value_${field_count}" name="field[enum2][]" >
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group my-auto">
                            <button type="button" class="btn btn-primary g-2 mt-3 " id="add_${field_count}" onclick="handle_add(${field_count})">
                                +
                            </button>

                            <button type="button" class="btn btn-danger g-2 mt-3 " id="id="remove_${field_count}" onclick="handle_remove(${field_count})">
                                -
                            </button>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>`;
            field.append(formField);
            field_count++;
        }
    </script>
@endsection

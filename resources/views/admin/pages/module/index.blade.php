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
                                                    <label for="name">Name</label>
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
                                                                        <option value="">... select type ...</option>
                                                                        @foreach ($dataType as $type)
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
                                                            <button type="button" class="btn btn-primary g-2 mt-3 " id="add_field">
                                                                <i class="align-middle" data-feather="plus"></i> </button>
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
        const add_field = $("#add_field");
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

        function handle_remove(id){
            console.log(id);
            document.getElementById(`field_${id}`).remove()
        }


        add_field.on('click', function() {
 let formField = `<div id="field_${field_count}">
 <div class="row mt-3" >
            <div class="col-md-6 ">
                <div class="form-inline">
                     <div class="form-group ">
                        <label for="field_name_${field_count}">Name</label>
                        <input type="text" class="form-control "id="field_name_${field_count}" name="field[name][]" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="datatype_${field_count}">Data Type</label>
                    <select class="form-control" id="datatype_${field_count}" name="field[type][]" required onchange="dataTypeSelect('${field_count}')">
                         <option value="">...select type...</option>
                          @foreach ($dataType as $type)
                           <option value="{{ $type }}">{{ ucFirst($type) }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        <div class="col-md-6 d-none" id="foreign_model_${field_count}">
            <div class="form-group">
                <label for="foreign_${field_count}">Model</label>
                <select class="form-control" id="foreign_${field_count}" name="field[foreign][]" >
                    <option value="">...select model...</option>
                     @foreach ($availableModels as $row)
                        <option value="{{ $row->name }}">{{ ucFirst($row->name) }}</option>
                        @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6 d-none" id="precision_${field_count}">
            <div class="form-inline">
                <div class="form-group ">
                    <label for="field_precision_${field_count}">Precision</label>
                    <input type="text" class="form-control "
                        id="field_precision_${field_count}" name="field[precision][]"
                        >
                </div>
            </div>
        </div>
        <div class="col-md-6 d-none" id="char_${field_count}">
            <div class="form-inline">
                <div class="form-group ">
                    <label for="field_char_${field_count}">Char length</label>
                    <input type="text" class="form-control "
                        id="field_char_${field_count}" name="field[char][]" max="255">
                </div>
            </div>
        </div>
        <div class="col-md-6 d-none" id="scale_${field_count}">
            <div class="form-inline">
                <div class="form-group ">
                    <label for="field_scale_${field_count}">Scale</label>
                    <input type="text" class="form-control "
                        id="field_scale_${field_count}" name="field[scale][]" >
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 d-none" id="enum1_${field_count}">
            <div class="form-inline">
                <div class="form-group ">
                    <label for="enum1_value_1">Enum Value 1</label>
                    <input type="text" class="form-control "
                        id="enum1_value_${field_count}" name="field[enum1][]" >
                </div>
            </div>
        </div>
        <div class="col-md-6 d-none" id="enum2_${field_count}">
            <div class="form-inline">
                <div class="form-group ">
                    <label for="enum2_value_${field_count}">Enum Value 2</label>
                    <input type="text" class="form-control "
                        id="enum2_value_${field_count}" name="field[enum2][]" >
                </div>
            </div>
        </div>
        </div>
          <div class="row mt-2">
               <div class="col-md-4">
                    <div class="form-group">
                        <label for="nullable_${field_count}">Nullable</label>
                        <select class="form-control" id="nullable_${field_count}" name="field[is_nullable][]">
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="unique_${field_count}">Unique</label>
                        <select class="form-control" id="unique_${field_count}" name="field[is_unique][]">
                            <option value="yes">Yes</option>
                            <option value="no" selected>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" id="default_value_${field_count}">
                    <div class="form-inline">
                        <div class="form-group ">
                            <label for="default_${field_count}">Default Value</label>
                            <input type="text" class="form-control "
                                   id="default_${field_count}" name="field[default][]" >
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class=col-md-3>
                        <button type="button" class="btn text-danger remove fw-bold" id="remove_${field_count}" onclick="handle_remove(${field_count})"> x </button>
                    </div>
                </div>

            </div>
            <hr>
            </div>`;
            field.append(formField);
            field_count++;
        });
    </script>
@endsection

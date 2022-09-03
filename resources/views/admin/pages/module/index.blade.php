@extends('admin.layout.master')
@section('title')
    <title>Module</title>
@endsection
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row d-flex justify-content-center">
                <div class="col-6  ">
                    <div class="w-100">
                        <div class="row">
                            <form action="{{ route('admin.module.store') }}" method="POST" id="module">
                                @csrf
                                <div class="card ">
                                    <div class="card-header text-center">
                                        <h3>Add new module</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter module name" value="{{ old('name') }}">
                                            <ul class="text-danger d-none" id="errorList"></ul>
                                            <p class="text-danger d-none" id="errors"></p>
                                            <p class="text-success d-none" id="message"></p>
                                        </div>
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input" type="radio" name="type" id="spa"
                                                checked value="spa">
                                            <label class="form-check-label" for="spa">SPA</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="normal"
                                                value="normal">
                                            <label class="form-check-label" for="regular">Regular</label>
                                        </div>
                                        <fieldset class="border border-secondary p-2 mt-2">
                                            <legend class="float-none w-auto p-2">Field</legend>
                                            <div class="row ">
                                                <div class="col-md-6 ">
                                                    <div class="form-inline">
                                                        <div class="form-group ">
                                                            <label for="field_name_1">Name</label>
                                                            <input type="text" class="form-control " id="field_name_1"
                                                                name="field['name'][]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="datatype_1">Data Type</label>
                                                        <select class="form-control" id="datatype_1" name="field['type'][]"
                                                            required onchange="dataTypeSelect('1')">
                                                            <option>...select type...</option>
                                                            @foreach ($dataType as $type)
                                                                <option value="{{ $type }}">{{ ucFirst($type) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-none" id="foreign_model_1">
                                                    <div class="form-group">
                                                        <label for="foreign_1">Model</label>
                                                        <select class="form-control" id="foreign_1"
                                                            name="field['foreign'][]" required>
                                                            <option>...select model...</option>
                                                            @foreach ($availableModels as $row)
                                                                <option value="{{ $row->name }}">
                                                                    {{ ucFirst($row->name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-none" id="default_value_1">
                                                    <div class="form-inline">
                                                        <div class="form-group ">
                                                            <label for="field_name_1">Default Value</label>
                                                            <input type="text" class="form-control " id="default_value_1"
                                                                name="field['default'][]" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 d-none" id="precision_1">
                                                    <div class="form-inline">
                                                        <div class="form-group ">
                                                            <label for="field_precision_1">Precision</label>
                                                            <input type="text" class="form-control "
                                                                id="field_precision_1" name="field['precision'][]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-none" id="char_1">
                                                    <div class="form-inline">
                                                        <div class="form-group ">
                                                            <label for="field_char_1">Char length</label>
                                                            <input type="text" class="form-control " id="field_char_1"
                                                                name="field['char'][]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-none" id="scale_1">
                                                    <div class="form-inline">
                                                        <div class="form-group ">
                                                            <label for="field_scale_1">Scale</label>
                                                            <input type="text" class="form-control "
                                                                id="field_scale_1" name="field['scale'][]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 d-none" id="enum1_1">
                                                    <div class="form-inline">
                                                        <div class="form-group ">
                                                            <label for="enum1_value_1">Enum Value 1</label>
                                                            <input type="text" class="form-control "
                                                                id="enum1_value_1" name="field['enum1'][]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-none" id="enum2_1">
                                                    <div class="form-inline">
                                                        <div class="form-group ">
                                                            <label for="enum2_value_1">Enum Value 2</label>
                                                            <input type="text" class="form-control "
                                                                id="enum2_value_1" name="field['enum2'][]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="nullable_1"
                                                            name="field['is_nullable'][]" value="nullable">
                                                        <label class="form-check-label" for="nullable_1">Nullable</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input defaultField" type="checkbox"
                                                            id="default_1" name="field['have_defaule_value'][]"
                                                            value="default" onchange="showDefaultBox('1')">
                                                        <label class="form-check-label" for="default_1">Default</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="unique_1"
                                                            name="field['is_unique'][]" value="unique">
                                                        <label class="form-check-label" for="unique_1">Unique</label>
                                                    </div>
                                                </div>
                                            </div>


                                        </fieldset>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary g-2 mt-3 " id="add_sub">
                                                <i class="align-middle" data-feather="plus"></i> </button>
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
        function showDefaultBox(id) {
            const val = $(`#default_${id}:checked`).val();
            if (val === "default") {
                if ($(`#default_value_${id}`).hasClass('d-none')) {
                    $(`#default_value_${id}`).removeClass('d-none');
                }
            } else {
                if (!$(`#default_value_${id}`).hasClass('d-none')) {
                    $(`#default_value_${id}`).addClass('d-none');
                }
            }
        }

        function dataTypeSelect(id) {
            const val = $(`#datatype_${id}`).val();
            if (val === 'enum') {
                if ($(`#enum1_${id}`).hasClass('d-none')) {
                    $(`#enum1_${id}`).removeClass('d-none');
                }
                if ($(`#enum2_${id}`).hasClass('d-none')) {
                    $(`#enum2_${id}`).removeClass('d-none');
                }
            } else if (val != 'enum') {
                if (!$(`#enum1_${id}`).hasClass('d-none')) {
                    $(`#enum1_${id}`).addClass('d-none');
                }
                if (!$(`#enum2_${id}`).hasClass('d-none')) {
                    $(`#enum2_${id}`).addClass('d-none');
                }
            }
            if (val === 'bigInteger' || val === 'unsignedBigInteger' || val === 'unsignedInteger' || val ===
                'unsignedMediumInteger' || val ===
                'unsignedSmallInteger' || val === 'unsignedSmallInteger') {
                if ($(`#foreign_model_${id}`).hasClass('d-none')) {
                    $(`#foreign_model_${id}`).removeClass('d-none');
                }
            } else if (val != "bigInteger" || val != "unsignedBigInteger" || val != "unsignedInteger" || val !=
                "unsignedMediumInteger" || val !=
                "unsignedSmallInteger" || val != "unsignedSmallInteger") {
                if (!$(`#foreign_model_${id}`).hasClass('d-none')) {
                    $(`#foreign_model_${id}`).addClass('d-none');
                }
            }

            if (val === 'decimal' || val === 'double' || val === 'float') {
                if ($(`#scale_${id}`).hasClass('d-none')) {
                    $(`#scale_${id}`).removeClass('d-none');
                }
                if ($(`#precision_${id}`).hasClass('d-none')) {
                    $(`#precision_${id}`).removeClass('d-none');
                }
            } else if (val != 'decimal' || val != 'double' || val != 'float') {
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
    </script>
@endsection

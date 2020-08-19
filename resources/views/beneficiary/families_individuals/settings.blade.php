@extends('layouts._layout')

@section('css')

@stop
@section('content')


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{Auth::user()->lang_id == 1 ? 'Beneficiary Custom Fields' : 'حقول إضافية للمستفيدين'}}
            </h4>
        </div>
        <div class="card-body">
            <hr>

            {!! Form::open(['route' => 'beneficiary.fam_indev.updateCustomFieldsSettings' ,'action'=>'post' ,'id'=>'formBeneficiaryUpdateSettings']) !!}

            <input type="hidden" name="custom_fields_count" id="custom_fields_count" value="{{$customFields->count()}}">

            <div id="custom-field-container">
                @foreach($customFields as $index=>$customField)
                    @php
                        $index = $index+1;
                    @endphp
                    <div class="row custom-field-row" id="custom-field-row-{{$index}}">
                        <input type="hidden" name="custom_field_name_{{$index}}" value="{{$customField->field_name}}">
                        <input type="hidden" name="custom_field_{{$index}}_options_count"
                               id="custom_field_{{$index}}_options_count"
                               value="{{$customField->customFieldOptions()->count()}}">
                        <div class="col-md-4">
                            <div class="row">
                                <label for="custom_field_label_na_{{$index}}"
                                       class="col-md-4 col-form-label">{{Auth::user()->lang_id == 1 ? 'Field Name "English"' : 'اسم الحقل "لغة رئيسية" '}}</label>
                                <div class=" col-md-8">
                                    <div class="form-group has-default bmd-form-group">
                                        <input type="text" class="form-control" name="custom_field_label_na_{{$index}}"
                                               id="custom_field_label_na_{{$index}}" alt=""
                                               value="{{$customField->field_label_name_na}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label for="custom_field_label_fo_{{$index}}"
                                       class="col-md-4 col-form-label">{{Auth::user()->lang_id == 1 ? 'Field Name "Arabic"' : 'اسم الحقل "لغة ثانوية" '}}</label>
                                <div class=" col-md-8">
                                    <div class="form-group has-default bmd-form-group">
                                        <input type="text" class="form-control" name="custom_field_label_fo_{{$index}}"
                                               id="custom_field_label_fo_{{$index}}"
                                               value="{{$customField->field_label_name_fo}}" alt="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label class="col-md-3 col-form-label"
                                       for="custom_field_type_{{$index}}">{{Auth::user()->lang_id == 1 ? 'Field Type' : 'نوع الحقل'}}</label>
                                <div class="col-md-9">
                                    <div class="form-group has-default bmd-form-group">
                                        <select class="form-control selectpicker custom-field-type"
                                                data-style="btn btn-link" id="custom_field_type_{{$index}}"
                                                name="custom_field_type_{{$index}}" data-cfield-id="{{$index}}">
                                            <option style="height: 37px;" value=""></option>
                                            @foreach($customFieldTypes as $customFieldType)
                                                <option value="{{$customFieldType->id}}" {{$customFieldType->id == $customField->field_type ? 'selected' : ''}}>{{Auth::user()->lang_id == 1 ? $customFieldType->field_type_name_user_na : $customFieldType->field_type_name_user_fo}}</option>
                                                ;
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" name="remove-custom-field" id="remove-custom-field"
                                    data-field-id="{{$index}}" title="{{Auth::user()->lang_id == 1 ? 'Remove' : 'حذف'}}"
                                    class="btn btn-next btn-danger pull-right btn-sm remove-custom-field">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                    </div>
                    @if($customField->customFieldOptions()->count() > 0)
                        <div class="custom-field-{{$index}}-options-container"
                             id="custom-field-{{$index}}-options-container">
                            @foreach($customField->customFieldOptions as $i=>$customFieldOption)
                                @php
                                    $i++;
                                @endphp
                                <div class="row custom-field-{{$index}}-option-row"
                                     id="custom-field-{{$index}}-option-row-{{$i}}">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-default bmd-form-group">
                                                    <input type="text" value="{{$customFieldOption->option_name_na}}"
                                                           class="form-control"
                                                           name="custom_field_{{$index}}_option_label_na[]"
                                                           id="custom_field_{{$index}}_option_label_na_{{$i}}" alt=""
                                                           placeholder="{{Auth::user()->lang_id == 1 ? 'Option Name "EN"' : 'اسم الخيار "لغة رئيسية" '}}"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-default bmd-form-group">
                                                    <input type="text" value="{{$customFieldOption->option_name_fo}}"
                                                           class="form-control"
                                                           name="custom_field_{{$index}}_option_label_fo[]"
                                                           id="custom_field_{{$index}}_option_label_fo_{{$i}}" alt=""
                                                           placeholder="{{Auth::user()->lang_id == 1 ? 'Option Name "AR"' : 'اسم الخيار "لغة ثانوية"'}}"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group has-default bmd-form-group">
                                                    <input type="text" value="{{$customFieldOption->option_value}}"
                                                           class="form-control"
                                                           name="custom_field_{{$index}}_option_value[]"
                                                           id="custom_field_{{$index}}_option_value_{{$i}}" alt=""
                                                           placeholder="{{Auth::user()->lang_id == 1 ? 'Option Value' : 'قيمة الخيار'}}"
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" id="remove-custom-option-field" data-field-id="{{$index}}"
                                                data-field-option-id="{{$i}}" data-toggle="tooltip" data-placement="top"
                                                title="{{Auth::user()->lang_id == 1 ? 'Remove' : 'حذف'}}"
                                                class="btn btn-danger btn-sm btn-round btn-fab remove-custom-option-field">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row" id="custom-field-{{$index}}-option-btn-div">
                            <div class="col-md-2"></div>
                            <div class="col-md-3">
                                <button type="button" id="add-custom-field-option" data-field-id="{{$index}}"
                                        data-toggle="tooltip" data-placement="top"
                                        title="{{Auth::user()->lang_id == 1 ? 'Add Option' : 'إضافة خيار جديد'}}"
                                        class="btn btn-info btn-sm btn-round btn-fab">
                                    <i class="material-icons">add</i>
                                </button>
                            </div>
                        </div>
                        <hr id="hr-{{$index}}">
                    @endif
                @endforeach
            </div>
            <br>
            <div class="row" id="custom-field-btn-div">
                <div class="col-md-1">
                    <button type="button" id="add-custom-field" data-toggle="tooltip" data-placement="top"
                            title="{{Auth::user()->lang_id == 1 ? 'Add Custom Field' : 'إضافة حقل جديد'}}"
                            class="btn btn-next btn-primary pull-right btn-sm">
                        <i class="material-icons">add</i>
                    </button>
                </div>
            </div>
            <hr>
            <div class="col-md-12">

                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <a href="{{route('beneficiary.fam_indev.index')}}" class="btn btn-default btn-sm">
                            {{$labels['back'] ?? 'back'}}
                        </a>
                        <button type="submit" id="btn-save-ben-custom-fields"
                                class="btn btn-next btn-rose pull-right btn-sm">
                            <div class="loader pull-left" style="display: none;"></div>
                            {{$labels['save'] ?? 'save'}}
                        </button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>


@endsection
@section('script')
    <script>
        $(function () {

            var customFieldTypesOption = ''
            @foreach($customFieldTypes as $customFieldType)
                customFieldTypesOption += '<option value="{{$customFieldType->id}}">{{Auth::user()->lang_id == 1 ? $customFieldType->field_type_name_user_na : $customFieldType->field_type_name_user_fo}}</option>';
            @endforeach


            $('#add-custom-field').click(function () {

                var customFieldsCount = $('.custom-field-row').length;
                var customFieldID = customFieldsCount + 1;
                $('#custom_fields_count').val(customFieldID);

                $('#custom-field-container').append('<div class="row custom-field-row" id="custom-field-row-' + customFieldID + '">' +
                    '<input type="hidden" name="custom_field_name_' + customFieldID + '" value="beneficiary_custom_field_' + customFieldID + '">' +
                    '<input type="hidden" name="custom_field_' + customFieldID + '_options_count" id="custom_field_' + customFieldID + '_options_count" value="">' +
                    '                            <div class="col-md-4">' +
                    '                                <div class="row">' +
                    '                                    <label for="custom_field_label_na_' + customFieldID + '" class="col-md-4 col-form-label">{{Auth::user()->lang_id == 1 ? 'Field Name "English"' : 'اسم الحقل "لغة رئيسية" '}}</label>' +
                    '                                    <div class=" col-md-8">' +
                    '                                        <div class="form-group has-default bmd-form-group">' +
                    '                                            <input type="text" value="" class="form-control" name="custom_field_label_na_' + customFieldID + '" id="custom_field_label_na_' + customFieldID + '" alt="" required>' +
                    '                                        </div>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </div>' +
                    '<div class="col-md-4">' +
                    '                                <div class="row">' +
                    '                                    <label for="custom_field_label_fo_' + customFieldID + '" class="col-md-4 col-form-label">{{Auth::user()->lang_id == 1 ? 'Field Name "Arabic"' : 'اسم الحقل "لغة ثانوية" '}}</label>' +
                    '                                    <div class=" col-md-8">' +
                    '                                        <div class="form-group has-default bmd-form-group">' +
                    '                                            <input type="text" value="" class="form-control" name="custom_field_label_fo_' + customFieldID + '" id="custom_field_label_fo_' + customFieldID + '" alt="" required>' +
                    '                                        </div>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                            <div class="col-md-3">' +
                    '                                <div class="row">' +
                    '                                    <label class="col-md-3 col-form-label" for="custom_field_type_' + customFieldID + '">{{Auth::user()->lang_id == 1 ? 'Field Type' : 'نوع الحقل'}}</label>' +
                    '                                    <div class="col-md-9">' +
                    '                                        <div class="form-group has-default bmd-form-group">' +
                    '                                            <select class="form-control selectpicker custom-field-type" data-style="btn btn-link" id="custom_field_type_' + customFieldID + '" name="custom_field_type_' + customFieldID + '" data-cfield-id="' + customFieldID + '">' +
                    '                                                <option style="height: 37px;" value=""></option>' +
                    customFieldTypesOption +
                    '                                            </select>' +
                    '                                        </div>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                            <div class="col-md-1">' +
                    '                                <button type="button" name="remove-custom-field" id="remove-custom-field" data-field-id="' + customFieldID + '" title="{{Auth::user()->lang_id == 1 ? 'Remove' : 'حذف'}}" class="btn btn-next btn-danger pull-right btn-sm remove-custom-field">' +
                    '                                    <i class="material-icons">delete</i>' +
                    '                                </button>' +
                    '                            </div>' +
                    '                        </div>'
                );
                $('.selectpicker').selectpicker();
                $('[data-toggle="tooltip"]').tooltip();
            });


            $('#custom-field-container').on('click', '.remove-custom-field', function () {
                var customFieldID = $(this).data('field-id');
                $('#custom-field-row-' + customFieldID).remove();
                var customFieldsCount = $('.custom-field-row').length;
                $('#custom_fields_count').val(customFieldsCount);
                $('#custom-field-' + customFieldID + '-options-container').remove();
                $('#custom-field-' + customFieldID + '-option-btn-div').remove();
                $('#hr-' + customFieldID).remove();
                $('.custom-field-row').each(function (i, k, v) {
                    var i = i + 1;
                    $(this).attr('id', 'custom-field-row-' + i);
                    $(this).find('#remove-custom-field').attr('data-field-id', i);
                    $(this).find('input, select').each(function (index) {
                        var name = $(this).attr('name');
                        var id = $(this).attr('id');
                        if (name.indexOf('label_na') > 0) {
                            $(this).attr('name', 'custom_field_label_na_' + i);
                            $(this).attr('id', 'custom_field_label_na_' + i);
                        }
                        if (name.indexOf('label_fo') > 0) {
                            $(this).attr('name', 'custom_field_label_fo_' + i);
                            $(this).attr('id', 'custom_field_label_fo_' + i);
                        }
                        if (name.indexOf('type') > 0) {
                            $(this).attr('name', 'custom_field_type_' + i);
                            $(this).attr('id', 'custom_field_type_' + i);
                            $(this).attr('data-cfield-id', i);
                        }
                        if (name.indexOf('options_count') > 0) {
                            $(this).attr('name', 'custom_field_' + i + '_options_count');
                            $(this).attr('id', 'custom_field_' + i + '_options_count');
                        }
                        if (name.indexOf('field_name') > 0) {
                            $(this).attr('name', 'custom_field_name_' + i).val('beneficiary_custom_field_' + i);
                        }
                    });
                    if ($(this).next().attr('class') == 'custom-field-' + (i + 1) + '-options-container') {
                        $(this).next().attr('id', 'custom-field-' + i + '-options-container').attr('class', 'custom-field-' + i + '-options-container');
                        $(this).next().next().attr('id', 'custom-field-' + i + '-option-btn-div');
                        $(this).next().next().next().attr('id', 'hr-' + i + '');
                        $(this).next().find('.custom-field-' + (i + 1) + '-option-row').each(function (index) {
                            index++;
                            $(this).attr('id', 'custom-field-' + i + '-option-row-' + index);
                            $(this).find('button').attr('data-field-id', i);
                            $(this).find('input').each(function (indx) {
                                var name = $(this).attr('name');
                                var id = $(this).attr('id');
                                if (name.indexOf('label_na') > 0) {
                                    $(this).attr('name', 'custom_field_' + i + '_option_label_na[]');
                                    $(this).attr('id').replace((i + 1), i);
                                }
                                if (name.indexOf('label_fo') > 0) {
                                    $(this).attr('name', 'custom_field_' + i + '_option_label_fo[]');
                                }
                                if (name.indexOf('option_value') > 0) {
                                    $(this).attr('name', 'custom_field_' + i + '_option_value[]');
                                }
                            });
                        });
                    }
                });
            });


            $('body').on('change', '.custom-field-type', function () {
                var field_type = $(this).val();
                var field_id = $(this).data('cfield-id');
                var customFieldOptionsCount = $('.custom-field-' + field_id + '-option-row').length;
                var customFieldOptionID = customFieldOptionsCount < 1 ? 0 : customFieldOptionsCount + 1;
                $('#custom_field_' + field_id + '_options_count').val(customFieldOptionID);

                var addOptionsBtn = '<div class="row" id="custom-field-' + field_id + '-option-btn-div">' +
                    '                <div class="col-md-2"></div>' +
                    '                <div class="col-md-3">' +
                    '                    <button type="button" id="add-custom-field-option" data-field-id="' + field_id + '" data-toggle="tooltip" data-placement="top" title="{{Auth::user()->lang_id == 1 ? 'Add Option' : 'إضافة خيار جديد'}}" class="btn btn-info btn-sm btn-round btn-fab">' +
                    '                        <i class="material-icons">add</i>' +
                    '                    </button>' +
                    '                   </div>' +
                    '                </div>';

                var element = '<div class="custom-field-' + field_id + '-options-container" id="custom-field-' + field_id + '-options-container">' +
                    '                 <div class="row custom-field-' + field_id + '-option-row" id="custom-field-' + field_id + '-option-row-' + customFieldOptionID + '">' +
                    '                            <div class="col-md-2"></div>' +
                    '                            <div class="col-md-3">' +
                    '                                <div class="row">' +
                    '                                    <div class="col-md-12">' +
                    '                                        <div class="form-group has-default bmd-form-group">' +
                    '                                            <input type="text" value="" class="form-control" name="custom_field_' + field_id + '_option_label_na[]" id="custom_field_' + field_id + '_option_label_na_' + customFieldOptionID + '" alt="" placeholder="{{Auth::user()->lang_id == 1 ? 'Option Name "EN"' : 'اسم الخيار "لغة رئيسية" '}}" required>' +
                    '                                        </div>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                           <div class="col-md-3">' +
                    '                                <div class="row">' +
                    '                                    <div class="col-md-12">' +
                    '                                        <div class="form-group has-default bmd-form-group">' +
                    '                                            <input type="text" value="" class="form-control" name="custom_field_' + field_id + '_option_label_fo[]" id="custom_field_' + field_id + '_option_label_fo_' + customFieldOptionID + '" alt="" placeholder="{{Auth::user()->lang_id == 1 ? 'Option Name "AR"' : 'اسم الخيار "لغة ثانوية"'}}" required>' +
                    '                                        </div>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                            <div class="col-md-3">' +
                    '                                <div class="row">' +
                    '                                    <div class="col-md-12">' +
                    '                                        <div class="form-group has-default bmd-form-group">' +
                    '                                           <input type="text" value="" class="form-control" name="custom_field_' + field_id + '_option_value[]" id="custom_field_' + field_id + '_option_value_' + customFieldOptionID + '" alt="" placeholder="{{Auth::user()->lang_id == 1 ? 'Option Value' : 'قيمة الخيار'}}" required>' +
                    '                                        </div>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                            <div class="col-md-1">' +
                    '                                <button type="button" id="remove-custom-option-field" data-field-id="' + field_id + '" data-field-option-id="' + customFieldOptionID + '" data-toggle="tooltip" data-placement="top" title="{{Auth::user()->lang_id == 1 ? 'Remove' : 'حذف'}}" class="btn btn-danger btn-sm btn-round btn-fab remove-custom-option-field">' +
                    '                                    <i class="material-icons">delete</i>' +
                    '                                </button>' +
                    '                            </div>' +
                    '                        </div></div>' + addOptionsBtn + '<hr id="hr-' + field_id + '">';

                if (field_type == 1) {
                    $('#custom-field-' + field_id + '-options-container').remove();
                    $('#custom-field-' + field_id + '-option-btn-div').remove();
                    $('#hr-' + field_id).remove();
                } else if (field_type == 2) {
                    $('#custom-field-' + field_id + '-options-container').remove();
                    $('#custom-field-' + field_id + '-option-btn-div').remove();
                    $('#hr-' + field_id).remove();
                } else if (field_type == 3) {
                    $('#custom-field-' + field_id + '-options-container').remove();
                    $('#custom-field-' + field_id + '-option-btn-div').remove();
                    $('#hr-' + field_id).remove();
                } else if (field_type == 4) {
                    $('#custom-field-' + field_id + '-options-container').remove();
                    $('#custom-field-' + field_id + '-option-btn-div').remove();
                    $('#hr-' + field_id).remove();
                } else if (field_type == 5) {
                    $('#custom-field-' + field_id + '-options-container').remove();
                    $('#custom-field-' + field_id + '-option-btn-div').remove();
                    $('#hr-' + field_id).remove();
                    $(element).insertAfter('#custom-field-row-' + field_id);
                    $('.selectpicker').selectpicker();
                    //$('[data-toggle="tooltip"]').tooltip();
                } else if (field_type == 6) {
                    $('#custom-field-' + field_id + '-options-container').remove();
                    $('#custom-field-' + field_id + '-option-btn-div').remove();
                    $('#hr-' + field_id).remove();
                    $(element).insertAfter('#custom-field-row-' + field_id);
                    $('.selectpicker').selectpicker();
                } else if (field_type == 7) {
                    $('#custom-field-' + field_id + '-options-container').remove();
                    $('#custom-field-' + field_id + '-option-btn-div').remove();
                    $('#hr-' + field_id).remove();
                    $(element).insertAfter('#custom-field-row-' + field_id);
                    $('.selectpicker').selectpicker();
                } else if (field_type == 8) {
                    $('#custom-field-' + field_id + '-options-container').remove();
                    $('#custom-field-' + field_id + '-option-btn-div').remove();
                    $('#hr-' + field_id).remove();
                    $(element).insertAfter('#custom-field-row-' + field_id);
                    $('.selectpicker').selectpicker();
                } else if (field_type == 9) {
                    $('#custom-field-' + field_id + '-options-container').remove();
                    $('#custom-field-' + field_id + '-option-btn-div').remove();
                    $('#hr-' + field_id).remove();
                } else if (field_type == 10) {
                    $('#custom-field-' + field_id + '-options-container').remove();
                    $('#custom-field-' + field_id + '-option-btn-div').remove();
                    $('#hr-' + field_id).remove();
                }
            });


            $('body').on('click', '#add-custom-field-option', function () {
                var field_id = $(this).data('field-id');

                var customFieldOptionsCount = $('.custom-field-' + field_id + '-option-row').length;
                var customFieldOptionID = customFieldOptionsCount + 1;
                $('#custom_field_' + field_id + '_options_count').val(customFieldOptionID);

                $('body #custom-field-' + field_id + '-options-container').append('<div class="row custom-field-' + field_id + '-option-row" id="custom-field-' + field_id + '-option-row-' + customFieldOptionID + '">' +
                    '                            <div class="col-md-2"></div>' +
                    '                            <div class="col-md-3">' +
                    '                                <div class="row">' +
                    '                                    <div class="col-md-12">' +
                    '                                        <div class="form-group has-default bmd-form-group">' +
                    '                                            <input type="text" value="" class="form-control" name="custom_field_' + field_id + '_option_label_na[]" id="custom_field_' + field_id + '_option_label_na_' + customFieldOptionID + '" alt="" placeholder="{{Auth::user()->lang_id == 1 ? 'Option Name "EN"' : 'اسم الخيار "لغة رئيسية" '}}" required>' +
                    '                                        </div>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                           <div class="col-md-3">' +
                    '                                <div class="row">' +
                    '                                    <div class="col-md-12">' +
                    '                                        <div class="form-group has-default bmd-form-group">' +
                    '                                            <input type="text" value="" class="form-control" name="custom_field_' + field_id + '_option_label_fo[]" id="custom_field_' + field_id + '_option_label_fo_' + customFieldOptionID + '" alt="" placeholder="{{Auth::user()->lang_id == 1 ? 'Option Name "AR"' : 'اسم الخيار "لغة ثانوية"'}}" required>' +
                    '                                        </div>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                            <div class="col-md-3">' +
                    '                                <div class="row">' +
                    '                                    <div class="col-md-12">' +
                    '                                        <div class="form-group has-default bmd-form-group">' +
                    '                                           <input type="text" value="" class="form-control" name="custom_field_' + field_id + '_option_value[]" id="custom_field_' + field_id + '_option_value_' + customFieldOptionID + '" alt="" placeholder="{{Auth::user()->lang_id == 1 ? 'Option Value' : 'قيمة الخيار'}}" required>' +
                    '                                        </div>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                            <div class="col-md-1">' +
                    '                                <button type="button" id="remove-custom-option-field" data-field-id="' + field_id + '" data-field-option-id="' + customFieldOptionID + '" data-toggle="tooltip" data-placement="top" title="{{Auth::user()->lang_id == 1 ? 'Remove' : 'حذف'}}" class="btn btn-danger btn-sm btn-round btn-fab remove-custom-option-field">' +
                    '                                    <i class="material-icons">delete</i>' +
                    '                                </button>' +
                    '                            </div>' +
                    '                        </div>');
            });


            $('body').on('click', '.remove-custom-option-field', function () {
                var customFieldID = $(this).data('field-id');
                var customFieldOptionID = $(this).data('field-option-id');
                $('#custom-field-' + customFieldID + '-option-row-' + customFieldOptionID).remove();
                var customFieldOptionsCount = $('.custom-field-' + customFieldID + '-option-row').length;
                $('#custom-field-container #custom-field-row-' + customFieldID + ' #custom_field_' + customFieldID + '_options_count').val(customFieldOptionsCount);
                $('.custom-field-' + customFieldID + '-option-row').each(function (i, k, v) {
                    $(this).attr('id', 'custom-field-' + customFieldID + '-option-row-' + (i + 1));
                    $(this).find('button').attr('data-field-option-id', i + 1);
                });
            });


            $('body').on('submit', '#formBeneficiaryUpdateSettings', function (e) {
                e.preventDefault();
                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    data: form,
                    type: 'post',
                    beforeSend: function () {
                        // $('#btn-save-ben-custom-fields').attr("disabled", true);
                        $('.loader').show();
                    },
                    success: function (data) {
                        $('.loader').hide();
                        // $('#btn-save-ben-custom-fields').attr("disabled", false);
                        if (data.success == true) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        } else if (data.success == false) {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        }
                    },
                    error: function (data) {
                    }
                });
            });


        });

    </script>

@endsection


@section('js')
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>

@endsection

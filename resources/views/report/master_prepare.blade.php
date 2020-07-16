@extends('layouts._layout')
@section('content')


    <div class="col-md-12 col-12 mr-auto ml-auto">
        <div class="card card-wizard" data-color="rose" id="wizardReport">

            <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
            <div class="card-header text-center">
                <h3 class="card-title">
                    {{$labels['generate_repor']??'generate_repor'}}
                </h3>
                <h5 class="card-description">{{$repName}}</h5>
            </div>
            <div class="wizard-navigation">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#main_info" data-toggle="tab" role="tab">
                            {{$labels['main_info']??'main_info'}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#preparing" data-toggle="tab" role="tab">
                            {{$labels['columns']??'columns'}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#details" data-toggle="tab" role="tab">
                            {{$labels['details']??'details'}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#show_r" data-toggle="tab" role="tab">
                            {{$labels['show_report']??'show_report'}}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="main_info">
                        <h5 class="info-text">
                            {{$labels['report_text1']??'report_text1'}}
                        </h5>

                        {!! Form::open(['route' => 'reports.updateMaster' ,'action'=>'post' ,'id'=>'formReportPrepare']) !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {!! $html !!}

                        <button type="button" id="submit_formReportPrepare" style="display:none"></button>

                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane" id="preparing">

                        <div class="row">
                            <div id="columns_data" data-json="{{json_encode($reportDetail)}}"></div>
                            <div class="col-md-5">
                                <div class="card" style="min-height: 400px;">
                                    <div class="card-header card-header-text  btn-sm">
                                        <!--<div class="card-text">
                                            <h5 class="card-title">All Report Columns</h5>
                                        </div>-->
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th style="background-color:#ea2c6d;color:#fff">
                                                    {{$labels['report_text2']??'report_text2'}}

                                                    </th>
                                            </tr>
                                            </thead>
                                            <tbody id="all_columns">
                                            @foreach($reportDetail as $index => $reportDet)
                                                @if(!in_array($reportDet->rep_detail_id,$arr_du_ids))
                                                    <tr class="column_elm" style="cursor: pointer;"
                                                        data-id="{{$reportDet->rep_detail_id}}"
                                                        data-order="{{$reportDet->column_order}}"
                                                        data-label="{{$reportDet->column_label}}"
                                                        data-width="{{$reportDet->column_width}}"
                                                        data-aggregation="{{$reportDet->column_aggregation}}"
                                                        data-alignment="{{$reportDet->column_alignment}}">
                                                        <td><b>{{$reportDet->column_label}}</b></td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1" style="padding-top:160px">
                                <button type="button" id="btnMoveOneRight" class="btn btn-sm btn-rose "><i
                                            class="fa fa-angle-right"></i></button>
                                <button type="button" id="btnMoveAllRight" class="btn btn-sm btn-rose "
                                        style="width: 46px;"><i class="fa fa-angle-double-right"></i></button>
                                <button type="button" id="btnMoveAllLeft" class="btn btn-sm btn-rose "
                                        style="width: 46px;"><i class="fa fa-angle-double-left"></i></button>
                                <button type="button" id="btnMoveOneLeft" class="btn btn-sm btn-rose "><i
                                            class="fa fa-angle-left"></i></button>
                            </div>
                            <div class="col-md-6">
                                <div class="card" style="min-height: 400px;">
                                    <div class="card-header card-header-text ">
                                        <!--<div class="card-text">
                                            <h5 class="card-title">Columns will appear in the report</h5>
                                        </div>-->
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th style="background-color:#9c27b0;color:#fff">
                                                            {{$labels['report_text3']??'report_text3'}}

                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="columns_appear">
                                                    @if($reportDetailUser != null && count($arr_du_ids) > 0)
                                                        @foreach($reportDetailUser as $index => $reportDetailU)
                                                            <tr class="column_elm_" style="cursor: pointer;"
                                                                data-id="{{$reportDetailU->rep_detail_id}}"
                                                                data-order="{{$reportDetailU->column_order}}"
                                                                data-label="{{$reportDetailU->column_label}}"
                                                                data-width="{{$reportDetailU->column_width}}"
                                                                data-aggregation="{{$reportDetailU->column_aggregation}}"
                                                                data-alignment="{{$reportDetailU->column_alignment}}"
                                                                data-data_type="{{$reportDetailU->column_data_type}}">
                                                                <td><b>{{$reportDetailU->column_label}}</b></td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-3" style="padding-top:100px">

                                                <button type="button" id="moveOneUp" class="btn btn-sm btn-primary"><i
                                                            class="material-icons">keyboard_arrow_up</i></button>
                                                <button type="button" id="moveOneDown" class="btn btn-sm btn-primary"><i
                                                            class="material-icons">keyboard_arrow_down</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="details">
                        <h5 class="info-text">
                        </h5>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('reports.customize')}}" method="post" id="reportColumnsDetails">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="rep_master_id" value="{{$rep_master_id}}">
                                    <table class="table" id="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th width="30%">
                                                {{$labels['column_name']??'column_name'}}
                                            </th>
                                            <th width="13%">
                                                {{$labels['column_width']??'column_width'}}
                                            </th>
                                            <th>
                                                {{$labels['column_alignment']??'column_alignment'}}
                                            </th>
                                            <th>
                                                {{$labels['options']??'options'}}
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody id="columns_details_list">

                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="show_r">

                        <div align="center" id="loader-icon" class="col-md-12">
                            <div class="loader loader-div"></div>
                        </div>
                        <div id="report-data">

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="mr-auto">
                    <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous"
                           value=" {{$labels['previous']??'previous'}}">
                </div>
                <div class="ml-auto">
                    <input type="button" class="btn btn-next btn-fill btn-rose btn-wd" name="next" value="{{$labels['next']??'next'}}">
                    <input type="button" class="btn btn-finish btn-fill btn-rose btn-wd" name="finish" value="{{$labels['finish']??'finish'}}"
                           style="display: none;">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <style>
        .bg_c11 {
            background-color: #c1c1c1;
        }
    </style>


@endsection
@section('script')
    <script>

        $(function () {

            /*$('#table').DataTable({
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });*/

            $('[data-toggle="tooltip"]').tooltip();

            drawTableDetailFromC_();


            $('body').on('dblclick', '.column_elm', function () {
                var column_label = $(this).attr('data-label');
                var column_order = $(this).attr('data-order');
                var column_width = $(this).attr('data-width');
                var column_aggregation = $(this).attr('data-aggregation');
                var column_alignment = $(this).attr('data-alignment');
                var column_data_type = $(this).attr('data-data_type');
                var column_id = $(this).attr('data-id');

                $(this).remove();

                $('#columns_appear').append(' <tr class="column_elm_" style="cursor: pointer;" data-id="' + column_id + '" data-order="' + column_order + '" data-label="' + column_label + '" data-width="' + column_width + '" data-aggregation="' + column_aggregation + '" data-alignment="' + column_alignment + '" data-data_type="' + column_data_type + '">\n' +
                    '                                                        <td><b>' + column_label + '</b></td>\n' +
                    '                                                    </tr>');
                $('.column_elm_').each(function (index, item) {
                    $(this).attr('data-order', index + 1);
                });
                drawTableDetailFromC_();
            });


            $('body').on('dblclick', '.column_elm_', function () {
                var column_label = $(this).attr('data-label');
                var column_order = $(this).attr('data-order');
                var column_width = $(this).attr('data-width');
                var column_aggregation = $(this).attr('data-aggregation');
                var column_alignment = $(this).attr('data-alignment');
                var column_data_type = $(this).attr('data-data_type');
                var column_id = $(this).attr('data-id');

                $(this).remove();

                $('#all_columns').append(' <tr class="column_elm" style="cursor: pointer;" data-id="' + column_id + '" data-order="' + column_order + '" data-label="' + column_label + '" data-width="' + column_width + '" data-aggregation="' + column_aggregation + '" data-alignment="' + column_alignment + '" data-data_type="' + column_data_type + '">\n' +
                    '                                                        <td><b>' + column_label + '</b></td>\n' +
                    '                                                    </tr>');
                $('.column_elm_').each(function (index, item) {
                    $(this).attr('data-order', index + 1);
                });
                drawTableDetailFromC_();
            });


            $('#btnMoveAllRight').click(function () {
                var x = '';
                var columns_data = $('#columns_data').attr('data-json');
                var data = JSON.parse(columns_data);
                $.each(data, function (i, item) {
                    x += ' <tr class="column_elm_" style="cursor: pointer;" data-id="' + item.rep_detail_id + '" data-order="' + item.column_order + '" data-label="' + item.column_label + '" data-width="' + item.column_width + '" data-aggregation="' + item.column_aggregation + '" data-alignment="' + item.column_alignment + '" data-data_type="' + item.column_data_type + '">\n' +
                        '                                                        <td><b>' + item.column_label + '</b></td>\n' +
                        '                                                    </tr>';
                });

                $('#columns_appear').html(x);
                $('#all_columns').html('');
                x = '';
                $('.column_elm_').each(function (index, item) {
                    $(this).attr('data-order', index + 1);
                });
                drawTableDetailFromC_();
            });


            $('#btnMoveAllLeft').click(function () {
                var x = '';
                var columns_data = $('#columns_data').attr('data-json');
                var data = JSON.parse(columns_data);
                $.each(data, function (i, item) {
                    x += ' <tr class="column_elm" style="cursor: pointer;" data-id="' + item.rep_detail_id + '" data-order="' + item.column_order + '" data-label="' + item.column_label + '" data-width="' + item.column_width + '" data-aggregation="' + item.column_aggregation + '" data-alignment="' + item.column_alignment + '" data-data_type="' + item.column_data_type + '">\n' +
                        '                                                        <td><b>' + item.column_label + '</b></td>\n' +
                        '                                                    </tr>';
                });

                $('#all_columns').html(x);
                $('#columns_appear').html('');
                x = '';
                drawTableDetailFromC_();
            });


            $('body').on('click', '.column_elm_', function () {
                var $item = $(this);
                $item.toggleClass('bg_c11');
                if ($item.attr('data-selected')) {
                    $item.removeAttr('data-selected');
                } else {
                    $item.attr('data-selected', 'yes');
                }
                $("tr[data-selected]").each(function () {
                    var $item2 = $(this);
                    if ($item2.attr('data-id') != $item.attr('data-id')) {
                        $item2.removeAttr('data-selected');
                        $item2.toggleClass('bg_c11');
                    }
                });
                drawTableDetailFromC_();
            });


            $('body').on('click', '.column_elm', function () {
                var $item = $(this);
                $item.toggleClass('bg_c11');
                if ($item.attr('data-selected')) {
                    $item.removeAttr('data-selected');
                } else {
                    $item.attr('data-selected', 'yes');
                }
                $("tr[data-selected]").each(function () {
                    var $item2 = $(this);
                    if ($item2.attr('data-id') != $item.attr('data-id')) {
                        $item2.removeAttr('data-selected');
                        $item2.toggleClass('bg_c11');
                    }
                });
                drawTableDetailFromC_();
            });


            $('#btnMoveOneLeft').click(function () {
                var x = '';
                $("tr[data-selected]").each(function () {
                    var column_label = $(this).attr('data-label');
                    var column_order = $(this).attr('data-order');
                    var column_width = $(this).attr('data-width');
                    var column_aggregation = $(this).attr('data-aggregation');
                    var column_alignment = $(this).attr('data-alignment');
                    var column_data_type = $(this).attr('data-data_type');
                    var column_id = $(this).attr('data-id');
                    $('#all_columns').append('<tr class="column_elm" style="cursor: pointer;" data-id="' + column_id + '" data-order="' + column_order + '" data-label="' + column_label + '" data-width="' + column_width + '" data-aggregation="' + column_aggregation + '" data-alignment="' + column_alignment + '" data-data_type="' + column_data_type + '">\n' +
                        '<td><b>' + column_label + '</b></td>\n' +
                        '</tr>');
                    $(this).remove();
                    $(this).removeAttr('data-selected');
                });
                $('.column_elm_').each(function (index, item) {
                    $(this).attr('data-order', index + 1);
                });
                drawTableDetailFromC_();
            });


            $('#btnMoveOneRight').click(function () {
                var x = '';

                $("tr[data-selected]").each(function () {
                    var column_label = $(this).attr('data-label');
                    var column_order = $(this).attr('data-order');
                    var column_width = $(this).attr('data-width');
                    var column_aggregation = $(this).attr('data-aggregation');
                    var column_alignment = $(this).attr('data-alignment');
                    var column_data_type = $(this).attr('data-data_type');
                    var column_id = $(this).attr('data-id');
                    $('#columns_appear').append('<tr class="column_elm_" style="cursor: pointer;" data-id="' + column_id + '" data-order="' + column_order + '" data-label="' + column_label + '" data-width="' + column_width + '" data-aggregation="' + column_aggregation + '" data-alignment="' + column_alignment + '" data-data_type="' + column_data_type + '">' +
                        '<td><b>' + column_label + '</b></td>' +
                        '</tr>');
                    $(this).remove();
                    $(this).removeAttr('data-selected');

                });
                $('.column_elm_').each(function (index, item) {
                    $(this).attr('data-order', index + 1);
                });
                drawTableDetailFromC_();
            });


            $('#moveOneUp').click(function () {
                var row = $("tr[data-selected]");
                row.insertBefore(row.prev());
                $('.column_elm_').each(function (index, item) {
                    $(this).attr('data-order', index + 1);
                });
                drawTableDetailFromC_();
            });


            $('#moveOneDown').click(function () {
                var row = $("tr[data-selected]");
                row.insertAfter(row.next());
                $('.column_elm_').each(function (index, item) {
                    $(this).attr('data-order', index + 1);
                });
                drawTableDetailFromC_();
            });


            function drawTableDetailFromC_() {
                var arr = [];
                var str = '';
                var option = '';
                $('.column_elm_').each(function () {
                    var column_label = $(this).attr('data-label');
                    var column_order = $(this).attr('data-order');
                    var column_width = $(this).attr('data-width');
                    var column_aggregation = $(this).attr('data-aggregation');
                    var column_alignment = $(this).attr('data-alignment');
                    //
                    // if ($(this).attr('data-alignment') == 0) {
                    //     var column_alignment  = 2;
                    // }else{
                    //     var column_alignment = $(this).attr('data-alignment');
                    // }

                    var column_data_type = $(this).attr('data-data_type');
                    var column_id = $(this).attr('data-id');
                    if (column_data_type == 1 || column_data_type == 2) {
                        if (!column_aggregation || column_aggregation == null) {
                            column_aggregation = 'null';
                        }
                        option = '<select class="form-control selectpicker options_select" data-aggregation="' + column_aggregation + '" name="options_' + column_id + '">' +
                            '<option value="null">Nothing</option>' +
                            '<option value="0">Sum</option>' +
                            '<option value="1">Count</option>' +
                            '</select>';
                    } else {
                        option = '';
                    }
                    str += '<tr>' +
                        '<td><input type="hidden" name="column_order_' + column_id + '" value="' + column_order + '">' + column_order + '</td>\n' +
                        '<td><input type="text" class="form-control" name="column_label_' + column_id + '" value="' + column_label + '"></td>' +
                        '<td><input type="number" min=0 class="form-control" name="column_width_' + column_id + '" value="' + column_width + '"></td>' +
                        '<td>' +
                        '<select class="form-control selectpicker alignment_select" data-alignment="' + column_alignment + '" name="alignment_' + column_id + '">' +
                        '<option  value="1">Right</option>' +
                        '<option  value="2">Center</option>' +
                        '<option  value="3">Left</option>' +
                        '</select>' +
                        '</td>' +
                        '<td>' + option + '</td>' +
                        '</tr>';
                    option = '';
                });

                $('#columns_details_list').html(str);
                $('.selectpicker').selectpicker();
                $('.options_select').each(function () {
                    var value = $(this).attr('data-aggregation');
                    if (value != null) {
                        $(this).val(value).change();
                    }
                });
                $('.alignment_select').each(function () {
                    var value = $(this).attr('data-alignment');
                    if (value != 0) {
                        $(this).val(value).change();
                    } else {
                        $(this).val(2).change();
                    }
                });
                str = '';
            }


            $('#formReportPrepare').submit(function (e) {
                e.preventDefault();
                var action_url = $(this).attr('action');
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: action_url,
                    data: formData,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                    },
                    success: function (data) {
                    },
                    error: function (data) {
                    }
                });
            });


            $('#reportColumnsDetails').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                var action_url = $(this).attr('action');
                $.ajax({
                    url: action_url,
                    data: formData,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                    },
                    success: function (data) {
                    },
                    error: function (data) {
                    }
                });
            });

            $('body').on('click', '#btn-report-export-excel', function () {
                var action_url = $(this).attr('data-href');
                $.get(action_url, function () {

                });
            });

        });

    </script>
@endsection



@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <script src="{{asset('js/datatables/datatables.min.js')}}"></script>
    <script>

        reportWizard = {

            initMaterialWizard: function () {

                $('#wizardReport').bootstrapWizard({
                    'tabClass': 'nav nav-pills',
                    'nextSelector': '.btn-next',
                    'previousSelector': '.btn-previous',

                    onNext: function (tab, navigation, index) {
                        var $valid = $('#wizardReport form').valid();
                        if (!$valid) {
                            $validator.focusInvalid();
                            return false;
                        }
                        if (index == 1) {
                      //      $('#formReportPrepare').submit();
                        }
                        if (index == 2) {
                           // console.log(1);
                     //       $('#reportColumnsDetails').submit();
                        }
                        if (index == 3) {
                     //       $('#reportColumnsDetails').submit();
                     //       retriveReportData();
                        }
                    },

                    onInit: function (tab, navigation, index) {
                        //check number of tabs and fill the entire row
                        var $total = navigation.find('li').length;
                        var $wizard = navigation.closest('#wizardReport');

                        $first_li = navigation.find('li:first-child a').html();
                        $moving_div = $('<div class="moving-tab-project">' + $first_li + '</div>');
                        $('#wizardReport .wizard-navigation').append($moving_div);

                        refreshAnimationwizardReport($wizard, index);

                        $('.moving-tab-project').css('transition', 'transform 0s');
                    },

                    onTabClick: function (tab, navigation, index) {
                        var $valid = $('#wizardReport form').valid();

                        if (!$valid) {
                            return false;
                        } else {
                            return true;
                        }

                    },

                    onTabShow: function (tab, navigation, index) {
                        var $total = navigation.find('li').length;
                        var $current = index + 1;

                        var $wizard = navigation.closest('#wizardReport');

                        // If it's the last tab then hide the last button and show the finish instead
                        if ($current >= $total) {
                            $($wizard).find('.btn-next').hide();
                            $($wizard).find('.btn-finish').show();
                        } else {
                            $($wizard).find('.btn-next').show();
                            $($wizard).find('.btn-finish').hide();
                        }
                        if (index == 1) {
                            $('#formReportPrepare').submit();
                        }
                        if (index == 2) {
                            console.log(2);

                            $('#reportColumnsDetails').submit();
                        }
                        if (index == 3) {
                            $('#reportColumnsDetails').submit();
                            retriveReportData();
                        }
                        button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                        setTimeout(function () {
                            $('.moving-tab-project').text(button_text);
                        }, 150);

                        var checkbox = $('.footer-checkbox');

                        if (!index == 0) {
                            $(checkbox).css({
                                'opacity': '0',
                                'visibility': 'hidden',
                                'position': 'absolute'
                            });
                        } else {
                            $(checkbox).css({
                                'opacity': '1',
                                'visibility': 'visible'
                            });
                        }

                        refreshAnimationwizardReport($wizard, index);
                        // var container2 = document.querySelector('.main-panel');
                        // container2.scrollTop = 0;
                        $('.main-panel').scrollTop(0);
                    }
                });


                // Prepare the preview for profile picture
                $("#wizard-picture").change(function () {
                    readURL(this);
                });

                $('[data-toggle="wizard-radio"]').click(function () {
                    wizard = $(this).closest('#wizardReport');
                    wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
                    $(this).addClass('active');
                    $(wizard).find('[type="radio"]').removeAttr('checked');
                    $(this).find('[type="radio"]').attr('checked', 'true');
                });

                $('[data-toggle="wizard-checkbox"]').click(function () {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                        $(this).find('[type="checkbox"]').removeAttr('checked');
                    } else {
                        $(this).addClass('active');
                        $(this).find('[type="checkbox"]').attr('checked', 'true');
                    }
                });

                $('.set-full-height').css('height', 'auto');

                //Function to show image before upload

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $(window).resize(function () {
                    $('#wizardReport').each(function () {
                        $wizard = $(this);

                        index = $wizard.bootstrapWizard('currentIndex');
                        refreshAnimationwizardReport($wizard, index);

                        $('.moving-tab-project').css({
                            'transition': 'transform 0s'
                        });
                    });
                });

                function refreshAnimationwizardReport($wizard, index) {
                    //$total = $wizard.find('#wizardReport .nav li').length;
                    $total_wizardReport = $('#wizardReport').find(' .nav li').length;
                    // $total_wizardIndicators = $('#wizardIndicators').find(' .nav li').length;
                    //  $total = parseInt($total_wizardReport) - parseInt($total_wizardIndicators);
                    $li_width = 100 / $total_wizardReport;

                    $total_steps_wizardReport = $('#wizardReport').find('.nav li').length;
                    //   $total_wizardIndicators = $('#wizardIndicators').find('.nav li').length
                    //total_steps = parseInt($total_steps_wizardReport) - parseInt($total_wizardIndicators)
                    total_steps = $total_steps_wizardReport;
                    move_distance = $('#wizardReport').width() / total_steps;

                    index_temp = index;

                    vertical_level = 0;


                    mobile_device = $(document).width() < 600 && $total > 3;

                    if (mobile_device) {
                        move_distance = $('#wizardReport').width() / 2;
                        index_temp = index % 2;
                        $li_width = 50;
                    }

                    $('#wizardReport').find('.nav li').css('width', $li_width + '%');

                    step_width = move_distance;
                    move_distance = move_distance * index_temp;

                    $current = index + 1;

                    if ($current == 1 || (mobile_device == true && (index % 2 == 0))) {
                        move_distance -= 8;
                    } else if ($current == total_steps || (mobile_device == true && (index % 2 == 1))) {
                        move_distance += 8;
                    }

                    if (mobile_device) {
                        vertical_level = parseInt(index / 2);
                        vertical_level = vertical_level * 38;
                    }

                    $('#wizardReport').find('.moving-tab-project').css('width', step_width);
                    $('.moving-tab-project').css({
                        'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                        'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

                    });
                }
            },
        };

        wizard();

        function wizard() {
            reportWizard.initMaterialWizard();
            setTimeout(function () {
                $('#wizardReport').addClass('active');
            }, 100);
        }

        function retriveReportData() {
            var url = '{{route('reports.getData',$rep_master_id)}}';
            $.get(url,
                function (data) {
                    if (data.status != 'false') {
                        $('#loader-icon').hide();
                        $('#report-data').html(data);
                    }
                    else {
                        $('[href="#preparing"]').click();
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                });
        }

    </script>

@endsection



    $('[data-toggle="tooltip"]').tooltip();

    drawTableDetailFromC_();


    $(document).on('dblclick', '.column_elm', function () {
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


    $(document).on('dblclick', '.column_elm_', function () {
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


    $(document).on('click','#btnMoveAllRight',function (e) {
        e.preventDefault()
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


    $(document).on('click','#btnMoveAllLeft',function (e) {
        e.preventDefault();
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


    $(document).on('click', '.column_elm_', function () {
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


    $(document).on('click', '.column_elm', function () {
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


    $(document).on('click','#btnMoveOneLeft',function (e) {
        e.preventDefault();
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


    $(document).on('click','#btnMoveOneRight',function (e) {
        e.preventDefault();

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


    $(document).on('click','#moveOneUp',function (e) {
        e.preventDefault();
        var row = $("tr[data-selected]");
        row.insertBefore(row.prev());
        $('.column_elm_').each(function (index, item) {
            $(this).attr('data-order', index + 1);
        });
        drawTableDetailFromC_();
    });


    $(document).on('click','#moveOneDown',function (e) {
        e.preventDefault();
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


    $(document).on('submit','#formReportPrepare',function (e) {
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


    $(document).on('submit', '#reportColumnsDetails', function (e) {
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
                if (data.status == 'false') {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }  else if (data.status == 'true') {
                    $('#modalReport').modal('hide');
                }
            },
            error: function (data) {
            }
        });
        return false;
    });

    $(document).on('click', '#btn-report-export-excel', function () {
        var action_url = $(this).attr('data-href');
        $.get(action_url, function () {

        });
    });

    $(document).on('click', '[name="finish"]', function (e) {
        $('#reportColumnsDetails').submit();
    });


    function retriveReportData() {
        var url = reports_getData;
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

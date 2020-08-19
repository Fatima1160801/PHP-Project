@extends('layouts._layout')
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
            <h4 class="card-title">

                {{$labels['add_achievement_type' ]??'add_achievement_type'}}
            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            {!! Form::open(['route' => 'settings.achievement.type.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formCreate']) !!}
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


            <div class="col-md-12">
                <a class="btn btn-primary btn-sm" href="#" id="AddRowMetric">
                    <i class="fa fa-plus"></i>
                </a>

                <table class="table table-hover table-bordered" id="achievementTypeMetric">
                    <thead>
                    <tr>
                        <th>{{$labels['metric_no' ]??'metric_no'}} </th>
                        <th>{{$labels['metric_fo' ]??'metric_fo'}} </th>
                        <th>{{$labels['unit' ]??'unit'}} </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="padding: 1px"><input required style="width: 100%;" class="form-control " type="text"
                                                        name="metric_no[0]"></td>
                        <td style="padding: 1px"><input required style="width: 100%;" class="form-control " type="text"
                                                        name="metric_fo[0]"></td>
                        <td style="padding: 1px">

                            <select class='form-control  selectpicker  ' name='unit[0]' required  data-style='btn btn-link'>
                                @if(sizeof($measureUnit))
                                    <option style='height: 37px;' value></option>
                                    @foreach($measureUnit as $index=>$unit)
                                        <option style='height: 37px;' value="{{$index}}">{{$unit }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <a class="btn btn-danger btn-sm" href="#" id="deleteRow"><i class="fa fa-remove"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">

                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <a href="{{route('settings.achievement.type')}}" class="btn btn-sm btn-default">
                            {{$labels['back'] ?? 'back'}}
                        </a>
                        <button type="submit" id="btnAdd" class="btn btn-next btn-sm  btn-rose pull-right">
                            <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
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
        $(document).ready(function () {
            active_nev_link('achievementtypeSettings');
            funValidateForm();
            $('.selectpicker').selectpicker();
        });

        // $('#formCreate').submit(function (e) {
        //     if (!is_valid_form($(this))) {
        //         return false;
        //     }
        //
        //     e.preventDefault();
        //
        //     var form = $(this).serialize();
        //     var url = $(this).attr('action');
        //     $.ajax({
        //         url: url,
        //         data: form,
        //         type: 'post',
        //         beforeSend: function () {
        //             $('#btnAdd').attr("disabled", true);
        //             $('.loader').show();
        //         },
        //         success: function (data) {
        //             $('#btnAdd').attr("disabled", false);
        //             $('.loader').hide();
        //             if (data.status == 'true') {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //                 clearForm('#formCreate');
        //                 $('.loader').hide();
        //             } else if (data.status == 'false') {
        //                 myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
        //             }
        //             //$('#addBenf').prop("disabled", false);
        //
        //         },
        //         error: function (data) {
        //
        //         }
        //     });
        //
        // });
        var row_id = $('#achievementTypeMetric >tbody >tr').length;
        var measureUnit = @json($measureUnit);

        function addRow() {
            row_id += 1;
            var html = ' <tr>';
            html += '<td style="padding: 1px"> <input required style="width: 100%;" class="form-control " type="text" name="metric_no[' + row_id + ']"></td>';
            html += '<td style="padding: 1px"><input required style="width: 100%;" class="form-control " type="text" name="metric_fo[' + row_id + ']"></td>';
            html += '<td style="padding: 1px"><select required class="form-control  selectpicker "  name="unit[' + row_id + ']"  data-style="btn btn-link" >';
            html += '<option style="height: 37px;" value=""></option>';
            $.each(measureUnit, function (index, value) {
                html += '<option style="height: 37px;" value="' + index + '">' + value + '</option>';
            });
            html += '</select></td>';
            html += ' <td style="padding: 1px" >';
            html += '    <a class="btn btn-danger btn-sm" href="#" id="deleteRow"><i class="fa fa-remove"></i></a>';
            html += ' </td> </tr>';
            $('#achievementTypeMetric tbody').append(html);
            $('.selectpicker').selectpicker('refresh');
        }

        $(document).on('click', '#AddRowMetric', function (e) {
            e.preventDefault();
            addRow();
        })
        $(document).on('click', '#deleteRow', function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        })
    </script>
@endsection



@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>


@endsection


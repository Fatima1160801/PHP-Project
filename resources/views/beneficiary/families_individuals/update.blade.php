@extends('layouts._layout')
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['edit_beneficiary'] ?? 'edit_beneficiary'}}
/
                <a style="color: #d81b60;" href="{{route('beneficiary.fam_indev.getedit',$beneficiary->id)}}">{{Auth::user()->lang_id == 1 ? $beneficiary->ben_name_na : $beneficiary->ben_name_fo}}</a></h4>
        </div>
        @include('beneficiary.families_individuals.update_render')
        <div class="card-body">

{{--            <div id="result-msg"></div>--}}
{{--            <ul id="taps_" class="nav nav-pills nav-pills-warning" role="tablist">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active" data-toggle="tab" href="#benInfo" role="tablist">--}}
{{--                        {{$labels['beneficiary_info'] ?? 'beneficiary_info'}}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @if($beneficiary->ben_type_id == 2)--}}
{{--                <li id="ben_fam_tap" class="nav-item">--}}
{{--                    <a class="nav-link" data-toggle="tab" href="#benFam" role="tablist">--}}
{{--                        {{$labels['family_individuals'] ?? 'family_individuals'}}--}}


{{--                    </a>--}}
{{--                </li>--}}
{{--                @endif--}}
{{--            </ul>--}}
{{--            <div class="tab-content tab-space">--}}
{{--                <div class="tab-pane active" id="benInfo">--}}
{{--                    {!! Form::open(['route' => 'beneficiary.fam_indev.update' ,'action'=>'post' ,'id'=>'formBeneficiaryUpdate']) !!}--}}
{{--                    @if ($errors->any())--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <ul>--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {!! $html !!}--}}

{{--                    <div class="row">--}}
{{--                        @if($customFields->count() > 0)--}}
{{--                            <input type="hidden" name="custom_fields_count" value="{{$customFields->count()}}">--}}
{{--                            @foreach($customFields as $customField)--}}
{{--                                {!! customField($customField,json_decode($beneficiary->custom_fields,true)) !!}--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <hr>--}}


{{--                    <div class="col-md-12">--}}
{{--                        <div class="card-footer ml-auto mr-auto">--}}
{{--                            <div class="ml-auto mr-auto">--}}
{{--                                <a href="{{route('beneficiary.fam_indev.index')}}" class="btn btn-default btn-sm">--}}
{{--                                    {{$labels['back'] ?? 'back'}}--}}
{{--                                </a>--}}
{{--                                <button type="submit" id="editBenf" class="btn btn-next btn-rose pull-right btn-sm">--}}
{{--                                    <div class="loader pull-left" style="display: none;"></div>--}}
{{--                                    {{$labels['save'] ?? 'save'}}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                    {!! Form::close() !!}--}}
{{--                </div>--}}
{{--                <div class="tab-pane" id="benFam">--}}
{{--                    <button type="button" id="btn-createfm-modal" href="{{route('beneficiary.fam_indev.createfm',$beneficiary->id)}}" class="btn btn-primary "--}}
{{--                            data-toggle="modal" data-target="#createfmModal"--}}
{{--                            title="  {{$labels['add_individual'] ?? 'add_individual'}}" >--}}
{{--                        <i class="material-icons">add</i>--}}
{{--                        {{$labels['add_individual'] ?? 'add_individual'}}--}}
{{--                    </button>--}}

{{--                    <table class="table" id="table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>#</th>--}}
{{--                            <th>--}}
{{--                                {{$labels['individual_name'] ?? 'individual_name'}}--}}
{{--                            </th>--}}
{{--                            <th>--}}
{{--                                {{$labels['identification_number'] ?? 'identification_number'}}--}}
{{--                            </th>--}}
{{--                            <th>--}}
{{--                                {{$labels['relation_type'] ?? 'relation_type'}}--}}
{{--                            </th>--}}
{{--                            <th>--}}
{{--                                {{$labels['added_at'] ?? 'added_at'}}--}}
{{--                            </th>--}}
{{--                            <th>--}}
{{--                                {{$labels['actions'] ?? 'actions'}}--}}
{{--                            </th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody id="enfamtable">--}}
{{--                        @foreach($ben_familiy_members  as $index=>$ben_familiy_member)--}}

{{--                            <tr>--}}
{{--                                <td>{{$index+1}}</td>--}}
{{--                                <td>{{$ben_familiy_member->ind_name_na}}</td>--}}
{{--                                <td>{{$ben_familiy_member->ind_idno}}</td>--}}
{{--                                <td><?php $x = DB::table('c_relation_types')->where('id', $ben_familiy_member->relation_type)->first(); echo Auth::user()->lang_id == 1 ? $x->relation_name_na : $x->relation_name_fo; ?></td>--}}
{{--                                <td>{{$ben_familiy_member->created_at}}</td>--}}
{{--                                <td>--}}
{{--                                    <button href="{{route('beneficiary.fam_indev.geteditfm',$ben_familiy_member->id)}}"--}}
{{--                                       class="btn btn-sm btn-success btn-round btn-fab editBenFam"  data-toggle="tooltip" data-placement="top" title="--}}
{{--                                            {{$labels['edit'] ?? 'edit'}}">--}}
{{--                                        <i class="material-icons">edit</i>--}}
{{--                                    </button>--}}

{{--                                    <a href="{{ route('beneficiary.fam_indev.deletefm',$ben_familiy_member->id)}}"--}}
{{--                                       id="btnFamIndevDelete" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab"--}}
{{--                                       data-placement="top"  title="--}}
{{--                                    {{$labels['delete'] ?? 'delete'}}">--}}
{{--                                        <i class="material-icons">delete</i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}

{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--                <div class="modal fade" id="createfmModal" tabindex="-1" role="dialog">--}}
{{--                    <div class="modal-dialog modal-signup" role="document">--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="card card-signup card-plain">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <h5 class="modal-title card-title">--}}
{{--                                        {{$labels['add_individual'] ?? 'add_individual'}}--}}


{{--                                    </h5>--}}
{{--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                        <i class="material-icons">clear</i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="modal-body">--}}
{{--                                    <div class="row">--}}
{{--                                        {!! Form::open(['route' => 'beneficiary.fam_indev.storefm' ,'action'=>'post' ,'id'=>'formBeneficiaryFamCreate']) !!}--}}
{{--                                        @if ($errors->any())--}}
{{--                                            <div class="alert alert-danger">--}}
{{--                                                <ul>--}}
{{--                                                    @foreach ($errors->all() as $error)--}}
{{--                                                        <li>{{ $error }}</li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}

{{--                                        <div id="createfm-modal-form"></div>--}}


{{--                                        <div class="col-md-12">--}}

{{--                                            <div class="card-footer ml-auto mr-auto">--}}
{{--                                                <div class="ml-auto mr-auto">--}}
{{--                                                    <a id="modal-dismiss" href="#" class="btn btn-default btn-sm">--}}
{{--                                                        {{$labels['cancel'] ?? 'cancel'}}--}}

{{--                                                    </a>--}}
{{--                                                    <button type="submit" class="btn btn-next btn-rose pull-right btn-sm">--}}
{{--                                                        {{$labels['save'] ?? 'save'}}--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


{{--                                        {!! Form::close() !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="modal fade" id="editfmModal" tabindex="-1" role="dialog">--}}
{{--                    <div class="modal-dialog modal-signup" role="document">--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="card card-signup card-plain">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <h5 class="modal-title card-title">--}}
{{--                                        {{$labels['edit_individual'] ?? 'edit_individual'}}--}}

{{--                                    </h5>--}}
{{--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                        <i class="material-icons">clear</i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <div class="modal-body">--}}
{{--                                    <div class="row">--}}
{{--                                        {!! Form::open(['route' => 'beneficiary.fam_indev.updatefm' ,'action'=>'post' ,'id'=>'formBeneficiaryFamUpdate']) !!}--}}
{{--                                        @if ($errors->any())--}}
{{--                                            <div class="alert alert-danger">--}}
{{--                                                <ul>--}}
{{--                                                    @foreach ($errors->all() as $error)--}}
{{--                                                        <li>{{ $error }}</li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}

{{--                                        <div id="editfmModal-modal-form"></div>--}}


{{--                                        <div class="col-md-12">--}}

{{--                                            <div class="card-footer ml-auto mr-auto">--}}
{{--                                                <div class="ml-auto mr-auto">--}}
{{--                                                    <a id="modal-dismiss" href="#" class="btn btn-default btn-sm">--}}
{{--                                                        {{$labels['cancel'] ?? 'cancel'}}--}}

{{--                                                    </a>--}}
{{--                                                    <button type="submit" class="btn btn-next btn-rose pull-right btn-sm">--}}
{{--                                                        {{$labels['save'] ?? 'save'}}--}}

{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


{{--                                        {!! Form::close() !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--        </div>--}}
    </div>

@endsection
@section('script')
            @include('beneficiary.families_individuals.update_script')
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            active_nev_link('families_individuals')--}}
{{--            $('.selectpicker').selectpicker({--}}
{{--                @if(Auth::user()->lang_id == 2 )--}}
{{--                noneSelectedText: 'لم يتم تحديد شيء',--}}
{{--                @endif--}}
{{--            });--}}
{{--            funValidateForm();--}}
{{--            $('.datetimepicker').datetimepicker({--}}
{{--                icons: {--}}
{{--                    time: "fa fa-clock-o",--}}
{{--                    date: "fa fa-calendar",--}}
{{--                    up: "fa fa-chevron-up",--}}
{{--                    down: "fa fa-chevron-down",--}}
{{--                    previous: 'fa fa-chevron-left',--}}
{{--                    next: 'fa fa-chevron-right',--}}
{{--                    today: 'fa fa-screenshot',--}}
{{--                    clear: 'fa fa-trash',--}}
{{--                    close: 'fa fa-remove'--}}
{{--                },--}}
{{--                format: 'DD/MM/YYYY'--}}
{{--            });--}}
{{--        });--}}

{{--        $('#formBeneficiaryUpdate').submit(function(e){--}}

{{--            e.preventDefault();--}}

{{--            if(checkNumberIndividualFamily() == false){--}}
{{--                myNotify("warning","warning", "warning", '5000', 'The total "No. Males" and "No. Females" should equal the "Households Individuals Number"');--}}
{{--                return;--}}
{{--            }--}}

{{--            if (!is_valid_form($(this))) {--}}
{{--                return false;--}}
{{--            }--}}

{{--            var form = $(this).serialize();--}}
{{--            var url = $(this).attr('action');--}}
{{--            $.ajax({--}}
{{--                url: url,--}}
{{--                data: form,--}}
{{--                type: 'post',--}}
{{--                beforeSend: function () {--}}
{{--                    $('#editBenf').attr("disabled", true);--}}
{{--                    $('.loader').show();--}}
{{--                },--}}
{{--                success: function (data) {--}}
{{--                    $('#editBenf').attr("disabled", false);--}}
{{--                    $('.loader').hide();--}}
{{--                    if (data.success == true) {--}}
{{--                        $('body,html').animate({scrollTop:0},600);--}}
{{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                        if(data.ben_type_befor != data.ben_type_after && data.ben_type_after == 2) {--}}
{{--                            $('#taps_').append(' <li id="ben_fam_tap" class="nav-item">\n' +--}}
{{--                                '                    <a class="nav-link" data-toggle="tab" href="#benFam" role="tablist">\n' +--}}
{{--                                '                        Family Members\n' +--}}
{{--                                '                    </a>\n' +--}}
{{--                                '                </li>');--}}
{{--                        } else if(data.ben_type_after == 1) {--}}
{{--                            $('#ben_fam_tap').hide();--}}
{{--                        }--}}
{{--                        $('.loader').attr("disabled", 'false');--}}
{{--                    } else if (data.success == false) {--}}
{{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function (data) {--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}


{{--        $(function () {--}}



{{--            DataTableCall('#table',6);--}}

{{--            $('[data-toggle="tooltip"]').tooltip();--}}
{{--        })--}}


{{--        /*///////////*****delete staff****//////////*/--}}
{{--        $(document).on('click', '#btnFamIndevDelete', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            $this = $(this);--}}

{{--            swal({--}}
{{--                text: '{{$messageDeleteBeneficiaryFam['text']}}',--}}
{{--                confirmButtonClass: 'btn btn-success  btn-sm',--}}
{{--                cancelButtonClass: 'btn btn-danger  btn-sm',--}}
{{--                buttonsStyling: false,--}}
{{--                showCancelButton: true--}}
{{--            }).then(result => {--}}
{{--                if (result == true){--}}
{{--                    // var project_id = $('#formProjectMain #id').val();--}}
{{--                    url = $(this).attr('href');--}}
{{--                    $.ajax({--}}
{{--                        url: url,--}}
{{--                        type: 'delete',--}}
{{--                        beforeSend: function () {--}}

{{--                        },--}}
{{--                        success: function (data) {--}}
{{--                            if (data.status == 'true') {--}}
{{--                                $($this).closest('tr').css('background','red').delay(1000).hide(1000);--}}
{{--                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                                $('#contentModal .close').click();--}}
{{--                            }else {--}}
{{--                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function () {--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            })--}}
{{--        });--}}


{{--        $('#btn-createfm-modal').click(function(){--}}

{{--            var url = $(this).attr('href');--}}
{{--            $.get(url,function(response){--}}

{{--                $('#createfm-modal-form').html(response);--}}
{{--                $('.selectpicker').selectpicker({--}}
{{--                    @if(Auth::user()->lang_id == 2 )--}}
{{--                    noneSelectedText: 'لم يتم تحديد شيء',--}}
{{--                    @endif--}}
{{--                });--}}
{{--            });--}}


{{--        });--}}


{{--        $('#formBeneficiaryFamCreate').submit(function(e){--}}

{{--            e.preventDefault();--}}
{{--            if (!is_valid_form($(this))) {--}}
{{--                return false;--}}
{{--            }--}}

{{--            var form = $(this).serialize();--}}
{{--            var url = $(this).attr('action');--}}
{{--            $.ajax({--}}
{{--                url: url,--}}
{{--                data: form,--}}
{{--                type: 'post',--}}
{{--                beforeSend: function () {--}}
{{--                    //$('#saveProjectMain').prop("disabled", true);--}}
{{--                    $('.loader').css('display', 'block')--}}
{{--                },--}}
{{--                success: function (data) {--}}

{{--                    if (data.success == true) {--}}
{{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                        $('#createfmModal .close').click();--}}
{{--                        $('.loader').attr("disabled", 'false');--}}
{{--                        $('#enfamtable').append('<tr id="">'+--}}
{{--                        '<td></td>'+--}}
{{--                        '<td>'+data.beneficiaryFamily.ind_name_na+'</td>'+--}}
{{--                        '<td>'+data.beneficiaryFamily.ind_idno+'</td>'+--}}
{{--                        '<td>'+data.beneficiaryFamily.relation_type+'</td>' +--}}
{{--                        '<td>'+data.beneficiaryFamily.created_at+'</td>' +--}}
{{--                        '<td>' +--}}
{{--                        '<a href="" '+--}}
{{--                    'class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top" title="Edit">' +--}}
{{--                            '<i class="material-icons">edit</i>' +--}}
{{--                           ' </a>' +--}}


{{--                            '<a href="" ' +--}}
{{--                        'id="btnFamIndevDelete" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab" ' +--}}

{{--                        'data-placement="top"  title="Delete Individual">' +--}}
{{--                            '<i class="material-icons">delete</i>'+--}}
{{--                            '</a>'+--}}

{{--                            '</td>'+'</tr>'--}}
{{--                    );--}}

{{--                    } else if (data.success == false) {--}}
{{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                    }--}}
{{--                    $('.loader').css('display', 'none')--}}


{{--                },--}}
{{--                error: function (data) {--}}

{{--                }--}}
{{--            });--}}

{{--        });--}}



{{--        $('#formBeneficiaryFamUpdate').submit(function(e){--}}

{{--            e.preventDefault();--}}

{{--            var form = $(this).serialize();--}}
{{--            var url = $(this).attr('action');--}}
{{--            $.ajax({--}}
{{--                url: url,--}}
{{--                data: form,--}}
{{--                type: 'post',--}}
{{--                beforeSend: function () {--}}
{{--                    //$('#saveProjectMain').prop("disabled", true);--}}
{{--                    $('.loader').css('display', 'block')--}}
{{--                },--}}
{{--                success: function (data) {--}}

{{--                    if (data.success == true) {--}}
{{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                        $('#editfmModal .close').click();--}}
{{--                        $('.loader').attr("disabled", 'false');--}}
{{--                    } else if (data.success == false) {--}}
{{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                    }--}}
{{--                    $('.loader').css('display', 'none');--}}

{{--                },--}}
{{--                error: function (data) {--}}

{{--                }--}}
{{--            });--}}

{{--        });--}}

{{--        $('#modal-dismiss').click(function(){--}}
{{--            $('#createfmModal .close').click();--}}
{{--        });--}}

{{--        $('.editBenFam').click(function(){--}}

{{--            var url = $(this).attr('href');--}}

{{--            $.get(url,function(response){--}}
{{--                $('#editfmModal').modal('show');--}}
{{--                $('#editfmModal-modal-form').html(response);--}}
{{--                $('.selectpicker').selectpicker({--}}
{{--                    @if(Auth::user()->lang_id == 2 )--}}
{{--                    noneSelectedText: 'لم يتم تحديد شيء',--}}
{{--                    @endif--}}
{{--                });--}}
{{--            });--}}

{{--        });--}}
{{--        $(document).on('change', '#formBeneficiaryUpdate #ben_city', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            var city_id = $(this).val();--}}
{{--            $url = '{{route("beneficsettingsiary.getDistanceByCityId")}}' + '/' + city_id;--}}

{{--            $.ajax({--}}
{{--                url: $url,--}}
{{--                dataTypes: 'json',--}}
{{--                type: 'get',--}}
{{--                beforeSend: function () {--}}
{{--                    $("#district_id option").remove();--}}
{{--                    $("#district_id ").append("<option  style='height: 37px;' value></option>");--}}
{{--                    $('#district_id').selectpicker('refresh');--}}
{{--                },--}}
{{--                success: function (data) {--}}
{{--                    if (data != null) {--}}
{{--                        selectDestrice(data);--}}
{{--                    }--}}

{{--                    $('#district_id').selectpicker('refresh');--}}
{{--                },--}}
{{--                error: function () {--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--        function selectDestrice(data) {--}}

{{--            $.each(data, function (index, value) {--}}
{{--                $("#district_id").append('<option value=' + index + '>' + value + '</option>');--}}
{{--            });--}}
{{--        }--}}


{{--        function checkNumberIndividualFamily() {--}}

{{--            var no_of_family =   $('#no_of_family').val() || 0;--}}
{{--            var no_males =   $('#no_males').val()|| 0;--}}
{{--            var no_females =   $('#no_females').val()|| 0;--}}
{{--            var individualNo = parseFloat(no_males)+ parseFloat(no_females);--}}

{{--            if( parseFloat(no_of_family) ==  parseFloat(individualNo)){--}}
{{--                return true;--}}
{{--            }else{--}}
{{--                return false;--}}
{{--            }--}}
{{--        }--}}
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
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>


@endsection


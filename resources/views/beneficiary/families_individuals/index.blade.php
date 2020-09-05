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
                {{$labels['beneficiary_families_individuals'] ?? 'beneficiary_families_individuals'}}
            </h4>


        </div>
        @include('beneficiary.families_individuals.table_render')
{{--        <div class="card-body ">--}}
{{--            <a href="{{route('beneficiary.fam_indev.create')}}"--}}
{{--               class="btn btn-primary btn-round btn-fab btn-sm"--}}
{{--               data-toggle="tooltip" data-placement="top"--}}
{{--               title="{{$labels['add_beneficiary'] ?? 'add_beneficiary'}} ">--}}
{{--                <i class="material-icons">add</i>--}}
{{--            </a>--}}

{{--            @if( Auth::user()->id == 1 || in_array(175,$userPermissions))--}}
{{--                <a href="{{route('beneficiary.famindv.report.form')}}"--}}
{{--                   class="btn btn-primary  btn-sm btn-round btn-fab"--}}
{{--                   rel="tooltip" data-placement="top"--}}
{{--                   title="{{$labels['search'] ?? 'search'}}">--}}
{{--                    <i class="material-icons">search</i>--}}
{{--                </a>--}}
{{--            @endif--}}
{{--            <a href="{{route('beneficiary.fam_indev.settings')}}"--}}
{{--               class="btn btn-primary  btn-sm btn-round btn-fab"--}}
{{--               rel="tooltip" data-placement="top"--}}
{{--               title="{{Auth::user()->lang_id == 1 ? 'Settings' : 'إعدادات'}}">--}}
{{--                <i class="material-icons">settings</i>--}}
{{--            </a>--}}


{{--            <table class="table" id="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}
{{--                    <th>--}}
{{--                        {{$labels['beneficiary_name'] ?? 'beneficiary_name'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['beneficiary_type'] ?? 'beneficiary_type'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['identification_number'] ?? 'identification_number'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['added_at'] ?? 'added_at'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['actions'] ?? 'actions'}}--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($beneficiaries  as $index=>$beneficiary)--}}

{{--                    <tr>--}}
{{--                        <td>{{$index+1}}</td>--}}
{{--                        <td>{{$beneficiary->{'ben_name_'.lang_character()} }}</td>--}}
{{--                        <td>--}}
{{--                            {{$beneficiary->beneficiaryType->{'beneficieris_types_name_'.lang_character()} }}--}}
{{--                        </td>--}}
{{--                        <td>{{$beneficiary->ben_idno}}</td>--}}
{{--                        <td>{{dateFormatSite($beneficiary->created_at)}}</td>--}}
{{--                        <td>--}}
{{--                            <a href="{{route('beneficiary.fam_indev.getedit',$beneficiary->id)}}"--}}
{{--                               class="btn btn-sm btn-success btn-round btn-fab" data-toggle="tooltip"--}}
{{--                               data-placement="top"--}}
{{--                               title="{{$labels['edit'] ?? 'edit'}} "--}}
{{--                            >--}}
{{--                                <i class="material-icons">edit</i>--}}
{{--                            </a>--}}


{{--                            <a href="{{ route('beneficiary.fam_indev.delete',$beneficiary->id )}}"--}}
{{--                               id="btnBeneficiaryDelete" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab"--}}
{{--                               data-placement="top" title=" {{$labels['delete'] ?? 'delete'}} ">--}}
{{--                                <i class="material-icons">delete</i>--}}
{{--                            </a>--}}

{{--                            <a href="{{ route('activity.beneficiaries.beneficiaryForm',[$beneficiary->id ,$beneficiary->ben_type_id] )}}"--}}
{{--                               id="btnBeneficiaryFormPrint" rel="tooltip"--}}
{{--                               class="btn btn-sm btn-primary btn-round btn-fab"--}}
{{--                               data-placement="top" title=" {{$labels['print'] ?? 'print'}} ">--}}
{{--                                <i class="material-icons">print</i>--}}
{{--                            </a>--}}

{{--                        </td>--}}
{{--                    </tr>--}}



{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
    </div>


@endsection
@section('script')
    @include('beneficiary.families_individuals.script_render')


    {{--    <script>--}}
{{--        $(function () {--}}

{{--            active_nev_link('families_individuals')--}}
{{--            DataTableCall('#table', 6);--}}

{{--            $('[data-toggle="tooltip"]').tooltip();--}}
{{--        })--}}


{{--        $(document).on('click', '#btnBeneficiaryDelete', function (e) {--}}
{{--            e.preventDefault();--}}
{{--            $this = $(this);--}}

{{--            swal({--}}
{{--                text: '{{$messageDeleteBeneficiary['text']}}',--}}
{{--                confirmButtonClass: 'btn btn-success  btn-sm',--}}
{{--                cancelButtonClass: 'btn btn-danger  btn-sm',--}}
{{--                buttonsStyling: false,--}}
{{--                showCancelButton: true--}}
{{--            }).then(result => {--}}
{{--                if (result == true) {--}}
{{--                    // var project_id = $('#formProjectMain #id').val();--}}
{{--                    url = $(this).attr('href');--}}
{{--                    $.ajax({--}}
{{--                        url: url,--}}
{{--                        type: 'delete',--}}
{{--                        beforeSend: function () {--}}
{{--                        },--}}
{{--                        success: function (data) {--}}
{{--                            if (data.status == 'true') {--}}
{{--                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);--}}
{{--                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                                $('#contentModal .close').click();--}}
{{--                            } else {--}}
{{--                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function () {--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            })--}}
{{--        });--}}

{{--    </script>--}}

@endsection


@section('js')
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

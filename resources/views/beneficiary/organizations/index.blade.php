{{--@extends('layouts._layout')--}}

{{--@section('css')--}}

{{--@stop--}}
{{--@section('content')--}}


{{--    <div class="card ">--}}
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['beneficiaries_organizations'] ?? 'beneficiaries_organizations'}}--}}

{{--            </h4>--}}

{{--        </div>--}}
{{--        <div class="card-body ">--}}
{{--            <a href="{{route('beneficiary.oraganizations.create')}}" class="btn btn-primary btn-sm btn-fab "--}}
{{--               data-toggle="tooltip" data-placement="top"--}}
{{--               title="  {{$labels['add_organization'] ?? 'add_organization'}}   " >--}}
{{--                <i class="material-icons">add</i></a>--}}
{{--            <a href="{{route('beneficiary.organization.report.form')}}"--}}
{{--               class="btn btn-primary  btn-sm btn-round btn-fab"--}}
{{--               rel="tooltip" data-placement="top"--}}
{{--               title="{{$labels['search'] ?? 'search'}}">--}}
{{--                <i class="material-icons">search</i>--}}
{{--            </a>--}}

{{--            <table class="table" id="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}
{{--                    <th>--}}

{{--                        {{$labels['organization_name'] ?? 'organization_name'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['organization_typee'] ?? 'organization_typee'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['telephone'] ?? 'telephone'}}--}}
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
{{--                @foreach($beneficiaryOrganizations  as $index=>$beneficiaryOrganization)--}}
{{--                     <tr>--}}
{{--                        <td>{{$index+1}}</td>--}}
{{--                        <td>{{$beneficiaryOrganization->{'ben_name_'.lang_character()} }}</td>--}}
{{--                        <td>{{$beneficiaryOrganization->org_type?  $org_types[Auth::user()->lang_id][$beneficiaryOrganization->org_type] : $beneficiaryOrganization->org_type  }}</td>--}}
{{--                        <td>{{$beneficiaryOrganization->ben_tel_no}}</td>--}}
{{--                        <td>{{dateFormatSite($beneficiaryOrganization->created_at)}}</td>--}}
{{--                        <td>--}}
{{--                            <a href="{{route('beneficiary.oraganizations.getedit',$beneficiaryOrganization->id)}}"--}}
{{--                               class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"--}}
{{--                               title="{{$labels['edit'] ?? 'edit'}} ">--}}
{{--                                <i class="material-icons">edit</i>--}}
{{--                            </a>--}}


{{--                            <a href="{{ route('beneficiary.oraganizations.delete',$beneficiaryOrganization->id )}}"--}}
{{--                               id="btnBeneficiaryDelete" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab"--}}
{{--                               data-placement="top"  title="{{$labels['delete'] ?? 'delete'}}">--}}
{{--                                <i class="material-icons">delete</i>--}}
{{--                            </a>--}}

{{--                            <a href="{{ route('activity.beneficiaries.beneficiaryForm',[$beneficiaryOrganization->id ,'3'] )}}"--}}
{{--                               id="btnBeneficiaryFormPrint" rel="tooltip" class="btn btn-sm btn-primary btn-round btn-fab"--}}
{{--                               data-placement="top" title=" {{$labels['print'] ?? 'print'}} ">--}}
{{--                                <i class="material-icons">print</i>--}}
{{--                            </a>--}}

{{--                        </td>--}}
{{--                    </tr>--}}

{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--@endsection--}}
{{--@section('script')--}}
{{--    <script>--}}
{{--        $(function () {--}}
{{--            active_nev_link('organizations');--}}
{{--            DataTableCall('#table',6);--}}
{{--            $('[data-toggle="tooltip"]').tooltip();--}}
{{--        });--}}



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

{{--    </script>--}}

{{--@endsection--}}


{{--@section('js')--}}
{{--    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->--}}
{{--    --}}{{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
{{--    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>--}}
{{--@endsection--}}
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
                {{$labels['beneficiaries_organizations'] ?? 'beneficiaries_organizations'}}

            </h4>

        </div>
        @include('beneficiary.organizations.table_render')

    </div>


@endsection
@section('script')
    @include('beneficiary.organizations.script_render')


@endsection


@section('js')
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection


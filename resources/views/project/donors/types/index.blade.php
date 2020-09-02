@extends('layouts._layout')

@section('content')


    <div class="card ">
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">business_center</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['screen_donor_types']??'screen_donor_types'}}--}}

{{--            </h4>--}}
{{--        </div>--}}
        <div class="card-body ">

            <h4 class="card-title">
                {{$labels['screen_donor_types']??'screen_donor_types'}}
                <a href="{{route('project.donors.types.create')}}"
                   class="btn btn-primary btn-sm btn-fab btn-round "
                   data-toggle="tooltip" data-placement="top" title="{{$labels['add']??'add'}}">
                    <i class="material-icons">add
                    </i>
                </a>

            </h4>
            @include('project.donors.types.table_render')
{{--            <table class="table" id="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th colspan="5">--}}
{{--                        <a href="{{route('project.donors.types.create')}}"--}}
{{--                           class="btn btn-primary btn-sm btn-fab btn-round "--}}
{{--                           data-toggle="tooltip" data-placement="top" title="{{$labels['add']??'add'}}">--}}
{{--                            <i class="material-icons">add--}}
{{--                            </i>--}}
{{--                        </a>--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}
{{--                    <th>--}}
{{--                        {{$labels['donor_types_name_anglish']??'donor_types_name_anglish'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['donor_types_name_arabic']??'donor_types_name_arabic'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['status'] ?? 'status'}}--}}
{{--                    </th>--}}

{{--                    <th>--}}
{{--                        {{$labels['actions']??'actions'}}--}}

{{--                    </th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($donorstypes  as $index=>$donorstype)--}}
{{--                    <tr>--}}
{{--                         <td>{{$index+1}}</td>--}}
{{--                        <td>{{$donorstype->type_name_na}}</td>--}}
{{--                        <td>{{$donorstype->type_name_fo}}</td>--}}
{{--                        <td>{!! activeLabel($donorstype->is_hidden)  !!} </td>--}}
{{--                        <td>--}}

{{--                            <a href="{{route('project.donors.types.edit',$donorstype->id)}}"--}}
{{--                               class="btn btn-success btn-round btn-fab btn-sm" data-toggle="tooltip"--}}
{{--                               data-placement="left" title=" {{$labels['edit']??'edit'}}">--}}
{{--                                <i class="material-icons">edit</i>--}}
{{--                            </a>--}}

{{--                            <a href="{{route('project.donors.types.destroy',$donorstype->id)}}"--}}
{{--                               class="btn btn-danger btn-sm btn-round btn-fab"--}}
{{--                               data-tooltip="tooltip" data-placement="right" title="{{$labels['delete']??'delete'}}"--}}
{{--                               id="DeleteDonorType">--}}
{{--                                <i class="material-icons">delete</i>--}}
{{--                            </a>--}}

{{--                        </td>--}}
{{--                    </tr>--}}


{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}

        </div>

    </div>
@endsection
@section('script')
    <script>
        $(function () {
            active_nev_link('donor_types');

            DataTableCall('#table', 5)
        });
        /*///////////*****delete staff****//////////*/
        $(document).on('click', '#DeleteDonorType', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '{{$messageDeleteDonorTypet['text']}}',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
                buttonsStyling: false,
                showCancelButton: true
            }).then(result => {
                if (result == true) {
                    // var project_id = $('#formProjectMain #id').val();
                    url = $(this).attr('href');
                    $.ajax({
                        url: url,
                        type: 'delete',
                        beforeSend: function () {

                        },
                        success: function (data) {
                            if (data.status == 'true') {
                                $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                $('#contentModal .close').click();
                            } else {
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            }
                        },
                        error: function () {
                        }
                    });
                }
            })
        });


    </script>
@endsection

@section('js')
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

@extends('layouts._layout')

@section('content')

    <div class="card ">
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['screen_index_IncomeRange'] ?? 'screen_index_IncomeRange'}}--}}
{{--            </h4>--}}
{{--        </div>--}}
        <div class="card-body">
            <h4 class="card-title"><span>
                {{$labels['screen_index_IncomeRange'] ?? 'screen_index_IncomeRange'}}

            <a href="{{route('settings.incomeRange.create')}}" class="btn btn-primary btn-sm btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="{{$labels['screen_index_IncomeRange'] ?? 'screen_index_IncomeRange'}} " >
                <i class="material-icons">add</i></a>

            </span> </h4>
            @include('project.projectcategories.table_rander')
{{--            <table class="table dataTable no-footer table-bordered" id="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}
{{--                    <th>--}}
{{--                        {{$labels['Name_English_IncomeRange'] ?? 'Name_English_IncomeRange'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['Name_Arabic_IncomeRange'] ?? 'Name_Arabic_IncomeRange'}}--}}

{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['actions'] ?? 'actions'}}--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($incomeRanges  as $index => $incomeRange)--}}

{{--                    <tr>--}}
{{--                        <td>{{$index+1}}</td>--}}
{{--                        <td>{{$incomeRange->income_name_na}}</td>--}}
{{--                        <td>{{$incomeRange->income_name_fo}}</td>--}}
{{--                         <td>--}}
{{--                            <a href="{{route('settings.incomeRange.edit',$incomeRange->id)}}"--}}
{{--                               class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"--}}
{{--                               title="{{$labels['edit'] ?? 'edit'}} " >--}}
{{--                                <i class="material-icons">edit</i>--}}
{{--                            </a>--}}
{{--                        --}}{{--<button type="button" href="{{ route('settings.incomeRange.delete',$incomeRange->id )}}"--}}
{{--                                    --}}{{--rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnDelete"--}}
{{--                                    --}}{{--data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">--}}
{{--                                --}}{{--<i class="material-icons">delete</i>--}}
{{--                            --}}{{--</button>--}}
{{--                        </td>--}}
{{--                    </tr>--}}

{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
            <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.othersettings.screen')}}"'>Back</button>

        </div>
    </div>


@endsection
@section('script')
    <script>
        $(function () {
            active_nev_link('incomeRange-link');

            DataTableCall('#table', 4)

            $('[data-toggle="tooltip"]').tooltip();
            //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');

            $(document).on('click', '.btnDelete', function (e) {
                e.preventDefault();
                $this = $(this);

                swal({
                    text: '{{$messageDelete['text']}}',
                    confirmButtonClass: 'btn btn-success  btn-sm',
                    cancelButtonClass: 'btn btn-danger  btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true){
                        // var project_id = $('#formProjectMain #id').val();
                        url = $(this).attr('href');
                        $.ajax({
                            url: url,
                            type: 'delete',
                            beforeSend: function () {
                            },
                            success: function (data) {
                                if (data.status == 'true') {
                                    $($this).closest('tr').css('background','red').delay(1000).hide(1000);
                                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                    $('#contentModal .close').click();
                                }else {
                                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                }
                            },
                            error: function () {
                            }
                        });
                    }
                })
            });


        })

    </script>

@endsection



@section('js')

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

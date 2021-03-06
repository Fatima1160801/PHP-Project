@extends('layouts._layout')
@section('css')
    <style>
    .modal-dialog {
    position: absolute;
    top: 0px;
    right: 100px;
    bottom: 0;
    left: 710px;
    z-index: 10040;
    overflow: auto;
    overflow-y: auto;
    }
    </style>
@endsection
@section('content')

    <div class="card ">
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}

{{--                {{$labels['brands'] ?? 'Brand'}}--}}
{{--            </h4>--}}


{{--        </div>--}}
        <div class="card-body ">
            <h4 class="card-title">  <span>

                {{$labels['brands'] ?? 'Brand'}}

            <a href="{{route('brands.create')}}"  class="btn btn-primary btn-sm btn-round btn-fab"
               data-toggle="tooltip"   data-placement="top"
               title="{{$labels['brand'] ?? ' Brand'}}" >
                <i class="material-icons">add</i></a>

</span></h4>
@include('procurement.brand.table_render');
{{--            <table class="table dataTable no-footer table-bordered" style="width:40em;" id="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}
{{--                    <th style="width: 30em;">--}}
{{--                        {{$labels['brand_name'] ?? 'Brand name'}}--}}
{{--                    </th>--}}


{{--                    <th>--}}
{{--                        {{$labels['actions'] ?? 'actions'}}--}}
{{--                    </th>--}}

{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}

{{--                @if(!empty($list))--}}
{{--                    @foreach($list  as $index => $item)--}}
{{--                        <tr>--}}
{{--                            <td>{{$index+1}}</td>--}}
{{--                            <td style="width: 30em;">{{$item->brand_name ?? ""}}</td>--}}

{{--                            <td>--}}
{{--                                <button type="button"--}}
{{--                                   class="btn btn-sm btn-success btn-round btn-fab" onclick='editModal({{$item->id}},"{{$item->brand_name}}")'  data-toggle="modal" data-placement="top"--}}
{{--                                   title="{{$labels['edit'] ?? 'edit'}}">--}}
{{--                                    <i class="material-icons">edit</i>--}}
{{--                                </button>--}}
{{--                                <button type="button" href="{{ route('brands.delete',$item->id )}}"--}}
{{--                                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"--}}
{{--                                        data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">--}}
{{--                                    <i class="material-icons">delete</i>--}}
{{--                                </button>--}}
{{--                            </td>--}}

{{--                        </tr>--}}

{{--                    @endforeach--}}
{{--                @endif--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--            <a href="{{route('screen.index')}}" class="btn  btn-sm backButtons">--}}
{{--                {{$labels['back'] ?? 'back'}}--}}
{{--            </a>--}}
            <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('screen.index')}}"'>Back</button>
{{--            <buuton type="button" class="btn btn-rose" onclick="search()">search</buuton>--}}
{{--        </div>--}}
    </div>

@endsection
@section('script')
    @include('procurement.brand.brand_script')
    <script>
        // $(document).ready(function() {
        //     var table = document.getElementById("table");
        //     var totalRowCount = table.rows.length;
        //     if(totalRowCount-1<=10){
        //         $('#table').DataTable( {
        //             "pagingType": "numbers",
        //         } );}
        // } );
        $(function () {
            active_nev_link('visit-link');
            // DataTableCall('#table',3);
            $('[data-toggle="tooltip"]').tooltip();
            {{--$(document).on('click', '.btnTypeDelete', function (e) {--}}
            {{--    e.preventDefault();--}}
            {{--    $this = $(this);--}}
            {{--    swal({--}}
            {{--        text: '{{$messageDeleteType['text']}}',--}}
            {{--        confirmButtonClass: 'btn btn-success  btn-sm',--}}
            {{--        cancelButtonClass: 'btn btn-danger  btn-sm',--}}
            {{--        buttonsStyling: false,--}}
            {{--        showCancelButton: true--}}
            {{--    }).then(result => {--}}
            {{--        if (result == true){--}}
            {{--            // var project_id = $('#formProjectMain #id').val();--}}
            {{--            url = $(this).attr('href');--}}
            {{--            // alert(url);--}}
            {{--            $.ajax({--}}
            {{--                url: url,--}}
            {{--                type: 'delete',--}}
            {{--                beforeSend: function () {--}}
            {{--                },--}}
            {{--                success: function (data) {--}}
            {{--                    if (data.status == true) {--}}
            {{--                        $($this).closest('tr').css('background','red').delay(1000).hide(1000);--}}
            {{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
            {{--                        $('#contentModal .close').click();--}}
            {{--                    }else {--}}
            {{--                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);--}}
            {{--                    }--}}
            {{--                },--}}
            {{--                error: function () {--}}
            {{--                }--}}
            {{--            });--}}
            {{--        }--}}
            {{--    })--}}
            {{--});--}}


        })
        function search() {
var $subject_na='pr';
$deadlinefrom='1-7-2020';
$deadlineto=null;
$budgetfrom=null;
$budgetto=null;
$status=null;


            $.get('{{url('/search/by/value')}}' + '/' + $subject_na+ '/' + $deadlinefrom+ '/' + $deadlineto+ '/' + $budgetfrom+ '/' + $budgetto+ '/' + $status, function (data) {
                // $.each(data.list, function (index, value) {
                //     list1 += '<option value=' + index + '>' + value + '</option>';
                // });
            });
        }




    </script>

@endsection



@section('js')

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

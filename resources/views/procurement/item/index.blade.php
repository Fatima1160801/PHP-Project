@extends('layouts._layout')

@section('content')

    <div class="card ">
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}

{{--                {{$labels['item'] ?? 'Item'}}--}}
{{--            </h4>--}}


{{--        </div>--}}
        <div class="card-body ">
            <h4 class="card-title "><span>

                {{$labels['item'] ?? 'Item'}}
            <a href="{{route('items.create')}}" class="btn  btn-primary btn-sm btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="{{$labels['additem'] ?? 'Add Items'}}" >
                <i class="material-icons">add</i></a>
                </span></h4>
@include('procurement.item.table_render')
{{--            <table class="table dataTable no-footer table-bordered"style="width:75em;" id="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>#</th>--}}
{{--                    <th>--}}
{{--                        {{$labels['item_name'] ?? 'item name'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['sku'] ?? 'SKU'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['short_description'] ?? 'Short Description'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['description'] ?? 'Description'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['upc'] ?? 'UPC'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['ean'] ?? 'EAN'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['mpn'] ?? 'EAN'}}--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        {{$labels['isbn'] ?? 'ISBN'}}--}}
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
{{--                            <td>{{$item->item_name ?? ""}}</td>--}}
{{--                            <td>{{$item->sku ?? ""}}</td>--}}
{{--                            <td>{{$item->short_description ?? ""}}</td>--}}
{{--                            <td>{{$item->description ?? ""}}</td>--}}
{{--                            <td>{{$item->upc ?? ""}}</td>--}}
{{--                            <td>{{$item->ean ?? ""}}</td>--}}
{{--                            <td>{{$item->mpn ?? ""}}</td>--}}
{{--                            <td>{{$item->isbn ?? ""}}</td>--}}

{{--                            <td>--}}
{{--                                <a href="{{route('items.edit',$item->id)}}"--}}
{{--                                   class="btn btn-sm btn-success btn-round btn-fab"  data-toggle="tooltip" data-placement="top"--}}
{{--                                   title="{{$labels['edit'] ?? 'edit'}} "--}}
{{--                                >--}}
{{--                                    <i class="material-icons">edit</i>--}}
{{--                                </a>--}}
{{--                                <button type="button" href="{{ route('items.delete',$item->id )}}"--}}
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
            <button type="button" class="btn  btn-sm btn-default" onclick='location.href="{{ route('screen.index')}}"'>Back</button>

        </div>
    </div>


@endsection
@section('script')
    @include('procurement.brand.brand_script')
    <script>
        $(function () {
            active_nev_link('visit-link');
            DataTableCall('#table',10);
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





    </script>

@endsection



@section('js')

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

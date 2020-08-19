@extends('layouts._layout')

@section('content')

    <div class="card ">
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">desktop_windows</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['doc_settings'] ?? 'doc_settings'}}--}}
{{--            </h4>--}}


{{--        </div>--}}
        <div class="card-body ">
            <h4 class="card-title"><span>
                {{$labels['doc_settings'] ?? 'doc_settings'}}

            <a href="{{route('settings.documents.create')}}" class="btn btn-primary btn-sm btn-round btn-fab"
               data-toggle="tooltip" data-placement="top"
               title="{{$labels['addDocSettings'] ?? 'Add Document Settings'}}" >
                <i class="material-icons">add</i></a>
            </span> </h4>

            <table class="table dataTable no-footer table-bordered" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        {{ $labels['interface_type_id'] ?? 'interface' }}
                    </th>
                    <th>
                        {{ $labels['attachment_type_id'] ?? 'interface' }}
                    </th>
                    <th>
                        {{ $labels['is_hidden'] ?? 'status' }}
                    </th>
                    <th>
                        {{$labels['actions'] ?? 'actions'}}
                    </th>
                </tr>
                </thead>
                <tbody>
                   <?php
                         if (Auth::user()->lang_id == 1)
                            {
                                $interface_name = 'interface_type_na';
                                $attach_name = 'attachment_type_na';
                                $activeStatus = 'Active';
                                $inactiveStatus = 'InActive';
                            
                            }
                            else
                            {
                                $interface_name = 'interface_type_fo';
                                $attach_name = 'attachment_type_fo';
                                $activeStatus = 'فعال';
                                $inactiveStatus = 'غير فعال';
                            }
                   ?>
                @foreach($documents  as $index => $document)
                   
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$document->intface->$interface_name ?? ""}}</td>
                        <td>{{$document->attachment->$attach_name ?? ""}}</td>
                        <td>@if($document->is_hidden == 0) {{$activeStatus}} @else {{$inactiveStatus}}  @endif</td>
                        <td>
                          <a href="{{route('settings.documents.edit',[$document->interface_type_id,$document->attachment_type_id])}}"
                               class="btn btn-sm btn-success btn-round btn-fab btn_edit"  data-toggle="tooltip" data-placement="top"
                               title="{{$labels['edit'] ?? 'edit'}} ">
                                <i class="material-icons">edit</i>
                            </a>
                            <button type="button" href="{{ route('settings.documents.delete',[$document->interface_type_id,$document->attachment_type_id])}}"
                              rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"
                               data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>
                         
                    </tr>

                @endforeach
                </tbody>
            </table>
            <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.document.screen')}}"'>Back</button>

        </div>
    </div>


@endsection
@section('script')
    <script>
        $(function () {
            active_nev_link('visit-link');
            DataTableCall('#table',5);
            $('[data-toggle="tooltip"]').tooltip();

            $(document).on('click', '.btnTypeDelete', function (e) {
                e.preventDefault();
                $this = $(this);
                swal({
                    text: '{{$messageDeleteType['text']}}',
                    confirmButtonClass: 'btn btn-success  btn-sm',
                    cancelButtonClass: 'btn btn-danger  btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true){
                        // var project_id = $('#formProjectMain #id').val();
                        url = $(this).attr('href');
                        // alert(url);
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
                                    url_edit = $('.btn_edit').attr('href');
                                    // alert(url_edit);
                                    setTimeout(() => {  window.location.href = url_edit; }, 1000);
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

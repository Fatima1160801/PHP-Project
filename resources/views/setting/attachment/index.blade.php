@extends('layouts._layout')

@section('content')


    <?php
    $att_path = str_replace('server.php', '', $_SERVER['PHP_SELF']);
    ?>

    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['files_manager']??'files_manager'}}
            </h4>
        </div>
        <div class="card-body "  >
            <form action="{{route('attachments.search')}}" method="post" id="formFilterAttachment" no-jquery-validate="no-jquery-validate">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <label for="attachmentType_id"
                                   class="col-md-2 col-form-label">{{ $labels["document_type"]??"document_type"}} </label>
                            <div class="col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <select  data-live-search="true"  class="form-control  selectpicker" name="attachmentType_id"
                                            data-style="btn btn-link" id="attachmentType_id">
                                        <option value=" "></option>

                                        @foreach($attachmentTypes as $key=>$name)
                                            <option value="{{$key}}">{{$name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="row">
                            <label for="project_id"
                                   class="col-md-2 col-form-label">{{ $labels["project_id"]??"project_id" }} </label>
                            <div class="col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <select  data-live-search="true"   class="form-control  selectpicker" name="project_id"
                                            data-style="btn btn-link" id="project_id">
                                        <option value=" "></option>

                                        @foreach($projects as $key=>$name)
                                            <option value="{{$key}}">{{$name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-11">
                        <div class="row">
                            <label for="activity_main_id"
                                   class="col-md-2 col-form-label">{{ $labels["activity_main_id"]??"activity_main_id" }} </label>
                            <div class="col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <select  data-live-search="true"  class="form-control  selectpicker" name="activity_main_id"
                                            data-style="btn btn-link" id="activity_main_id">

                                        <option value=" "></option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-11">
                        <div class="row">
                            <label for="activity_sub_id" class="col-md-2 col-form-label">
                                {{ $labels["activity_sub_id"]??"activity_sub_id" }}
                            </label>
                            <div class="col-md-10">
                                <div class="form-group has-default bmd-form-group">
                                    <select  data-live-search="true"  class="form-control  selectpicker" name="activity_sub_id"
                                            data-style="btn btn-link" id="activity_sub_id">
                                        <option value=" "></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <button btn="btnToggleDisabled" type="submit" class="btn   btn-rose   btn-sm pull-right"
                                id="search">
                            {{$labels['search']??'search'}}
                            <div class="loader pull-left" style="display: none;"></div>
                        </button>
                    </div>

                </div>

            </form>
        </div>
        <div class="card-body" id="table-content" >
        <!--<button data-href="{{route("attachments.create")}}" id="btnFileModal" class="btn btn-primary "
               data-toggle="tooltip" data-placement="top" title=" Add New File" >
                <i class="material-icons">cloud_upload</i> Upload New File </button>-->


            <table class="table" id="table">
                <thead>
                <tr>
                     <th>
                        {{$labels['file']??'file'}}
                    </th>
                    <th>
                        {{$labels['document_type']??'document_type'}}
                    </th>
                    <th>
                        {{$labels['description']??'description'}}
                    </th>
                    <th>
                        {{$labels['related_to']??'related_to'}}
                    </th>
                    <th>
                        {{$labels['actions']??'actions'}}
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($attachments as $index=>$attachment)
                    <tr>
                         <td><a href="{{public_path()}}/attach/{{$attachment->file_path}}"  download>{{$attachment->file_path}}</a></td>
                        <td>{{$attachment->attachmentType ? $attachment->attachmentType->{'attachment_type_'.lang_character()} :'' }}</td>
                        <td>{{$attachment->file_desc}}</td>
                        <td>{{$act_list[$attachment->activity_type][Auth::user()->lang_id] ??0}}</td>
                        <td>
                            <a href="{{$att_path}}attach/{{$attachment->file_path}}" rel="tooltip" download
                               class="btn btn-sm btn-info btn-round btn-fab"
                               rel="tooltip" data-original-title=""
                               title="
                               {{$labels['download']??'download'}}"
                               data-placement="top" id="">
                                <i class="material-icons">cloud_download</i>
                            </a>
                            <button type="button" data-href="{{route('attachments.edit',$attachment->id)}}"
                                    rel="tooltip" class="btn btn-sm btn-success btn-round btn-fab btnAttachEdit"
                                    rel="tooltip" data-original-title=""
                                    title=" {{$labels['edit']??'edit'}} "
                                    data-placement="top" id="">

                                <i class="material-icons">edit</i>
                            </button>
                            <button type="button" href="{{route('attachments.delete',$attachment->id)}}"
                                    rel="tooltip"
                                    class="btn btn-sm btn-danger btn-round btn-fab btnAttachDelete"
                                    rel="tooltip" data-original-title="" title=" {{$labels['delete']??'delete'}}"
                                    data-placement="top" id="">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
            {{$attachments->links("pagination::bootstrap-4")}}
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            active_nev_link('files_management');
            DataTableCall('#table', 5);
            $('[data-toggle="tooltip"]').tooltip();
        }

        /* project  change*/
        $(document).on('change', '#formFilterAttachment #project_id', function (e) {
            e.preventDefault();
            var project_id = $(this).val();
            $("#activity_main_id option").remove();
            $('#activity_main_id').selectpicker('refresh');
            $("#activity_sub_id option").remove();
            $('#activity_sub_id').selectpicker('refresh');
            var url_ = '{{route('attachments.getMainActivitiesList')}}' + '/' + project_id;
            $.ajax({
                url: url_,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                    console.log('beforeSend')
                },
                success: function (data) {

                    if (data.main_activities != null) {
                        select_activity_main(data.main_activities);
                    }
                    $('#activity_main_id').selectpicker('refresh');
                },
                error: function () {
                    $('#activity_main_id').selectpicker('refresh');
                }
            });

        });

        function select_activity_main(data) {

            $("#activity_main_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#activity_main_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }

        /* activity_main_id  change*/
        $(document).on('change', '#formFilterAttachment #activity_main_id', function (e) {
            e.preventDefault();
            var activity_main_id = $(this).val();
            $("#activity_sub_id option").remove();
            $('#activity_sub_id').selectpicker('refresh');
            var url_ = '{{route('attachments.getSubActivitiesList')}}' + '/' + activity_main_id;
            $.ajax({
                url: url_,
                dataTypes: 'json',
                type: 'get',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.sub_activities != null) {
                        select_activity_sub(data.sub_activities);
                    }
                    $('#activity_sub_id').selectpicker('refresh');
                },
                error: function () {
                    $('#activity_sub_id').selectpicker('refresh');
                }
            });

        });

        function select_activity_sub(data) {
            $("#activity_sub_id").append("<option value=''></option>");
            $.each(data, function (index, value) {
                $("#activity_sub_id").append('<option value=' + index + '>' + value + '</option>');
            });
        }





        $('#btnFileModal').click(function () {
            var url = $(this).attr('data-href');
            $.get(url, function (response) {
                $('#fileModal').modal('show');
                $('#fileModalForm').html(response);
                $('.selectpicker').selectpicker();

            });
        });

        $('body').on('click', '.btnAttachEdit', function () {
            var url = $(this).attr('data-href');
            $.get(url, function (response) {
                $('#fileModal').modal('show');
                $('#fileModalForm').html(response);
                $('.selectpicker').selectpicker();

                $('input[name="files"]').fileuploader({});
            });
        });


        $(document).on('click', '.btnAttachDelete', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '{{getMessage('2.65')['text']}}',
                confirmButtonClass: 'btn btn-success btn-sm',
                cancelButtonClass: 'btn btn-danger btn-sm',
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

        {{--$('#acti').change(function(){--}}

        {{--var value = $(this).val();--}}

        {{--var url = '{{public_path()}}/attachments/'+value+'/get_act_items';--}}

        {{--});--}}





        $(document).on('submit', '#formFilterAttachment', function (e) {
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataTypes: 'html',
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#table-content').empty();
                    $('.loader').css('display', 'block');
                 },
                success: function (data) {
                    if (data.status == true) {
                        $('#table-content').html(data.html);
                        $('[rel="tooltip"]').tooltip();
                        $('.loader').css('display', 'none');
                    }
                },
                error: function (data) {
                    $('.loader').css('display', 'none');
                }
            })
        });

        $(document).on('click','#link-search .page-item',function (e) {
             var link = $(this).children('a').attr('href');
            e.preventDefault();

            var data = $('#formFilterAttachment').serialize();
            var url = link;
            $.ajax({
                url: url,
                dataTypes: 'html',
                data: data,
                type: 'get',
                beforeSend: function () {
                    $('#table-content').empty();
                    $('.loader').css('display', 'block');
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#table-content').html(data.html);
                        $('[rel="tooltip"]').tooltip();
                        $('.loader').css('display', 'none');
                    }
                },
                error: function (data) {
                    $('.loader').css('display', 'none');
                }
            })
        })



    </script>


@endsection



@section('js')
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection


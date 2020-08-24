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

            <button  class="btn btn-primary btn-sm btn-round btn-fab"
               data-toggle="modal" data-target="#activityModal"  data-placement="top"
               title="{{$labels['addbrand'] ?? 'Add Brand'}}" >
                <i class="material-icons">add</i></button>
{{--                     <button type="button" id="rejectBtn" data-toggle="modal" data-target="#activityModal"  class="btn btn-success  btn-sm ">--}}
{{--    {{$labels['addbrand'] ?? 'add Brand'}} <i class="material-icons">add</i>--}}
</button>
</span></h4>

            <table class="table dataTable no-footer table-bordered" style="width:40em;" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 30em;">
                        {{$labels['brand_name'] ?? 'Brand name'}}
                    </th>


                    <th>
                        {{$labels['actions'] ?? 'actions'}}
                    </th>

                </tr>
                </thead>
                <tbody>

                @if(!empty($list))
                    @foreach($list  as $index => $item)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td style="width: 30em;">{{$item->brand_name ?? ""}}</td>

                            <td>
                                <button type="button"
                                   class="btn btn-sm btn-success btn-round btn-fab" onclick='editModal({{$item->id}},"{{$item->brand_name}}")'  data-toggle="modal" data-placement="top"
                                   title="{{$labels['edit'] ?? 'edit'}}">
                                    <i class="material-icons">edit</i>
                                </button>
                                <button type="button" href="{{ route('brands.delete',$item->id )}}"
                                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"
                                        data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>

                        </tr>

                    @endforeach
                @endif
                </tbody>
            </table>
{{--            <a href="{{route('screen.index')}}" class="btn  btn-sm backButtons">--}}
{{--                {{$labels['back'] ?? 'back'}}--}}
{{--            </a>--}}
            <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('screen.index')}}"'>Back</button>
{{--            <buuton type="button" class="btn btn-rose" onclick="search()">search</buuton>--}}
{{--        </div>--}}
    </div>
        <div class="modal fade" id="activityModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="width:550px;">
                    <div class="card card-signup card-plain">
                        <div  class="modal-header mt-3">
                            <h3 class="modal-title card-title" id="comments_modal_title">  <i class="material-icons">add_shopping_cart</i>{{$labels['addbrand'] ?? 'Add Brands'}}</h3>
                            <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="card-body ">

                                <div id="result-msg"></div>


                                {!! Form::open(['route' => 'brands.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formBrandCreate']) !!}
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

                                    <div class="card-footer ml-auto mr-auto">
                                        <div class="ml-auto mr-auto">
{{--                                            <a href="{{route('brands.index')}}" class="btn  btn-sm btn-default backButtons">--}}
{{--                                                {{$labels['back'] ?? 'back'}}--}}
{{--                                            </a>--}}
                                            <button btn="btnToggleDisabled" type="submit" id="btnAddbrand"
                                                    class="btn btn-next pull-right btn-sm btn-rose saveButtons">
                                                <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                                            </button>

                                        </div>
                                    </div>
                                </div>


                                {!! Form::close() !!}
                            </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" style="width:550px;">
                    <div class="card card-signup card-plain">
                        <div  class="modal-header mt-3">
                            <h3 class="modal-title card-title" id="comments_modal_title"> {{$labels['editbrand'] ?? 'edit Brands'}}</h3>
                            <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="card-body ">

                                <div id="result-msg"></div>


                                {!! Form::open(['route' => 'brands.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formBrandUpdate']) !!}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <input type="text" hidden id="editId" name="editId">
                                <div class="row"><label for="brand_name" class="col-md-3 col-form-label">Brand Name <span style="color:red;">*</span> </label> <div class=" col-md-6"><div class="form-group has-default bmd-form-group is-filled"><input type="text" class="form-control  " name="editName" id="editName" required="" minlength="0" maxlength="100" alt="Brand Name" autocomplete="off"></div></div></div>


                                <div class="col-md-12">

                                    <div class="card-footer ml-auto mr-auto">
                                        <div class="ml-auto mr-auto">
{{--                                            <a href="{{route('brands.index')}}" class="btn  btn-sm btn-default backButtons">--}}
{{--                                                {{$labels['back'] ?? 'back'}}--}}
{{--                                            </a>--}}
                                            <button btn="btnToggleDisabled" type="submit" id="btnEditbrand"
                                                    class="btn-sm btn btn-next  pull-right btn-rose
">
                                                <div class="loader pull-left " style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                                            </button>

                                        </div>
                                    </div>
                                </div>


                                {!! Form::close() !!}
                            </div>

                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
            </div>
        </div>


@endsection
@section('script')
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
                                if (data.status == true) {
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


        $(document).on('submit', '#formBrandCreate', function (e) {
            if (!is_valid_form($(this))) {
                return false;
            }
            e.preventDefault();
            var form = new FormData($(this)[0]);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnAddbrand').attr("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {

                    //  $('#btnAddbrand').attr("disabled", false);
                    $('.loader').hide();
                    if (data.status == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        var update_url="{{route("brands.update")}}"
                        $("#formBrandCreate").attr("action",update_url);
                        $("#id").val(data.id);
                        $('#btnAddbrand').attr("disabled", false);
                        $('.loader').hide();
                    } else if (data.status == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    //$('#addBenf').prop("disabled", false);
                    {{--$("#formBrandCreate").trigger("reset");--}}
                    {{--setTimeout(() => {--}}
                    {{--    window.location.href = "{{route('brands.index')}}";--}}
                    {{--}, 1000);--}}

                },
                error: function (data) {

                }
            });
        });

function editModal(id,brandname){
{{--var d='<div class="modal fade" id="editModal" tabindex="-1" role="dialog">\n' +--}}
{{--        '<div class="modal-dialog modal-lg" role="document">\n' +--}}
{{--        '<div class="modal-content" style="width:550px;">\n' +--}}
{{--       ' <div class="card card-signup card-plain">\n' +--}}
{{--       ' <div  class="modal-header mt-3">\n' +--}}
{{--       ' <h3 class="modal-title card-title" id="comments_modal_title"> {{$labels['addbrand'] ?? 'Add Brands'}}</h3>\n' +--}}
{{--      '  <a type="button" class="close" data-dismiss="modal" aria-label="Close">\n' +--}}
{{--    ' <i class="material-icons">clear</i>\n' +--}}
{{--       ' </a>\n' +--}}
{{--       '</div>\n' +--}}
//        ' <div class="modal-body">\n' +
{{--    var d='<div class="card-body ">\n' +--}}
{{--      '<div id="result-msg"></div>\n' +--}}
{{--         '{!! Form::open(['route' => 'brands.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formBrandCreate']) !!}\n' +--}}
{{--            '<input type="text" hidden value='+id+'\n' +--}}
{{--            '<label>Brand Name<span style="color:red">*</span></label><input type="text" value='+brandname+'\n' +--}}
{{--       ' <div class="col-md-12">\n' +--}}

{{--      '  <div class="card-footer ml-auto mr-auto">\n' +--}}
{{--        '<div class="ml-auto mr-auto">\n' +--}}
{{--        '<a href="{{route('brands.index')}}" class="btn  btn-sm btn-default backButtons">\n' +--}}
{{--           ' {{$labels['back'] ?? 'back'}}\n' +--}}
{{--        ' </a>\n' +--}}
{{--        '<button btn="btnToggleDisabled" type="submit" id="btnAddbrand"class="btn btn-next pull-right btn-sm btn-rose saveButtons"> <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}</button>\n' +--}}
{{--   ' </div> </div> </div>{!! Form::close() !!}</div> </div> {!! Form::close() !!}'--}}
{{--       // </div> </div> </div> </div>';--}}
{{--    $("#editM").append(d);--}}
        $("#editId").val(id);
        $("#editName").val(brandname);
    $('#editModal').modal({
        show: true
    });
}

        $(document).on('submit', '#formBrandUpdate', function (e) {

            if (!is_valid_form($(this))) {
                return false;
            }

            e.preventDefault();

            var form = new FormData($(this)[0]);
            var url = $(this).attr('action');
            // alert($(this).attr('action'));s
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnEditbrand').attr("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    $('#btnEditbrand').attr("disabled", false);
                    $('.loader').hide();
                    if (data.status == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('.loader').hide();
                    }
                    {{--setTimeout(() => {--}}
                    {{--    window.location.href = "{{route('brands.index')}}";--}}
                    {{--}, 1000);--}}


                },
                error: function (data) {

                }
            });

        });

    </script>

@endsection



@section('js')

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

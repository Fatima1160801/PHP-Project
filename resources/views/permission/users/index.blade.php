@extends('layouts._layout')

@section('content')
    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">people</i>
            </div>
            <h4 class="card-title">Users</h4>
        </div>
        <div class="card-body ">
            <a href="{{route('permission.user.create')}}" class="btn btn-primary btn-sm btn-round btn-fab "
               data-toggle="tooltip" data-placement="top" title=" Add New User"
            >
                <i class="material-icons">person_add
                </i>
            </a>

            <div class="material-datatables">
                <table id="table" class="table">
                    <thead>


                    <tr>
                        <th class="text-center">#</th>
                        <th></th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Job Title</th>
                        <th>Group</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users  as $index=>$user)
                        @include('permission.users.row')
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="modalUserGroup" tabindex="-1" role="">
            <div class="modal-dialog modal-login" role="document">
                <div id="contentModal"></div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function () {
            active_nev_link('user');
            DataTableCall('#table', 7);

            $('[data-toggle="tooltip"]').tooltip();
            //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');
        })

        /*******************************************************************************************/
        /********************************group to user*********************************************/
        var User_row_change_group = 0;
        $('#modalUserGroup').on('hidden.bs.modal', function () {
            var user_id = User_row_change_group;
            url = '{{route("permission.group.groupForUser")}}' + '/' + user_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                },
                success: function (data) {
                    var htmlRow = data.html.html;
                    var $editedRow = $('tr[data-id="' + User_row_change_group + '"]');
                    var index = $('#table tbody tr').index($editedRow);
                    // console.log(index)
                    htmlRow = htmlRow.replace('{index}', index + 1);
                    $editedRow.replaceWith(htmlRow);
                    User_row_change_group = 0;
                },
                error: function () {
                }
            });
        });

        $(document).on('click', '#addGroupToUser', function (e) {
            e.preventDefault();
            var user_id = $(this).attr('user_id');
            User_row_change_group = user_id;
            url = '{{route("permission.group.userGroup")}}' + '/' + user_id;
            $.ajax({
                url: url,
                type: 'get',
                dataTypes: 'html',
                beforeSend: function () {
                },
                success: function (data) {
                    $('#contentModal').empty();
                    $('#contentModal').html(data.html.html);

                },
                error: function () {
                }
            });
        });
        $(document).on('change', '.groupId', function (e) {
            e.preventDefault();
            var group_id = $(this).attr('group-id');
            var user_id = $(this).attr('user_id');
            var checkType = "";
            if ($(this).is(':checked')) {
                checkType = 'check';
            } else {
                checkType = 'uncheck';
            }
            data = {
                'group_id': group_id,
                'user_id': user_id,
                'checkType': checkType
            };
            var url = '{{route("permission.group.grantUserGroup")}}';
            $.ajax({
                url: url,
                dataTypes: 'json',
                data: data,
                type: 'post',
                beforeSend: function () {
                },
                success: function (data) {
                    console.log(data);
                },
                error: function () {
                }
            })
        })


        /*lock user*///////////

        $(document).on('click', '.user-status-id', function (e) {
            e.preventDefault();
            $this = $(this);
            var user_id = $this.attr('user-id');
            data = {
                'user_id': user_id,
            };
            var $messageConf ="";
            if($(this).attr('status')== '1'){
                 $messageConf ='{{$messageConfLock['text']}}';
                $this.attr('status','3');
                $this.attr('data-original-title','Un lock');
            }else if($(this).attr('status')== '3'){
                 $messageConf ='{{$messageConfUnLock['text']}}';
                $this.attr('status','1');
                $this.attr('data-original-title',' lock');
            }

            swal(
                {
                    text: $messageConf,
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success  btn-sm',
                    cancelButtonClass: 'btn btn-danger  btn-sm',
                    buttonsStyling: false,
                }).then(result => {
                if (result) {


                    var url = '{{route("permission.user.userstatus")}}';
                    $.ajax({
                        url: url,
                        dataTypes: 'json',
                        data: data,
                        type: 'post',
                        beforeSend: function () {
                        },
                        success: function (data) {
                            console.log(data)
                            if (data == 'lock') {
                                $($this).children('i').removeClass(" material-icons").text("lock ");
                                $($this).children('i').addClass("material-icons");
                            } else if (data == 'lock_open') {
                                $($this).children('i').removeClass("material-icons ").text("lock_open ");
                                $($this).children('i').addClass(" material-icons ");
                            }

                        },
                        error: function () {
                        }
                    })
                }
            }).catch(swal.noop);
        })

    </script>
@endsection


@section('js')
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection

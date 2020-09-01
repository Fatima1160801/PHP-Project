@extends('layouts._layout')

@section('content')
    @include('setting.notification.notification_render')


@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.selectpicker').selectpicker({
                @if(Auth::user()->lang_id == 2 )
                noneSelectedText: 'لم يتم تحديد شيء',
                @endif
            });            active_nev_link('notifications-link')
        });


        $(function(){

            $('body').on('dblclick', '.unselected_user', function () {
                var arr = [];

                var user_name = $(this).attr('data-user-name');
                var user_id = $(this).attr('data-user-id');

                $(this).remove();

                $('#selected_users').append('<tr class="selected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                                                '<td><b>' + user_name + '</b></td>\n' +
                                            '</tr>');
            });


            $('body').on('dblclick', '.selected_user', function () {
                var user_name = $(this).attr('data-user-name');
                var user_id = $(this).attr('data-user-id');

                $(this).remove();

                $('#unselected_users').append('<tr class="unselected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                                                   '<td><b>' + user_name + '</b></td>\n' +
                                               '</tr>');
            });


            $('body').on('click', '.unselected_user', function () {
                var $item = $(this);
                $item.toggleClass('bg_c11');
                if ($item.attr('data-selected')) {
                    $item.removeAttr('data-selected');
                } else {
                    $item.attr('data-selected', 'yes');
                }
                $("tr[data-selected]").each(function () {
                    var $item2 = $(this);
                    if ($item2.attr('data-id') != $item.attr('data-id')) {
                        $item2.removeAttr('data-selected');
                        $item2.toggleClass('bg_c11');
                    }
                });
            });


            $('body').on('click', '.selected_user', function () {
                var $item = $(this);
                $item.toggleClass('bg_c11');
                if ($item.attr('data-selected')) {
                    $item.removeAttr('data-selected');
                } else {
                    $item.attr('data-selected', 'yes');
                }
                $("tr[data-selected]").each(function () {
                    var $item2 = $(this);
                    if ($item2.attr('data-id') != $item.attr('data-id')) {
                        $item2.removeAttr('data-selected');
                        $item2.toggleClass('bg_c11');
                    }
                });
            });


            $('#btnMoveOneLeft').click(function () {
                var x = '';
                $("tr[data-selected]").each(function () {

                    var user_name = $(this).attr('data-user-name');
                    var user_id = $(this).attr('data-user-id');

                    $('#unselected_users').append('<tr class="unselected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                                                        '<td><b>' + user_name + '</b></td>\n' +
                                                  '</tr>');
                    $(this).remove();
                    $(this).removeAttr('data-selected');
                });

            });

            $('#btnMoveOneRight').click(function () {
                var x = '';
                $("tr[data-selected]").each(function () {

                    var user_name = $(this).attr('data-user-name');
                    var user_id = $(this).attr('data-user-id');

                    $('#selected_users').append('<tr class="selected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                        '<td><b>' + user_name + '</b></td>\n' +
                        '</tr>');
                    $(this).remove();
                    $(this).removeAttr('data-selected');
                });

            });


            $('#btnMoveAllRight').click(function () {
                var str = '';
                $('.unselected_user').each(function () {

                    var user_name = $(this).attr('data-user-name');
                    var user_id = $(this).attr('data-user-id');

                    str += '<tr class="selected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                               '<td><b>' + user_name + '</b></td>\n' +
                           '</tr>';
                    $(this).remove();
                    $(this).removeAttr('data-selected');
                });

                var prev = $('#selected_users').html();
                $('#selected_users').html(prev+str);

            });

            $('#btnMoveAllLeft').click(function () {
                var str = '';
                $('.selected_user').each(function () {

                    var user_name = $(this).attr('data-user-name');
                    var user_id = $(this).attr('data-user-id');

                    str += '<tr class="unselected_user" style="cursor: pointer;" data-user-id="'+user_id+'" data-user-name="'+user_name+'">\n' +
                        '<td><b>' + user_name + '</b></td>\n' +
                        '</tr>';
                    $(this).remove();
                    $(this).removeAttr('data-selected');
                });

                var prev = $('#unselected_users').html();
                $('#unselected_users').html(prev+str);

            });


            $('.notificationCommand').change(function(){

                var selected_users = [];
                var to_another_users = [];

                var command_id = $(this).closest('tr').attr('data-command-id');
                var screen_id = $(this).closest('tr').attr('data-screen-id');
                var command_action = $(this).closest('tr').attr('data-command-action');
                var command_controller = $(this).closest('tr').attr('data-command-controller');

                if ($('#to_main_sup_'+command_id).is(':checked')) {
                    to_main_sup = 'yes';
                } else {
                    to_main_sup = 'no';
                }

                if ($('#to_all_sup_'+command_id).is(':checked')) {
                    to_all_sup = 'yes';
                } else {
                    to_all_sup = 'no';
                }

                $('#another_users_'+command_id+' option:selected').each(function () {
                    to_another_users.push($(this).attr('value'));
                });

                var notification_text = $('#noti_text_'+command_id).val();
                var username_location = $('#un_location_'+command_id).val();
                var _token = $('#_token').val();

                $('.selected_user').each(function () {
                    var user_id = $(this).attr('data-user-id');
                    selected_users.push(user_id);
                });

                var url = '{{route('settings.notifications.save')}}';

                var request_params = {
                    command_id : command_id,
                    screen_id : screen_id,
                    command_action : command_action,
                    command_controller : command_controller,
                    selected_users : selected_users,
                    to_main_sup : to_main_sup,
                    to_all_sup : to_all_sup,
                    to_another_users : to_another_users,
                    notification_text : notification_text,
                    username_location : username_location,
                    _token : _token,
                };

                $.post(url,request_params);

            });


            $(".open-button").on("click", function () {
                $(this).closest('.collapse-group').find('.collapse').collapse('show');
            });

            $(".close-button").on("click", function () {
                $(this).closest('.collapse-group').find('.collapse').collapse('hide');
            });

        });


    </script>
@endsection

@section('js')
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <script src="{{asset('js/notifi_settings_wizard.js')}}"></script>
    <script>

        wizard();

        function wizard() {
            notifiWizard.initMaterialWizard();
            setTimeout(function () {
                $('#wizardNotification').addClass('active');
            }, 100);
        }

    </script>
@endsection

<script>
    $(document).on('submit', '#formAdd', function (e) {
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
                $('#saveProjectCategory').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                //  $('#btnAddbrand').attr("disabled", false);
                if (data.status == true) {

                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,data.statusObj,count,1,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }


            },
            error: function (data) {

            }
        });
    });
    $(document).on('submit', '#formEdit', function (e) {
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
                $('#updateRole').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#updateRole').attr("disabled", false);
                $('.loader').hide();
                if (data.status == true) {
                    editRow(data.city,data.statusObj,1,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('.loader').hide();
                }
            },
            error: function (data) {

            }
        });

    });
    $(document).on("click", ".yes", function (e) {
        e.preventDefault();
        $this = $(this);
                // var project_id = $('#formProjectMain #id').val();
         var data1=$(this).attr('data-id');
                var url = '{{ route("project.projectcategories.destroy", [":id",":id1"]) }}';
        url = url.replace(':id', data1);
        url = url.replace(':id1', 2);

        var modal1="#delete"+data1;

                $.ajax({
                    url: url,
                    type: 'delete',
                    beforeSend: function () {
                    },
                    success: function (data) {
                        if (data.status == true) {
                            $(modal1).modal('hide');
                            $('tr[data-id='+data1+']').css('background','red').delay(1000).hide(1000)
                            // $($this).closest('tr').css('background','red').delay(1000).hide(1000);
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            $('#contentModal .close').click();
                        }else {
                            myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        }
                    },
                    error: function () {
                    }


        })
    });
</script>
@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>


    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('js/modal_setting.js')}}"></script>
    <script src="{{ asset('js/wizardReport.js')}}"></script>
@endsection
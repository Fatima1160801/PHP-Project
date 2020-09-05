<script>
    $(document).on('click', '.btnCityDelete', function (e) {
        e.preventDefault();
        $this = $(this);

        swal({
            text: 'Are you sure to delete document type?',
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
    // $('#formAttachmentTypesCreate').submit(function(e){
        $(document).on('submit', '#formAttachmentTypesCreate', function (e) {
        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnAddAttachmentTypes').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnAddAttachmentTypes').attr("disabled", false);
                $('.loader').hide();
                if (data.status == 'true') {
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTable(data.city,count,1,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('#formAttachmentTypesCreate')[0].reset();
                    $('.loader').hide();
                } else if (data.status == 'false') {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);



            },
            error: function (data) {

            }
        });

    });
    // $('#formAttachmentTypesUpdate').submit(function(e){
        $(document).on('submit', '#formAttachmentTypesUpdate', function (e) {
        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();

        var form = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            beforeSend: function () {
                $('#btnUpdateAttachmentTypes').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnUpdateAttachmentTypes').attr("disabled", false);
                $('.loader').hide();
                if (data.success == true) {
                    editRow(data.city,1,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    $('#formAttachmentTypesUpdate')[0].reset();
                    $('.loader').hide();
                } else if (data.success == false) {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }

            },
            error: function (data) {

            }
        });

    });
    $(document).on('click', '.btnTypeDelete', function (e) {
        e.preventDefault();
        $this = $(this);
        swal({
            text: 'Are you sure to delete document setting?',
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
    $(document).on('submit', '#formOpportunityUpdate', function (e) {

        if (!is_valid_form($(this))) {
            return false;
        }

        e.preventDefault();
alert("kk");
        var form = new FormData($(this)[0]);
        var url = $(this).attr('action');
        // alert(url);
        // alert($(this).attr('action'));
        $.ajax({
            url: url,
            data: form,
            type: 'post',
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#btnEditOpportunity').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {
                $('#btnEditOpportunity').attr("disabled", false);
                $('.loader').hide();
                if (data.status == 'true') {
                    // editRow(data.city,2,"","");
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                {{--    $('.loader').hide();--}}
                {{--    setTimeout(() => {  window.location.href = "{{route('settings.documents.index')}}"; }, 1000);--}}
                }

            },
            error: function (data) {

            }
        });

    });


    $(document).on('submit', '#formDocumentCreate', function (e) {
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
                $('#btnAddOpportunity').attr("disabled", true);
                $('.loader').show();
            },
            success: function (data) {

                $('#btnAddOpportunity').attr("disabled", false);
                $('.loader').hide();
                if (data.status == 'true') {
                    if(data.check==2){
                    var table = $('#table').dataTable();
                    //Get the total rows
                    var count=table.fnGetData().length;
                    appendTableSetting(data.city,count,data.interface,data.attachment);}
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                    $('.loader').hide();
                } else if (data.status == 'false') {
                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                }
                //$('#addBenf').prop("disabled", false);
                {{--$("#formDocumentCreate").trigger("reset");--}}
                {{--setTimeout(() => {  window.location.href = '{{route('settings.documents.index')}}'; }, 1000);--}}

            },
            error: function (data) {

            }
        });
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
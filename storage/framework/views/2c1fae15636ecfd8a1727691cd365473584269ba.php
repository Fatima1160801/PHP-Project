<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    <title>PME :: Project Management Evaluation</title>
    <!-- Required meta tags -->

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <script>
        if (performance.navigation.type == 2) {
            location.reload(true);
        }
    </script>
    <!--     Fonts and icons     -->
    
    
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/materialicon.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>"/>


    <?php if(Auth::user()->lang_id == '2'): ?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet">
    <?php endif; ?>
<!-- Material Dashboard CSS -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/css/material-dashboard.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('fonts/fonts.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/jquery.fileuploader.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote.css')); ?>">
    <?php if(Auth::user()->lang_id == '2'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/style-rtl.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->yieldContent('css'); ?>
    <style>
        .bolder {
            font-weight: bold;
        }
        .refer_link{
            cursor: pointer; color: #3F51B5;line-height: 40px; margin-right: 10px;
        }
        .timeline.timeline-simple:before {
            left: 5%;
            background-color: #fff;
        }
        .choose-file-title{
            margin-top: 25px;
        }
        .bolder-large{
            font-size: 24px;
            font-weight: bold;
        }
    </style>

    <script src="<?php echo e(asset('assets/js/core/jquery.min.js')); ?>" type="text/javascript"></script>


</head>
<body <?php if(Auth::user()->lang_id == '2'): ?> class="rtl" <?php endif; ?> lang="en-US">

<script>
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            

    var time_rtr = parseFloat('<?php echo e(\App\Models\Setting\Setting::runTimeRecording()); ?>') * 60 * 60;

</script>


<div class="wrapper">

    <?php echo $__env->make('layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <div class="main-panel">
        <!-- Navbar -->
    <?php echo $__env->make('layouts.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
        <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <?php echo e($labels['cancel'] ?? 'cancel'); ?>

                </button>
                <button type="button" class="btn btn-primary">
                    <?php echo e($labels['save'] ?? 'save'); ?>

                </button>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('layouts.file_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.report_modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!--   Core JS Files   -->

<script src="<?php echo e(asset('assets/js/core/jquery.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/core/popper.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/core/bootstrap-material-design.min.js')); ?>" type="text/javascript"></script>

<!-- Plugin for the Perfect Scrollbar -->
<script src="<?php echo e(asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')); ?>"></script>

<!-- Plugin for the momentJs  -->
<script src="<?php echo e(asset('assets/js/plugins/moment.min.js')); ?>"></script>

<!--  Plugin for Sweet Alert -->
<script src="<?php echo e(asset('assets/js/plugins/sweetalert2.js')); ?>"></script>

<script src="<?php echo e(asset('js/jquery.fileuploader.min.js')); ?>"></script>


<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="<?php echo e(asset('assets/js/plugins/jquery.bootstrap-wizard.js')); ?>"></script>




<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="<?php echo e(asset('assets/js/plugins/bootstrap-datetimepicker.min.js')); ?>"></script>




























<!--  Notifications Plugin    -->
<script src="<?php echo e(asset('assets/js/plugins/bootstrap-notify.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>

<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo e(asset('assets/js/material-dashboard.js?v=2.0.2" type="text/javascript')); ?>"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>


            
            
            
            
            
            
            
            
    var x = null;

    function showFlashStatus() {
        var result = <?php echo json_encode(session('array'), 15, 512) ?> ||
        {
        }
                
                
                
                

        var title = result.title;
        var type = result.type;
        var icon = result.icon;


        <?php \Illuminate\Support\Facades\Session::forget('array'); ?>
        if (!result.title) {
            title = "SUCCESS";
        }
        if (!result.type) {
            type = 'success'
        }
        if (!result.icon) {
            icon = 'done'
        }
        if (result.text) {
            myNotify(icon, title, type, '5000', result.text);
        }
    }

    showFlashStatus();

    function myNotify(icon, title, type, delay, massage) {
        $.notifyClose();
        $.notify({
            icon: icon,
            title: title,
            message: massage

        }, {
            // settings
            newest_on_top: true,
            type: type,
            z_index: 50000000000000,
            delay: delay
        });

    }

    $.ajaxSetup({
        statusCode: {
            409: function () {
                //  alert('<<Unauthorized action.>>');
                swal({
                    type: 'error',
                    title: 'error',
                    text: 'You are not in team members,so you don’t have permissions to view this page Please contact your administration!',

                    // footer: '<a href>Why do I have this issue?</a>'
                }).then((result) => {
                    if (!result.value) {
                        $('.modal').modal('hide');
                    }
                })
                $('.loader').hide();
            },
         403: function () {
                //  alert('<<Unauthorized action.>>');
                swal({
                    type: 'error',
                    title: 'error',
                    text: 'You don’t have permissions to view this page Please contact your administration!',

                    // footer: '<a href>Why do I have this issue?</a>'
                }).then((result) => {
                    if (!result.value) {
                        $('.modal').modal('hide');
                    }
                })


            },
            422: function (jqXhr) {
                $('[btn="btnToggleDisabled"]').prop("disabled", false);
                console.log(13)
                $('.loader').css('display', 'none');
                //process validation errors here.
                var errors = jqXhr.responseJSON.errors; //this will get the errors response data.
                //show them somewhere in the markup
                //e.g
                //     var errorsHtml = '<div class="alert"><ul>';

                var errorsHtml = "<ul>";
                $.each(errors, function (key, value) {
                    errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                    // $('[name="'+key+'"]').after("<span>"+value[0]+"</span>").parent().addClass("has-error");
                });
                //errorsHtml += '</ul></div>';
                errorsHtml += '</ul>';
                // $('form').prepend(errorsHtml); //appending to a <div id="form-errors"></div> inside form
                myNotify('error', '', 'danger', '50000', errorsHtml)
            }
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($('.flash-message').text() != '') {
        swal({
            type: 'error',
            title: 'error',
            text: $('.flash-message').text(),

            // footer: '<a href>Why do I have this issue?</a>'
        })
    }

    $(document).ready(function () {
        $('[data-tooltip="tooltip"]').tooltip();
        $('[data-toggle="tooltip"]').tooltip();
    });

    // window.setTimeout(function () {
    //     $(".alert").fadeTo(1000, 0).slideUp(2000, function () {
    //         $(this).remove();
    //     });
    // }, 3000);

    $('.modal').on('show.bs.modal', function (e) {
        $('.tooltip').tooltip('hide');
    });


    <?php if(session('result_message')): ?>
    swal({
        type: 'error',
        title: 'error',
        text: <?php echo json_encode(session('result_message'), 15, 512) ?>,

        // footer: '<a href>Why do I have this issue?</a>'
    })
    <?php endif; ?>

    /*           var i; for (i = 0; i < x.length; i++) {
            console.log(x.charAt(i));
            }
            console.log(x);
                   $.each(x, function( index, value ) {
                console.log(x.charCodeAt(index))

            });
            */

    $(document).on('keydown', '.check-is-number', function (e) {
        if (e.keyCode === 110) {
            var x = $(this).val();
            if (x.indexOf(".") >= 0) {
                e.preventDefault();
            }
        }
        if (e.shiftKey) e.preventDefault();
        else {
            var nKeyCode = e.keyCode;
            //Ignore Backspace and Tab keys
            if (nKeyCode == 8 || nKeyCode == 9 || nKeyCode == 110 || nKeyCode == 190) return;
            if (nKeyCode < 95) {
                if (nKeyCode < 48 || nKeyCode > 57) e.preventDefault();
            } else {
                if (nKeyCode < 96 || nKeyCode > 105) e.preventDefault();
            }

        }
    });


    $(document).on('keydown', '.datetimepicker', function (e) {
        if (e.shiftKey) e.preventDefault();
        else {
            var nKeyCode = e.keyCode;
            //Ignore Backspace and Tab keys
            if (nKeyCode == 8 || nKeyCode == 9 || nKeyCode == 111) return;
            if (nKeyCode < 95) {
                if (nKeyCode < 48 || nKeyCode > 57) e.preventDefault();
            } else {
                if (nKeyCode < 96 || nKeyCode > 105) e.preventDefault();
            }

        }
    });

    //190
    ids = [];

    function active_nev_link(id) {


        setTimeout(function () {
                //   $('.nav-item').removeClass('active');
                //    $('#' + id).addClass('active');
                collapse(id);
                //   click_nav_item(ids.reverse())
            }
            , 50);
        setTimeout(function () {
                var position = $('#' + id).position();
                if (position != undefined) {
                    var position_link = position.top;
                    position_link = position_link - 200;
                    if (position_link > 400) {
                        $('.sidebar-wrapper').animate({scrollTop: position_link}, 10);
                    }
                }
            }
            , 50)

    }

    function collapse(id) {


        var x = $('#' + id).closest('.collapse');
        if (x.length > 0) {
            var p_id = x.attr('id');
            // $('#id' + p_id + '> a').click();
            ids.push(p_id);
            $('#id_' + p_id).addClass('active');
            $('#id' + p_id).addClass('active');
            collapse('id_' + p_id);
        }
    }

    function click_nav_item(ids) {
        $.each(ids, function (index, value) {
            $('#id' + value + '> a').click();
            $('#id_' + value + '> a').click();
        });

    }

    function tablePageLeng(rowCount) {
        if (rowCount < 11) {
            $('.pagination').hide();
            $('.dataTables_length').hide();
        } else {
            $('.pagination').show();
            $('.dataTables_length').show();
        }
    }

    function funValidateForm() {
        $('form:not([no-jquery-validate])').each(function () {
            $(this).validate({
                errorPlacement: function (error, element) {

                    if (element.hasClass('selectpicker')) {
                        $(element).parent().append(error);
                    } else {
                        $(element).after(error);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    if ($(element).hasClass('selectpicker')) {
                        $(element).parent().addClass(errorClass).removeClass(validClass);
                    }
                    $(element).addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function (element, errorClass, validClass) {
                    if ($(element).hasClass('selectpicker')) {
                        $(element).parent().removeClass(errorClass).addClass(validClass);

                    }
                    $(element).removeClass(errorClass).addClass(validClass);
                }
            });

        })
    }

    $(document).on('changed.bs.select', '.selectpicker', function (e, clickedIndex, isSelected, previousValue) {
        var $form = $(this).closest('form');
        if ($form.length > 0) {
            if (!$form.attr('no-jquery-validate')) {
                $(this).valid();
            }
        }

    });

    function is_valid_form($form) {
        var attr = $form.attr('no-jquery-validate');
        if (typeof attr === typeof undefined || attr === false) {
            var $valid = $form.valid();
            if (!$valid) {
                // $validator.focusInvalid();
                return false;
            }
        }

        return true;
    }


    var menuArray = [];
    function initMenuArray(){
        $('.sidebar-wrapper li').each(function (index, element) {

            menuArray.push($(element));
        });
    }

    $(document).on('input','[id="search-input"]',function (e) {
        var dInput = this.value;
         var SearchTxt = $(this).val();
         searchMinu(dInput);
    });

    $(function () {
        initMenuArray()
    })
    function searchMinu(SearchTxt){
        // $('[data-toggle="collapse"]').each((i,e)=>{
        //     $(e).collapse('hide')
        // });

        //
        $(menuArray).each(function (index, $element) {
            var perant_open = $element.find('div.show')
            perant_open.removeClass('show');
            perant_open.parent().removeClass('active')
        });



        $(menuArray).each(function (index, $element) {
            var txt = $element.find('span').text()
            if(txt.toLowerCase().indexOf(SearchTxt.toLowerCase())>-1){

                $element.show();
                $element.closest('li').show();

            }else{
                $element.hide();
            }
        });

        $('.sidebar-wrapper').animate({scrollTop: 0}, 0);
        $('[data-toggle="collapse"]').each((i,e)=>{
            if($(e).attr('aria-expanded') !== true){$(e).trigger('click')}
        })

     //   $('[data-toggle="collapse"]').collapse('show')
    }
    var x = [];
    function  highlight($element, term) {return;
        var isExists = false;
        $(x).each(function(index, element){
            if(element == $element){
                isExists = true;
            }


        });

        if(isExists){
            console.log('exists')
        }else{
            x.push($element);
        }

        var src_str = $element.html();

       // term = term.replace(/(\s+)/,"(<[^>]+>)*$1(<[^>]+>)*");
        //var pattern = new RegExp("\\b"+term+"\\b","gi");
        //pattern = new RegExp(`(\\b${term}\\b)`, 'gi');

        //console.log(pattern);
        src_str = src_str.toLowerCase().replace(term.toLowerCase(), "<mark>"+term.toLowerCase()+"</mark>");
        //console.log(src_str)
        //src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/,"$1</mark>$2<mark>$4");

        $element.html(src_str);

        //src_str.split(term).join('</mark><mark>')


    }



 </script>


<?php if(session('inputFormFromValidator')): ?>

    <script>
        $(document).ready(function () {
            var inputFormFromValidator = <?php echo json_encode(session('inputFormFromValidator'), 15, 512) ?>;
            inputForm(inputFormFromValidator)
        });

        function inputForm(inputFormFromValidator) {
            $.each(inputFormFromValidator, function (index, value) {
                $('body form #' + index).val(value);
            });
            $('.selectpicker').selectpicker('refresh');
        }

        <?php
            session()->forget('inputFormFromValidator')
        ?>
    </script>
<?php endif; ?>

<script>
    $(document).on('keypress', '.noArabic', function (e) {
        if (e.keyCode >= 1569 && e.keyCode <= 1711) {
            return false;
        } else {
            return true;
        }
    });
</script>

<script>

    function DataTableCall(id = null, number_column = 0) {


        if (id == null) {
            id = "#table"
        }
        $arrayCol = [];
        if (number_column > 1) {
            var i;
            for (i = 0; i < number_column; i++) {
                if (i < 1) {
                    $arrayCol.push({"orderable": false});
                } else {
                    $arrayCol.push(null);
                }
            }
        }
        $(id).DataTable({
            language: {
                search: "_INPUT_",

                <?php if(\Illuminate\Support\Facades\Auth::user()->lang_id == 2): ?>
                searchPlaceholder: "بحث",
                sProcessing: "جارٍ التحميل...",
                sLengthMenu: "أظهر _MENU_ مدخلات",
                sZeroRecords: "لم يعثر على أية سجلات",
                sInfo: "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                sInfoEmpty: "يعرض 0 إلى 0 من أصل 0 سجل",
                sInfoFiltered: "(منتقاة من مجموع _MAX_ مُدخل)",
                sInfoPostFix: "",
                sSearch: "ابحث:",
                sUrl: "",
                oPaginate: {
                    sFirst: "الأول",
                    sPrevious: "السابق",
                    sNext: "التالي",
                    sLast: "الأخير"
                },
                <?php else: ?>
                searchPlaceholder: "search",
                <?php endif; ?>
            },
            "columns": $arrayCol
        });
    }
//wss









    $('body').on('keyup', '[type="text"]', function (e) {
        $my_content = $(this).val();
        if (isUnicode($my_content)) {
            $(this).css('direction', 'rtl');
        } else {
            $(this).css('direction', 'ltr');
        }
    });

    function formatNumber_site(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    function replaceComma(num) {
        return num.replace(/,/g, '');
    }


    $('body').on('keyup', '.input-currency-gf', function (e) {
        e.preventDefault()
        var num = $(this).val();
        var num_replaceComma = replaceComma(num)

        var length = num_replaceComma.split(".").length - 1;
        if (length > 1) {
            num_replaceComma = validate_number(num_replaceComma);
        }

        var num_split_array = num_replaceComma.split(".");

        if (num_split_array.length == 2) {
            if (num_split_array[1].length > 3) {
                num_split_array[1] = num_split_array[1].substring(0, 3)
            }
            num_replaceComma = num_split_array.join('.')
            console.log(num_replaceComma)

        }

        var num_currncy = formatNumber_site(num_replaceComma);
        $(this).val(num_currncy);
    });

    function validate_number(val_) {
        val_ = val_.replace(/\.+$/, "");
        return val_;
    }


    function isUnicode(str) {
        var letters = [];
        for (var i = 0; i <= str.length; i++) {
            letters[i] = str.substring((i - 1), i);
            if (letters[i].charCodeAt() > 255) {
                return true;
            }
        }
        return false;
    }

    $('#file').on('change.bs.fileinput', function (event) {
        //    event.stopPropagation();
        if (event.target.files.length == 0) {
            console.log(event.target.files.length);
            return false;
        }
        // alert("yy");
        // console.log(event.target.files.length);
    });

    $(document).on('hidden.bs.modal', '.modal', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function clearForm(id) {
        $(id).find('input:text,input, input:password, select, textarea').val('');
        $('.selectpicker').val('');
        $('.selectpicker').selectpicker('refresh');

    }

    function displayResponseMessage($message){
        $body='';
        $title='';
        $type='warning';
        $icon='warning';
        if($message != "" && $message !=null){
            if($message.text !="" && $message.text != null){
                $body=$message.text;
            }
            if($message.title !="" && $message.title != null){
                $title=$message.title;
            }
            if($message.type !="" && $message.type != null){
                $type=$message.type;
            }
            if($message.icon !="" && $message.icon != null){
                $icon=$message.icon;
            }
            myNotify($icon, $title, $type, '5000', $body);
        }
    }

    $(document).on('submit', '#formEditFullDesc', function (e) {
        var co_st=$("#fixed_status_val").val();
        if(co_st ==1){
            e.preventDefault();
            if (!is_valid_form($(this))) {
                return false;
            }
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                beforeSend: function () {
                    $('.loader').show();
                },
                success: function (data) {
                    if (data.status == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    } else if (data.status == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    $('.loader').hide();
                },
                error: function (data) {
                    $('.loader').hide();
                }
            });
        }else{
            <?php if(!empty($abortEditNote)): ?>
            myNotify('<?php echo e($abortEditNote["icon"]); ?>', '<?php echo e($abortEditNote["title"]); ?>', '<?php echo e($abortEditNote["type"]); ?>', '5000','<?php echo e($abortEditNote["text"]); ?>');
            <?php endif; ?>
            return false;
        }
    });


    function checkFunderVal(){
        var valid=false;
        var funder=$("#funder_contribution").val();
        if(funder !=null && funder !="" && funder !=undefined){
            var fun_val=parseFloat(parseFloat(funder)).toFixed(3);
            var fixed_per=parseFloat(parseFloat(100)).toFixed(3);
            if(parseFloat(fun_val) <= parseFloat(fixed_per)){
                valid=true;
            }else{
                valid=false;
            }
        }else{
            valid=true;
        }
        return valid;
    }

    function ckeckBudgetCurrencyVal(){
        var valid=true;
        var budget_value=$("#budget_value").val();
        if(budget_value !=null && budget_value !="" && budget_value !=undefined){
            var c_currency_id=$("#c_currency_id").val();
            if(c_currency_id !=null && c_currency_id !="" && c_currency_id !=undefined){
            }else{
                valid=false;
            }
        }
        return valid;
    }

</script>
<?php echo $__env->yieldContent('script'); ?>


</body>
</html>
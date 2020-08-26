@extends('layouts._layout')
@section('css')
    <style>
    .mainli li:hover,.mainli li:active,.mainli li:focus,.mainli li:visited{
    background: #F3F6F9 !important;

    }
    .mainli li:hover a,.mainli li:hover i, .mainli li:active a,.mainli li:active i,.mainli li:focus a,.mainli li:focus i,.mainli li:visited a,.mainli li:visited i{
    color:#3699FF !important;

    }
    .selected-href{

    }
    .mainli li {
    padding: 15px !important;
    }
    .mainli a,.mainli i {
    color:#3F4254 !important;
    }
    .mainli i {
    color: #B5B5C3 !important
    }
    .default-color{
    color:#afafaf;
    }
    .selected-item,.selected-item i,.selected-item span{
    background: #F3F6F9 !important;
    color:#3699FF !important;

    }
    #containerc{
        margin-right: -88px;
    }
    #containerc{
        margin-right: -88px;
    }
    /*#table{*/
    /*    margin-left:15%;*/
    /*    width:35em;*/
    /*    text-align: center;*/
    /*}*/
    #createmodal{
        margin-top:-15px;
        /*background-color: #5d76a8;*/
    }
    #createmodal .card-title,#createmodal .card-title i{
        text-align: center;
        font-size: 19px !important;
        font-weight: bold;
        color:#5d76a8;
    }
    #createmodal .card-body{
        margin-top: 20px;
    }
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
    #table{
        margin-left: 0% !important;
    }
    .table {
        width: 60em !important;
    }
    span {
        font-weight: 500;
        font-size: 14px;
    }
    #table{
        margin-left: 0% !important;
    }
    .table {
        width: 60em !important;
    }
        /*.modalSize{*/
        /*    position: absolute;*/
        /*    top: 0px;*/
        /*    right: 500px;*/
        /*    bottom: 0;*/
        /*    left: 800px;*/
        /*    z-index: 10040;*/
        /*    overflow: auto;*/
        /*    overflow-y: auto;*/
        /*}*/
    </style>
@endsection
@section('content')


{{--    //New Design--}}
<div class="container ml-2">
    <div class="row" id="containerc" style="height: 500px;">
        <div class="col-md-3 card p-3 mr-4">
            <ul class="navbar-nav mainli">
                <li class="nav-item mb-3" id="brand" data-nameeng="Brands" data-namear="العلامات التجارية" data-value="1">
                    <a href="#"
                       class="navi-link py-4 ">
                        <div class="card-icon ">
                                <span>  <i class="material-icons default-color mr-2 "
                                    >storage</i>@if($lang==1)Brands @elseالعلامات التجارية@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="unit" data-nameeng="Units" data-namear="الوحدات" data-value="2">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='fas fa-ruler-vertical' style='font-size:24px'></i>&nbsp;&nbsp;&nbsp;&nbsp;@if($lang==1)Units @else الوحدات@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="sector" data-nameeng="Sectors" data-namear="القطاعات" data-value="3">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>business</i>&nbsp;&nbsp;@if($lang==1)Sectors @elseالقطاعات@endif</span>
                        </div>
                    </a>

                </li>

                <li class="nav-item mb-3 " id="service" data-nameeng="Services" data-namear="الخدمات" data-value="4">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>public</i>&nbsp;&nbsp;@if($lang==1)Services @elseالخدمات@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="purchase" data-nameeng="Purchases Methods" data-namear="طرق الشراء" data-value="5">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>shopping_cart</i>&nbsp;&nbsp;@if($lang==1)Purchases Methods @elseطرق الشراء@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="item" data-nameeng="Items" data-namear="الأصناف" data-value="6">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>games</i>&nbsp;&nbsp;@if($lang==1)Items @elseالأصناف@endif</span>
                        </div>
                    </a>

                </li>
                <li class="nav-item mb-3 " id="itemgroup" data-nameeng="Item Groups" data-namear="مجموعات الأصناف" data-value="7">
                    <a href="#"
                       class="navi-link py-4">
                        <div class="card-icon">
                            <span>  <i class='material-icons'>group_work</i>&nbsp;&nbsp;@if($lang==1)Item Groups @elseمجموعات الأصناف@endif</span>
                        </div>
                    </a>

                </li>

            </ul>
        </div>
        <div class="col-md-8 p-3 card" style="width:2000px;"><div class="card-title" id="content">
                <label id="title" style="font-weight: bold;font-size: 19px !important;"></label>&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<span id="add"></span>
            </div>
            <div id="loadScreen" class="col-md-2" style="padding-left:300px;"><div class="loader pull-center" style="display: none;width: 30px;
 height: 30px;"></div></div>

            <div id="render_result">

            </div>
        </div>
    </div>
</div>
{{--   Start Modal--}}
<div class="modal fade" id="procurementModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div  class="modal-header mt-3">
                    <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </a>
                </div>
                <div class="modal-body" id="procurementModalBody">
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
    @include('procurement.brand.brand_script')
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script>
        $("#brand").click(function (e) {
            addSelected($("#brand").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");

            $('#loadScreen div.loader').show();
            e.preventDefault();
            $.get('{{route('brands.index')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#brand").attr("data-nameeng"));
                    else
                        $("#title").html($("#brand").attr("data-namear"))
                    $("#add").html("<button type=\"button\" onclick='addBrand()' id='addBrand' class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"Add New Brand\" >\n" +
                        "                <i class=\"material-icons\">add</i></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',3);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                            {{--                            @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });
        $("#unit").click(function (e) {
            addSelected($("#unit").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            $("#procurementModal").addClass("modalSize")

            $('#loadScreen div.loader').show();
            e.preventDefault();
            $.get('{{route('units.index')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#unit").attr("data-nameeng"));
                    else
                        $("#title").html($("#unit").attr("data-namear"))
                    $("#add").html("<button type=\"button\" onclick='addUnit()' id='addUnit' class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"Add New Brand\" >\n" +
                        "                <i class=\"material-icons\">add</i></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',4);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                            {{--                            @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });
        $("#sector").click(function (e) {
            addSelected($("#sector").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            // $("#procurementModal").addClass("modalSize")

            $('#loadScreen div.loader').show();
            e.preventDefault();
            $.get('{{route('sectors.index')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#sector").attr("data-nameeng"));
                    else
                        $("#title").html($("#sector").attr("data-namear"))
                    $("#add").html("<button type=\"button\" onclick='addSector()' id='addSector' class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"Add New Sector\" >\n" +
                        "                <i class=\"material-icons\">add</i></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',4);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                            {{--                            @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });

        $("#service").click(function (e) {
            addSelected($("#service").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            // $("#procurementModal").addClass("modalSize")

            $('#loadScreen div.loader').show();
            e.preventDefault();
            $.get('{{route('services.index')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#service").attr("data-nameeng"));
                    else
                        $("#title").html($("#service").attr("data-namear"))
                    $("#add").html("<button type=\"button\" onclick='addService()' id='addService' class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"Add New Service\" >\n" +
                        "                <i class=\"material-icons\">add</i></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',4);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                            {{--                            @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });

        $("#purchase").click(function (e) {
            addSelected($("#purchase").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            // $("#procurementModal").addClass("modalSize")

            $('#loadScreen div.loader').show();
            e.preventDefault();
            $.get('{{route('purchasemethods.index')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#purchase").attr("data-nameeng"));
                    else
                        $("#title").html($("#purchase").attr("data-namear"))
                    $("#add").html("<button type=\"button\" onclick='addPurchase()' id='addPurchase' class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"Add New Purchase\" >\n" +
                        "                <i class=\"material-icons\">add</i></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',4);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                            {{--                            @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });
        $("#item").click(function (e) {
            addSelected($("#item").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            // $("#procurementModal").addClass("modalSize")

            $('#loadScreen div.loader').show();
            e.preventDefault();
            $.get('{{route('items.index')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#item").attr("data-nameeng"));
                    else
                        $("#title").html($("#item").attr("data-namear"))
                    $("#add").html("<button type=\"button\" onclick='addItem()' id='addItem' class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"Add New Item\" >\n" +
                        "                <i class=\"material-icons\">add</i></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',10);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                            {{--                            @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });
        $("#itemgroup").click(function (e) {
            addSelected($("#itemgroup").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            // $("#procurementModal").addClass("modalSize")

            $('#loadScreen div.loader').show();
            e.preventDefault();
            $.get('{{route('items.groups.index')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#itemgroup").attr("data-nameeng"));
                    else
                        $("#title").html($("#itemgroup").attr("data-namear"))
                    $("#add").html("<button type=\"button\" onclick='addItemGroup()' id='addItemgroup' class=\"btn btn-primary btn-sm btn-round btn-fab\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"Add New Item Group\" >\n" +
                        "                <i class=\"material-icons\">add</i></a>\n" +
                        "            </span> </h4>");
                    // $('#table').DataTable().ajax.reload();
                    DataTableCall('#table',4);
                    $("#table_length").html("");
                    $("#table_filter").html("");
                            {{--                            @include('setting.c.city.location_script');--}}

                    var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                    table
                        .order( [0, 'desc' ] )
                        .draw();

                }else{

                }
            });

        });

        function addSelected(value){
            $(".mainli .nav-item").removeClass("selected-item");
            if(value==1){
                $("#brand").addClass("selected-item");

            }
            else  if(value==2){
                $("#unit").addClass("selected-item");


            }
            else  if(value==3){
                $("#sector").addClass("selected-item");

            }
            else  if(value==4){
                $("#service").addClass("selected-item");

            }
            else  if(value==5){
                $("#purchase").addClass("selected-item");

            }
            else  if(value==6){
                $("#item").addClass("selected-item");

            }
            else  if(value==7){
                $("#itemgroup").addClass("selected-item");

            }

        }
        function addBrand() {
            $.get('{{route('brands.create')}}',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        }
        function addUnit() {
            $.get('{{route('units.create')}}',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        }
        function addSector() {
            $.get('{{route('sectors.create')}}',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        }
        function addService() {
            $.get('{{route('services.create')}}',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        }
        function addPurchase() {
            $.get('{{route('purchasemethods.create')}}',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        }
        function addItem() {
            $('#loadScreen div.loader').show();
            $.get('{{route('items.create')}}',function(data){
                if(data.status==true) {
                    $("#render_result").html("");
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#loadScreen div.loader').hide();
                }
            });
        }
        function addItemGroup() {
            $('#loadScreen div.loader').show();
            $.get('{{route('item.groups.create')}}',function(data){
                if(data.status==true) {
                    $("#render_result").html("");
                    $("#render_result").html(data.html);
                    $('.selectpicker').selectpicker();
                    $('#loadScreen div.loader').hide();
                }
            });
        }
        $(document).on("click", ".editBrand", function (e) {
            var val=$(this).attr("data-id");
            $.get('{{url('brands')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        })
        $(document).on("click", ".editUnit", function (e) {
            var val=$(this).attr("data-id");
            $.get('{{url('units')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        })
        $(document).on("click", ".editSector", function (e) {
            var val=$(this).attr("data-id");
            $.get('{{url('sectors')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        })

        $(document).on("click", ".editService", function (e) {
            var val=$(this).attr("data-id");
            $.get('{{url('services')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        })
        $(document).on("click", ".editPurchase", function (e) {
            var val=$(this).attr("data-id");
            $.get('{{url('purchasemethods')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#procurementModalBody").html(data.html);
                    $('#procurementModal').modal({
                        show: true
                    });
                }
            });
        })
        $(document).on("click", ".editItem", function (e) {
            var val=$(this).attr("data-id");
            $.get('{{url('items')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#render_result").html(data.html);
                }
            });
        })
        $(document).on("click", ".editItemGroup", function (e) {
            var val=$(this).attr("data-id");
            $.get('{{url('item/groups')}}'+'/'+val+'/edit',function(data){
                if(data.status==true) {
                    $("#render_result").html(data.html);
                }
            });
        })
        function appendTable(data,count,id,cityname,citynamefo){
            var table = document.getElementById("table");
            var count1=count+1;
            var number = table.rows.length;
            // if($dd==1){
            Body = $("#table tbody");
            if(id==1){
                var url = '{{ route("brands.delete", ":id") }}';
                url = url.replace(':id', data.id);
                markup='<tr data-id='+data.id+'><td>'+count1 +'</td><td>'+data.brand_name+'</td><td> <button type="button" data-id='+data.id+'\n' +
                    '                     class="btn btn-sm btn-success btn-round btn-fab editBrand"  data-toggle="tooltip" data-placement="top"\n' +
                    '                       title="edit"\n' +
                    '                    >\n' +
                    '                        <i class="material-icons">edit</i>\n' +
                    '                    </button> <button type="button" href='+url+'\n' +
                    '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"\n' +
                    '                        data-placement="top"  title=" delete ">\n' +
                    '                    <i class="material-icons">delete</i>\n' +
                    '                </button>\n</td></tr>';}
            else if(id==2){
                var lang=@json($lang);
                var url = '{{ route("units.delete", ":id") }}';
                url = url.replace(':id', data.id);

                    markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.unit_name_na+'</td><td>'+data.unit_name_fo+'</td><td> <button type="button" data-id='+data.id+'\n' +
                        '                     class="btn btn-sm btn-success btn-round btn-fab editUnit"  data-toggle="tooltip" data-placement="top"\n' +
                        '                       title="edit"\n' +
                        '                    >\n' +
                        '                        <i class="material-icons">edit</i>\n' +
                        '                    </button> <button type="button" href='+url+'\n' +
                        '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteUnit"\n' +
                        '                        data-placement="top"  title=" delete ">\n' +
                        '                    <i class="material-icons">delete</i>\n' +
                        '                </button>\n</td></tr>';

            }
            else if(id==3){
                var lang=@json($lang);
                var url = '{{ route("sectors.delete", ":id") }}';
                url = url.replace(':id', data.id);
                    markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.sector_name_na+'</td><td>'+data.sector_name_fo+'</td><td> <button type="button" data-id='+data.id+'\n' +
                        '                     class="btn btn-sm btn-success btn-round btn-fab editSector"  data-toggle="tooltip" data-placement="top"\n' +
                        '                       title="edit"\n' +
                        '                    >\n' +
                        '                        <i class="material-icons">edit</i>\n' +
                        '                    </button> <button type="button" href='+url+'\n' +
                        '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteSector"\n' +
                        '                        data-placement="top"  title=" delete ">\n' +
                        '                    <i class="material-icons">delete</i>\n' +
                        '                </button>\n</td></tr>';
            }
            else if(id==4){
                var lang=@json($lang);
                var url = '{{ route("services.delete", ":id") }}';
                url = url.replace(':id', data.id);

                    markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.service_name_na+'</td><td>'+data.service_name_fo+'</td><td> <button type="button" data-id='+data.id+'\n' +
                        '                     class="btn btn-sm btn-success btn-round btn-fab editService"  data-toggle="tooltip" data-placement="top"\n' +
                        '                       title="edit"\n' +
                        '                    >\n' +
                        '                        <i class="material-icons">edit</i>\n' +
                        '                    </button> <button type="button" href='+url+'\n' +
                        '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteService"\n' +
                        '                        data-placement="top"  title=" delete ">\n' +
                        '                    <i class="material-icons">delete</i>\n' +
                        '                </button>\n</td></tr>';
            }
            else if(id==5){
                var lang=@json($lang);
                var url = '{{ route("purchasemethods.delete", ":id") }}';
                url = url.replace(':id', data.id);
                    markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.method_name_na+'</td><td>'+data.method_name_fo+'</td><td> <button type="button" data-id='+data.id+'\n' +
                        '                     class="btn btn-sm btn-success btn-round btn-fab editPurchase"  data-toggle="tooltip" data-placement="top"\n' +
                        '                       title="edit"\n' +
                        '                    >\n' +
                        '                        <i class="material-icons">edit</i>\n' +
                        '                    </button> <button type="button" href='+url+'\n' +
                        '                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteMethod"\n' +
                        '                        data-placement="top"  title=" delete ">\n' +
                        '                    <i class="material-icons">delete</i>\n' +
                        '                </button>\n</td></tr>';
            }

            $(markup).insertAfter("#table tr:first");
            $('#procurementModal').modal('hide');
            // }
        }
        function editRow(data,id,cityname,citynamefo){
            var lang=@json($lang);
            if(id==1){
                $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.brand_name);
               }
            else if(id==2){
                $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.unit_name_na);
                $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.unit_name_fo);
            }
            else if(id==3){
                $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.sector_name_na);
                $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.sector_name_fo);
            }
            else if(id==4){
                $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.service_name_na);
                $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.service_name_fo);
            }
            else if(id==5){
                $('tr[data-id='+data.id+']').find("td:eq(1)").text(data.method_name_na);
                $('tr[data-id='+data.id+']').find("td:eq(2)").text(data.method_name_fo);
            }
            $('#procurementModal').modal('hide');
        }
        $("#icon").change(function (){
            $(".def-icon-ic").css("display","none");
        });
        $("#photo").change(function (){
            $(".def-icon-photo").css("display","none");
        });
        $("#thumb").change(function (){
            $(".def-icon-thumb").css("display","none");
        });
        function showIndex(data){
            $('#index').attr("disabled", true);
            $('#index .loader').show();
            if(data==1){
                $.get('{{route('items.index')}}',function(data){
                    if(data.status==true){
                        $("#render_result").html(data.html);
                        DataTableCall('#table',10);
                        $("#table_length").html("");
                        $("#table_filter").html("");
                                {{--                            @include('setting.c.city.location_script');--}}

                        var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                        table
                            .order( [0, 'desc' ] )
                            .draw();

                    }else{

                    }
                });
            }
            else{
                $.get('{{route('items.groups.index')}}',function(data){
                    if(data.status==true){
                        $("#render_result").html(data.html);
                        DataTableCall('#table',4);
                        $("#table_length").html("");
                        $("#table_filter").html("");
                                {{--                            @include('setting.c.city.location_script');--}}

                        var table = $('#table').DataTable();

// Sort by columns 1 and 2 and redraw
                        table
                            .order( [0, 'desc' ] )
                            .draw();

                    }else{

                    }
                });
            }

        }
        $("#image_icon").change(function (){
            //  var fileName = $(this).val();
            // $(".filename").html(fileName);
            $(".def-icon").css("display","none");
        });
    </script>
@endsection
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








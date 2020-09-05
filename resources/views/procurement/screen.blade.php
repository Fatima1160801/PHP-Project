@extends('layouts._layout')
@section('css')
   @include('setting.settingsScreens.settings_style')
    <style>
        /*#table{*/
        /*    margin-left:8% !important;*/
        /*}*/
        .card .card-body .col-form-label{
            padding-left: 4% !important;
        }
        .brandModal{
            width:60%;
        }
        #unit_name_na{
            margin-left: -46px;
        }
        #unit_name_fo  {
            margin-left: -9px;
        }
        #sector_name_na{
            margin-left: -40px;
        }
        #sector_name_fo,#service_name_fo{
            margin-left: -8px;
        }
    </style>
@endsection
@section('content')


{{--    //New Design--}}
<div class="container col-md-12 ml-2">
    <div class="row mt-4" id="containerc">
        <div class="col-md-3 card p-3 mr-4">
            <ul class="navbar-nav mailli33">
                <li class="nav-item mb-3 selected-item" id="brand" data-nameeng="Brands" data-namear="العلامات التجارية" data-value="1">
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
        <div class="col-md-8 p-3 card"><div class="card-title" id="content">
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
        <div class="modal-content" id="brandModal">
            <div class="card card-signup card-plain">
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
        $(document).ready(function() {
            defaultVal();
        });
        $("#brand").click(function (e) {
            addSelected($("#brand").attr("data-value"));
            $("#add").html("");
            $("#title").html("");
            $("#render_result").html("");
            e.preventDefault();
            defaultVal();
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
                    $("#add").html("<a href=\"#\" onclick='addUnit()' id='addUnit' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Unit</span></a>\n" +
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
                    $("#add").html("<a type=\"#\" onclick='addSector()' id='addSector' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Sector</span></a>\n" +
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
                    $("#add").html("<a href=\"#\" onclick='addService()' id='addService' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Service</span></a>\n" +
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
                    $("#add").html("<a href=\"#\" onclick='addPurchase()' id='addPurchase' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Purchase</span></a>\n" +
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
                    $("#add").html("<a href=\"#\" onclick='addItem()' id='addItem' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Item</span></a>\n" +
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
                    $("#add").html("<a href=\"#\" onclick='addItemGroup()' id='addItemgroup' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Item Group</span></a>\n" +
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
            $(".mailli33 .nav-item").removeClass("selected-item");
            if(value==1){
                $("#brand").addClass("selected-item");

            }
            else  if(value==2){
                $("#unit").addClass("selected-item");
                $("#brandModal").removeClass("brandModal");

            }
            else  if(value==3){
                $("#sector").addClass("selected-item");
                $("#brandModal").removeClass("brandModal");
            }
            else  if(value==4){
                $("#service").addClass("selected-item");
                $("#brandModal").removeClass("brandModal");
            }
            else  if(value==5){
                $("#purchase").addClass("selected-item");
                $("#brandModal").removeClass("brandModal");

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
            // $('#loadScreen div.loader').show();
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
            // $('#loadScreen div.loader').show();
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
                markup='<tr data-id='+data.id+'><td>'+count1 +'</td><td>'+data.brand_name+'</td><td> <a href="#" data-id='+data.id+'\n' +
                    '                     class="mytooltip btn-setting-nav editBrand"  data-toggle="tooltip" data-placement="top"\n' +
                    '                       title=""\n' +
                    '                    >\n' +
                    '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                    '                    </a> <a href='+url+'\n' +
                    '                        rel="tooltip" class="mytooltip btn-setting-nav btnTypeDelete"\n' +
                    '                        data-placement="top"  title=" ">\n' +
                    '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                    '                </a>\n</td></tr>';}
            else if(id==2){
                var lang=@json($lang);
                var url = '{{ route("units.delete", ":id") }}';
                url = url.replace(':id', data.id);

                    markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.unit_name_na+'</td><td>'+data.unit_name_fo+'</td><td> <a href="#" data-id='+data.id+'\n' +
                        '                     class="mytooltip btn-setting-nav editUnit"  data-toggle="tooltip" data-placement="top"\n' +
                        '                       title="edit"\n' +
                        '                    >\n' +
                        '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                        '                    </a> <a  href='+url+'\n' +
                        '                        rel="tooltip" class="mytooltip btn-setting-nav btnTypeDeleteUnit"\n' +
                        '                        data-placement="top"  title=" ">\n' +
                        '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                        '                </a>\n</td></tr>';

            }
            else if(id==3){
                var lang=@json($lang);
                var url = '{{ route("sectors.delete", ":id") }}';
                url = url.replace(':id', data.id);
                    markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.sector_name_na+'</td><td>'+data.sector_name_fo+'</td><td> <a href="#" data-id='+data.id+'\n' +
                        '                     class=" mytooltip btn-setting-nav editSector"  data-toggle="tooltip" data-placement="top"\n' +
                        '                       title=""\n' +
                        '                    >\n' +
                        '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                        '                    </a> <a href='+url+'\n' +
                        '                        rel="tooltip" class="mytooltip btn-setting-nav btnTypeDeleteSector"\n' +
                        '                        data-placement="top"  title=" ">\n' +
                        '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                        '                </a>\n</td></tr>';
            }
            else if(id==4){
                var lang=@json($lang);
                var url = '{{ route("services.delete", ":id") }}';
                url = url.replace(':id', data.id);

                    markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.service_name_na+'</td><td>'+data.service_name_fo+'</td><td> <a data-id='+data.id+'\n' +
                        '                     class=" mytooltip btn-setting-nav editService"  data-toggle="tooltip" data-placement="top"\n' +
                        '                       title=""\n' +
                        '                    >\n' +
                        '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                        '                    </a> <a  href='+url+'\n' +
                        '                        rel="tooltip" class="mytooltip btn-setting-nav btnTypeDeleteService"\n' +
                        '                        data-placement="top"  title="">\n' +
                        '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
                        '                </a>\n</td></tr>';
            }
            else if(id==5){
                var lang=@json($lang);
                var url = '{{ route("purchasemethods.delete", ":id") }}';
                url = url.replace(':id', data.id);
                    markup='<tr data-id='+data.id+'><td>'+count1+'</td><td>'+data.method_name_na+'</td><td>'+data.method_name_fo+'</td><td> <a  data-id='+data.id+'\n' +
                        '                     class="mytooltip btn-setting-nav editPurchase"  data-toggle="tooltip" data-placement="top"\n' +
                        '                       title=""\n' +
                        '                    >\n' +
                        '                        <i class="material-icons">edit</i><span class="mytooltiptext">edit</span>\n' +
                        '                    </a> <a href='+url+'\n' +
                        '                        rel="tooltip" class="mytooltip btn-setting-nav btnTypeDeleteMethod"\n' +
                        '                        data-placement="top"  title=" ">\n' +
                        '                    <i class="material-icons">delete</i><span class="mytooltiptext">delete</span>\n' +
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
        function defaultVal(){
            $("#brand").addClass("selected-item");
            $("#unit").removeClass("selected-item");

            $("#sector").removeClass("selected-item");
            $("#service").removeClass("selected-item");
            $("#purchase").removeClass("selected-item");
            $("#item").removeClass("selected-item");
            $("#itemgroup").removeClass("selected-item");
            $("#brandModal").addClass("brandModal");
            $('#loadScreen div.loader').show();

            $.get('{{route('brands.index')}}',function(data){
                if(data.status==true){
                    $("#render_result").html(data.html);
                    $('#loadScreen div.loader').hide();
                    var lang=@json($lang);
                    if(lang==1)
                        $("#title").html($("#brand").attr("data-nameeng"));
                    else
                        $("#title").html($("#brand").attr("data-namear"))
                    $("#add").html("<a href=\"#\" onclick='addBrand()' id='addBrand' class=\"mytooltip btn-setting-nav add\"\n" +
                        "               data-toggle=\"tooltip\" data-placement=\"top\"\n" +
                        "               title=\"\" >\n" +
                        "                <i class=\"material-icons\">add</i><span class=\"mytooltiptext\">Add Brand</span></a>\n" +
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

        }
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








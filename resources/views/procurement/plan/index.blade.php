
@extends('layouts._layout')
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['addplan'] ?? 'Add Plan'}}
            </h4>
        </div>
        <div class="card-body ">
            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;  <button type="button" id="rejectBtn" onclick="removeCheckedProjectActivity()" data-toggle="modal" data-target="#opportunityApproveConfirmModal"  class="btn btn-rose  btn-sm ">
                {{$labels['select_project'] ?? 'select project'}}
            </button> &nbsp; &nbsp; &nbsp; <label class="form-control-sm" id="projectlabel"></label><br>
            &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp; &nbsp; &nbsp; &nbsp;  <button type="button" onclick="removeCheckedProjectActivity()" id="rejectBtn1" data-toggle="modal" data-target="#activityModal"  class="btn btn-primary  btn-sm ">
                {{$labels['select_activity'] ?? 'select activity'}}
            </button> &nbsp; &nbsp; &nbsp;<label class="form-control-sm" id="activitylabel"></label>
            <input type="hidden" value="0" name="checkForActivityNull" id="checkForActivityNull" >
            <div class="col-md-12" style="padding-right:+10em;"><div class="form-group has-default bmd-form-group">  &nbsp; &nbsp; &nbsp; <label class="form-control-sm" id="projectlabel"></label>&nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <label class="form-control-sm" id="activitylabel"></label></div></div>
            <div id="result-msg">
                            <hr>
                <input type="hidden" name="project_id" id="selectedproject" value="0">
                <input name="activity_id" type="hidden" id="selectedactivity" value="0">
                <form action="" method="post" id="formPlanCreate" novalidate="novalidate">
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
                    <input name="selectedcurrency" type="hidden" id="selectedcurrency" value="0">
                <input name="actStartDate"  id="actStartDate" type="hidden"value="0" >
                <input name="actEndDate"  id="actEndDate" type="hidden" value="0">
                    <div id="info"></div>
            <form class="col-md-12">
            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    <button btn="btnToggleDisabled" type="submit" id="btnAddvendor"
                            class="btn btn-next btn-rose pull-right btn-sm">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                    <button type="button" onclick="clearPlanScreen()"
                            class="btn btn-next btn-info pull-right btn-sm btnClear">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['clear'] ?? 'clear'}}
                    </button>
                </div>
            </div>
                <label><h6>{{$labels['project'] ?? 'Project:'}}</h6></label> &nbsp; &nbsp;&nbsp;<label id="projectname"></label><br/>
                <label><h6>{{$labels['activity'] ?? 'Activity:'}}</h6></label>&nbsp; &nbsp;&nbsp;<label id="activityname"></label><br/>
                <label><h6>{{$labels['location'] ?? 'Location:'}}</h6></label>&nbsp; &nbsp;&nbsp;<label id="location"></label><br/>
                <label><h6>{{$labels['governorate'] ?? 'governorate:'}}</h6></label>&nbsp; &nbsp;&nbsp;<label id="governorate"></label><br/>
                <label><h6>{{$labels['currency'] ?? 'Currency'}}</h6></label>&nbsp; &nbsp;&nbsp;<label id="currencyname"></label><br/>
                <div class="col-md-6 pull-right"><div id="load" class="pull-center"><div class="loader pull-center" style="display: none;width: 30px;
 height: 30px;"></div></div><button type="button" class="btn btn-sm btn-primary pull-right exportPdf"
                                          target="_blank" id="btnReportPdf" data-export="pdf" data-toggle="tooltip" data-placement="top" title="Export PDF">
                        <i class="material-icons" >print</i> PDF
                    </button>
                    <button type="button" data-export="excel" class="btn btn-sm btn-info pull-right exportExcel"
                       data-toggle="tooltip" data-placement="top" title="Export Excel " id="btnReportExcel">
                        <i class="material-icons">print</i> Excel
                    </button></div>
                <table id="plan" class="table" >
               <thead>
                    <tr>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['serial'] ?? 'Serials'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['item'] ?? 'Items'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['sector'] ?? 'Sectors'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['service'] ?? 'Services'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['itemgroup'] ?? 'Item Groups'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['budget'] ?? 'Budgets'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['start_date'] ?? 'Start Dates'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['delivery_date'] ?? 'Delivery Dates'}}</div></div></th>
                        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['purchaseway'] ?? 'Purchase Ways'}}</div></div></th>
                        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                {!! Form::close() !!}
                </form>
                </form>
    </div>
        <div class="modal fade" id="opportunityApproveConfirmModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="card card-signup card-plain">
                        <div  class="modal-header mt-3">
                            <h3 class="modal-title card-title" id="comments_modal_title">Search Project</h3>
                            <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class='row'>
                                        <div class=' col-md-12 ml-3'>
                                            <div class='form-group has-default bmd-form-group'>
                                                <input type='text'  value=''  class='form-control'  name='select' id='select'    required minLength='0' maxLength='100'   alt='Budget'   autocomplete='off'   ></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button  id="searchProject" onclick="searchProject()" class="btn btn-next btn-sm  mt-2 btn-rose" style="line-height: 23px;">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        {{$labels['search'] ?? 'search'}}
                                    </button>
                                </div>
                            </div>
                             <table id="projectInfo" class="table dataTable no-footer table-bordered">
                                <tbody>
                                @if(!empty($project_list))
                                    @foreach($project_list  as $index => $item)
                                        @if($index<10)
                                        <tr> <td style="padding: 10px !important;"><input  type=radio data-curr-name='{{$item->currency->currency_name_na}}'  name="projectid" value='{{$item->id}}'></td> <td ><p class="ml-2">{{$item->{'project_name_'.lang_character()} ?? ""}}</td></tr>
                                            @endif  @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <div class="card-footer ml-auto mr-auto">
                                    <div class="ml-auto mr-auto">
                                        <a data-dismiss="modal" aria-label="Close" id="modal-dismiss-f" href="#"  class="btn btn-sm btn-default">
                                            {{$labels['cancel'] ?? 'cancel'}}
                                        </a>
                                        <button  type="submit" onclick="addProjectName()" class="btn btn-next btn-sm btn-rose pull-right">
                                            <div class="loader pull-left" style="display: none;"></div>
                                            {{$labels['select'] ?? 'select'}}
                                        </button>
                                        <button type="submit" onclick="removeCheckedProjectActivity()" class="btn btn-next btn-sm btn-info pull-right">
                                            <div class="loader pull-left" style="display: none;"></div>
                                            {{$labels['clear'] ?? 'clear'}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div><!--from here-->
        <div class="modal fade" id="activityModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="card card-signup card-plain">
                        <div  class="modal-header mt-3">
                            <h3 class="modal-title card-title" id="comments_modal_title">Search Activity</h3>
                            <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class='row'>
                                        <div class=' col-md-12 ml-3'>
                                            <div class='form-group has-default bmd-form-group'>
                                                <input type='text'  value=''  class='form-control'  name='selectact' id='selectact'    required minLength='0' maxLength='100'   alt='Budget'   autocomplete='off'   ></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button id="searchAct" onclick="searchActivity()" class="btn btn-next btn-sm  mt-2 btn-rose" style="line-height: 23px;">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        {{$labels['search'] ?? 'search'}}
                                    </button>
                                </div>
                            </div>
                            <table id="activityInfo" class="table dataTable no-footer table-bordered">
                                <tbody>
                                @if(!empty($activity_list))
                                    @foreach($activity_list  as $index => $item)
                                        @if($index<10)
                                            <tr> <td style="padding: 10px !important;"><input type=radio  name="activityid" value='{{$item->id}}'></td> <td ><p class="ml-2">{{$item->{'activity_name_'.lang_character()} ?? ""}}</td></tr>
                                        @endif  @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <div class="card-footer ml-auto mr-auto">
                                    <div class="ml-auto mr-auto">
                                        <a data-dismiss="modal" aria-label="Close" id="modal-dismiss-f" href="#"  class="btn btn-sm btn-default">
                                            {{$labels['cancel'] ?? 'cancel'}}
                                        </a>
                                        <button type="submit" onclick="addActivityName()" class="btn btn-next btn-sm btn-rose pull-right">
                                            <div class="loader pull-left" style="display: none;"></div>
                                            {{$labels['select'] ?? 'select'}}
                                        </button>
                                        <button type="submit" onclick="removeCheckedProjectActivity()" class="btn btn-next btn-sm btn-info pull-right">
                                            <div class="loader pull-left" style="display: none;"></div>
                                            {{$labels['clear'] ?? 'clear'}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
        @section('script')
            <script>
                $(document).ready(function () {
                    datetimepicker();
                });
                $(document).on('submit', '#formPlanCreate', function (e) {
                    if (!is_valid_form($(this))) {
                        return false;
                    }
                    e.preventDefault();
                    var currency_name=$("#currency_id").val();
                    var form = new FormData($(this)[0]);
                    var project=$("#selectedproject").val();
                    var activity=$("#selectedactivity").val();
                    if($("#id").val()==0){
                    var url = '{{url('plans/store/')}}';
                    $.ajax({
                        url: url+'/'+project+'/'+activity,
                        data: form,
                        type: 'post',
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $('#btnAddvendor').attr("disabled", true);
                            $('#btnAddvendor div.loader').show();
                        },
                        success: function (data) {
                            $('#btnAddvendor').attr("disabled", false);
                            $('#btnAddvendor div.loader').hide();
                            if (data.status == true) {
                                appendTableObj(data.list,data.lang);
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                document.getElementById("formPlanCreate").reset();
                                $('.selectpicker').selectpicker('refresh');
                                $("#currency_id").val(currency_name);
                            } else {
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            }
                        },
                    });}
                    else{
                        var url = '{{url('plans/update/')}}';
                        $.ajax({
                             url: url+'/'+project+'/'+activity,
                            data: form,
                            type: 'post',
                            processData: false,
                            contentType: false,
                            beforeSend: function () {
                                $('#btnAddvendor').attr("disabled", true);
                                $('#btnAddvendor div.loader').show();
                            },
                            success: function (data) {
                                $('#btnAddvendor').attr("disabled", false);
                                $('#btnAddvendor div.loader').hide();
                                if (data.status == true) {
                                    $("#id").val(0);
                                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                    appendTableObj(data.list,data.lang);
                                    document.getElementById("formPlanCreate").reset();
                                    $('.selectpicker').selectpicker('refresh');
                                    $("#currency_id").val(currency_name);
                                }
                                else{
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            }
                            }
                });
                    }    });
            </script>
            <script>
                function searchProject(){
                    $('#searchProject').attr("disabled", true);
                    $('#searchProject div.loader').show();
                    var val=document.getElementById("select").value;
                    if(val!=0) {
                        $id = val;
                        $.get('{{url('/search')}}' + '/' + $id, function (data) {
                            if (data.status != false) {
                                tableBody = $("#projectInfo tbody");
                                tableBody.empty();
                                $.each(data.project, function (index, value) {
                                    if (data.id == 1) {
                                        markup = '<tr> <td style="padding: 10px !important;"><input type=radio data-curr-name="' + value.currency.currency_name_na + '" name="projectid" value=' + value.id + '></td> <td ><p class="ml-2">' + value.project_name_na + '</td></tr>';
                                    } else {
                                        markup = '<tr> <td style="padding: 10px !important;"><input type=radio data-curr-name="' + value.currency.currency_name_fo + '" name="projectid" value=' + value.id + '></td> <td ><p class="ml-2">' + value.project_name_fo + '</td></tr>';
                                    }
                                    tableBody.append(markup);
                                });
                                $('#searchProject div.loader').hide();
                                $('#searchProject').attr("disabled", false);
                            }
                        });
                    }
                    else{
                    $('#searchProject div.loader').hide();
                    $('#searchProject').attr("disabled", false);
                            }
                }
                function searchActivity(){
                    $('#searchAct').attr("disabled", true);
                    $('#searchAct div.loader').show();
                    var val=document.getElementById("selectact").value;
                    if(val!=0) {
                    $id=val;
                    $.get('{{url('/searchAct')}}'+'/'+$id,function(data) {
                        if (data.status != false) {
                            let rowNo = 0;
                            tableBody = $("#activityInfo tbody");
                            tableBody.empty();
                            $.each(data.activity, function (index, value) {
                                    if(data.id==1){
                                        markup = '<tr> <td style="padding: 10px !important;"><input type=radio  name="activityid" value='+value.id+'></td> <td ><p class="ml-2">'+value.activity_name_na+'</td></tr>';
                                    }
                                    else{
                                        markup = '<tr> <td style="padding: 10px !important;"><input type=radio  name="activityid" value='+value.id+'></td> <td ><p class="ml-2">'+value.activity_name_fo+'</td></tr>';
                                    }
                                    tableBody.append(markup);
                            });
                            $('#searchAct div.loader').hide();
                            $('#searchAct').attr("disabled", false);
                        }
                    });
                }
                    else{
                        $('#searchAct div.loader').hide();
                        $('#searchAct').attr("disabled", false);
                    }
                }
                function addProjectName() {
                    document.getElementById("formPlanCreate").reset();
                    $('.selectpicker').selectpicker('refresh');
                    $('#load div.loader').show();
                    var project_lists = @json($project_list);
                    var id =@json($id);
                    var ele = document.getElementsByName('projectid');
                    var project_id =$('input[name="projectid"]:checked').val();
                    var currency_name =$('input[name="projectid"]:checked').attr("data-curr-name");
                    document.getElementById("selectedproject").value=project_id;
                    $("#currency_id").val(currency_name);
                    $("#currencyname").html(currency_name);
                    tableBody = $("#activityproject tbody");
                    tableBody.empty();
                    $("#activitylabel").html("");
                    $.each(project_lists, function (index, value) {
                        if (project_lists[index].id == project_id) {
                            if (id == 1) {
                                $("#projectlabel").html(project_lists[index].project_name_na);
                                $("#projectname").html(project_lists[index].project_name_na);
                            } else{
                                $("#projectlabel").html(project_lists[index].project_name_fo);
                                $("#projectname").html(project_lists[index].project_name_fo);
                            }
                            document.getElementById("selectedcurrency").value
                                = project_lists[index].currency_id;
                        }
                    });
                    $("#opportunityApproveConfirmModal").modal('hide');
                    Body = $("#plan tbody");
                    Body.empty();
                    $id = project_id;
                    var totalRowCount = 1;
                    $.get('{{url('/projectPlan')}}' + '/' + $id, function (data) {
                        if (data.status != false) {
                            appendTableItem(data.plan,data.lang);
                        }
                        $('#load div.loader').hide();
                    });
                    $('input[name="activityid"]:checked').prop( "checked", false );
                    $('input[name="projectid"]:checked').prop( "checked", false );
                }
                function addActivityName(){
                    $("#checkForActivityNull").val(1);
                    $("#location").html("");
                    $("#governorate").html("");
                    $("#activitylabel").html("");
                   $ ("#activityname").html("");
                    $('#load div.loader').show();
                    var activity_lists = @json($activity_list);
                    var id=@json($id);
                    var ele = document.getElementsByName('activityid');
                    var activity_id =$('input[name="activityid"]:checked').val();
                   if(activity_id==null){
                       activity_id=0;
                }
                    document.getElementById("selectedactivity").value=activity_id;
                    $.each(activity_lists, function (index, value) {
                        if(activity_lists[index].id==activity_id) {
                            if (id==1){
                                $("#activitylabel").html(activity_lists[index].activity_name_na);
                                $("#activityname").html(activity_lists[index].activity_name_na);
                        }else{
                                $("#activitylabel").html(activity_lists[index].activity_name_fo);
                                $("#activityname").html(activity_lists[index].activity_name_fo);
                        }}
                    });
                    $("#activityModal").modal('hide');
                    Body = $("#plan tbody");
                    Body.empty();
                    $activity =activity_id;
$project= document.getElementById("selectedproject").value
                    $.get('{{url('/projectactivity')}}' + '/' + $project+'/' + $activity, function (data) {
                        if (data.status != false) {
                            appendTableItem(data.plan,data.lang);
                        }
                        $.each(data.state, function (index, value) {
                            $("#location").append(value.district_name_na+',');
                            $("#governorate").append(value.city_name_na+',');
                        });
                         $('#load div.loader').hide();
                    });
                    $('input[name="activityid"]:checked').prop( "checked", false );
                    $('input[name="projectid"]:checked').prop( "checked", false );
                }
                function datetimepicker() {
                    $('.datetimepicker').datetimepicker({
                        icons: {
                            time: "fa fa-clock-o",
                            date: "fa fa-calendar",
                            up: "fa fa-chevron-up",
                            down: "fa fa-chevron-down",
                            previous: 'fa fa-chevron-left',
                            next: 'fa fa-chevron-right',
                            today: 'fa fa-screenshot',
                            clear: 'fa fa-trash',
                            close: 'fa fa-remove'
                        },
                        format: 'DD/MM/YYYY'
                    });
                }
function removeCheckedProjectActivity(){
    $('input[name="activityid"]:checked').prop( "checked", false );
    $('input[name="projectid"]:checked').prop( "checked", false );
}
            </script>
            <script>
                $(document).on('click', '.btnTypeDeleteItem', function (e) {
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
                            url = $(this).attr('href');
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
                            $(document).on("click", ".editItem", function (e) {
                                // $("#start_date").attr('disabled',false);
                                // $("#delivery_date").attr('disabled',false);
                                  $("#item").val($(this).attr("data-rowitem"));
                              $("#sector_id").val($(this).attr("data-rowsectorid"));
                              $("#sector_id").selectpicker("refresh");
                                        $("#id").val($(this).attr("data-rowid"));
                                 $("#item_group_id").val($(this).attr("data-rowitemgroupid"));
                                 $("#item_group_id").selectpicker("refresh");
                                 $("#budget").val($(this).attr("data-rowbudget"));
                                 $("#start_date").val($(this).attr("data-rowsdate"));
                                $("#delivery_date").val($(this).attr("data-rowddate"));
                                 $("#purchase_method_id").val($(this).attr("data-rowpurchase"));
                                $("#purchase_method_id").selectpicker("refresh");
                                 $("#service_type_id").val($(this).attr("data-rowserviceid"));
                                $("#service_type_id").selectpicker("refresh");
                                $("#actStartDate").val($(this).attr("data-rowactsdate"))
                                $("#actEndDate").val($(this).attr("data-rowactedate"))
                                $(this).closest('tr').hide();
                            });
                            function appendTableItem(arr,lang){
                                Body = $("#plan tbody");
                                Body.empty();
                                var totalRowCount = 1;
                                for(var i = 0; i < arr.length; i++) {
                                    var url = '{{ route("plans.delete", ":id") }}';
                                    url = url.replace(':id', arr[i].id);
                                    var act_start='';
                                    var act_end='';
                                    if(arr[i].activity_dates !=undefined && arr[i].activity_dates !='' && arr[i].activity_dates !=null ) {
                                        if(arr[i].activity_dates.act_start_date !=undefined && arr[i].activity_dates.act_start_date !='' && arr[i].activity_dates.act_start_date !=null ){
                                            act_start= arr[i].activity_dates.act_start_date;
                                        }
                                        if( arr[i].activity_dates.act_end_date !=undefined && arr[i].activity_dates.act_end_date !='' && arr[i].activity_dates.act_end_date !=null ){
                                            act_end= arr[i].activity_dates.act_end_date;
                                        }
                                    }
                                    if(lang==1){
                                    if (arr[i].service != null && arr[i].itemgroup != null) {
                                        markup = '<tr> <td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].sector.sector_name_na + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].service.service_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].itemgroup.item_group_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].purchase.method_name_na + '</div></div></td><td>'+
                                            '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="'+arr[i].id+'" data-rowitem="'+arr[i].item+'" data-rowsectorid="'+arr[i].sector_id+'" data-rowserviceid="'+arr[i].service_type_id+'" data-rowitemgroupid="'+arr[i].item_group_id+'" data-rowbudget="'+arr[i].budget+'" data-rowsdate="'+arr[i].start_date+'" data-rowddate="'+arr[i].delivery_date+'" data-rowpurchase="'+arr[i].purchase_method_id+'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">' +                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td><td value=' + arr[i].sector_id + ' style="display:none;" class="id">' + arr[i].sector_id + '</td></tr>';
                                    } else if (arr[i].service != null && arr[i].itemgroup == null) {
                                        markup = '<tr> <td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].sector.sector_name_na + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].service.service_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].purchase.method_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="'+arr[i].id+'" data-rowitem="'+arr[i].item+'" data-rowsectorid="'+arr[i].sector_id+'" data-rowserviceid="'+arr[i].service_type_id+'" data-rowitemgroupid="'+arr[i].item_group_id+'" data-rowbudget="'+arr[i].budget+'" data-rowsdate="'+arr[i].start_date+'" data-rowddate="'+arr[i].delivery_date+'" data-rowpurchase="'+arr[i].purchase_method_id+'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                    } else if (arr[i].service == null && arr[i].itemgroup != null) {
                                        markup = '<tr> <td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].sector.sector_name_na + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].itemgroup.item_group_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].purchase.method_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="'+arr[i].id+'" data-rowitem="'+arr[i].item+'" data-rowsectorid="'+arr[i].sector_id+'" data-rowserviceid="'+arr[i].service_type_id+'" data-rowitemgroupid="'+arr[i].item_group_id+'" data-rowbudget="'+arr[i].budget+'" data-rowsdate="'+arr[i].start_date+'" data-rowddate="'+arr[i].delivery_date+'" data-rowpurchase="'+arr[i].purchase_method_id+'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                    } else {
                                        markup = '<tr> <td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].sector.sector_name_na + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].purchase.method_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="'+arr[i].id+'" data-rowitem="'+arr[i].item+'" data-rowsectorid="'+arr[i].sector_id+'" data-rowserviceid="'+arr[i].service_type_id+'" data-rowitemgroupid="'+arr[i].item_group_id+'" data-rowbudget="'+arr[i].budget+'" data-rowsdate="'+arr[i].start_date+'" data-rowddate="'+arr[i].delivery_date+'" data-rowpurchase="'+arr[i].purchase_method_id+'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                    }
                                    Body.append(markup);
                                    totalRowCount++;
                                }
                                     else{
                                        if (arr[i].service != null && arr[i].itemgroup != null) {
                                            markup = '<tr> <td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].sector.sector_name_fo + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].service.service_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].itemgroup.item_group_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].purchase.method_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="'+arr[i].id+'" data-rowitem="'+arr[i].item+'" data-rowsectorid="'+arr[i].sector_id+'" data-rowserviceid="'+arr[i].service_type_id+'" data-rowitemgroupid="'+arr[i].item_group_id+'" data-rowbudget="'+arr[i].budget+'" data-rowsdate="'+arr[i].start_date+'" data-rowddate="'+arr[i].delivery_date+'" data-rowpurchase="'+arr[i].purchase_method_id+'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                                '                                <i class="material-icons">edit</i>\n' +
                                                '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="'+url+'" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                                '                                <i class="material-icons">delete</i>\n' +
                                                '                            </button></div></div></td></tr>';
                                        } else if (arr[i].service != null && arr[i].itemgroup == null) {
                                            markup = '<tr><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].sector.sector_name_fo + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].service.service_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].purchase.method_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="'+arr[i].id+'" data-rowitem="'+arr[i].item+'" data-rowsectorid="'+arr[i].sector_id+'" data-rowserviceid="'+arr[i].service_type_id+'" data-rowitemgroupid="'+arr[i].item_group_id+'" data-rowbudget="'+arr[i].budget+'" data-rowsdate="'+arr[i].start_date+'" data-rowddate="'+arr[i].delivery_date+'" data-rowpurchase="'+arr[i].purchase_method_id+'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                                '                                <i class="material-icons">edit</i>\n' +
                                                '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="'+url+'" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                                '                                <i class="material-icons">delete</i>\n' +
                                                '                            </button></div></div></td></tr>';
                                        } else if (arr[i].service == null && arr[i].itemgroup != null) {
                                            markup = '<tr><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].sector.sector_name_fo + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].itemgroup.item_group_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].purchase.method_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="'+arr[i].id+'" data-rowitem="'+arr[i].item+'" data-rowsectorid="'+arr[i].sector_id+'" data-rowserviceid="'+arr[i].service_type_id+'" data-rowitemgroupid="'+arr[i].item_group_id+'" data-rowbudget="'+arr[i].budget+'" data-rowsdate="'+arr[i].start_date+'" data-rowddate="'+arr[i].delivery_date+'" data-rowpurchase="'+arr[i].purchase_method_id+'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                                '                                <i class="material-icons">edit</i>\n' +
                                                '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="'+url+'" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteIytem"  style="margin-bottom:+0.5em;">\n' +
                                                '                                <i class="material-icons">delete</i>\n' +
                                                '                            </button></div></div></td></tr>';
                                        } else {

                                            markup = '<tr> <td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].sector.sector_name_fo + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + arr[i].purchase.method_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="'+arr[i].id+'" data-rowitem="'+arr[i].item+'" data-rowsectorid="'+arr[i].sector_id+'" data-rowserviceid="'+arr[i].service_type_id+'" data-rowitemgroupid="'+arr[i].item_group_id+'" data-rowbudget="'+arr[i].budget+'" data-rowsdate="'+arr[i].start_date+'" data-rowddate="'+arr[i].delivery_date+'" data-rowpurchase="'+arr[i].purchase_method_id+'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                                '                                <i class="material-icons">edit</i>\n' +
                                                '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="'+url+'" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                                '                                <i class="material-icons">delete</i>\n' +
                                                '                            </button></div></div></td></tr>';
                                        }
                                        Body.append(markup);
                                        totalRowCount++;
                                    }
                                }
                            }
                            function appendTableObj(data,lang) {
                                var url = '{{ route("plans.delete", ":id") }}';
                                url = url.replace(':id', data.id);
                                var table = document.getElementById("plan");
                                var totalRowCount = table.rows.length;
                                tableBody = $("#plan tbody");
                                var act_start='';
                                var act_end='';
                                if(data.activity_dates !=undefined && data.activity_dates !='' && data.activity_dates !=null ) {
                                    if(data.activity_dates.act_start_date !=undefined && data.activity_dates.act_start_date !='' && data.activity_dates.act_start_date !=null ){
                                        act_start= data.activity_dates.act_start_date;
                                    }
                                    if( data.activity_dates.act_end_date !=undefined && data.activity_dates.act_end_date !='' && data.activity_dates.act_end_date !=null ){
                                        act_end= data.activity_dates.act_end_date;
                                    }
                                }
                                if (data.service != null && data.itemgroup != null) {
                                    if (lang == 1) {
                                        markup = '<tr> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.sector.sector_name_na + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.service.service_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.itemgroup.item_group_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.purchase.method_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="' + data.id + '" data-rowitem="' + data.item + '" data-rowsectorid="' + data.sector_id + '" data-rowserviceid="' + data.service_type_id + '" data-rowitemgroupid="' + data.item_group_id + '" data-rowbudget="' + data.budget + '" data-rowsdate="' + data.start_date + '" data-rowddate="' + data.delivery_date + '" data-rowpurchase="' + data.purchase_method_id +'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                        tableBody.append(markup);
                                    } //href="{{route("plans.delete",'+ data.list.id+')}}"
                                    else {
                                        markup = '<tr> <td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.sector.sector_name_fo + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.itemgroup.item_group_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.purchase.method_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="' + data.id + '" data-rowitem="' + data.item + '" data-rowsectorid="' + data.sector_id + '" data-rowserviceid="' + data.service_type_id + '" data-rowitemgroupid="' + data.item_group_id + '" data-rowbudget="' + data.budget + '" data-rowsdate="' + data.start_date + '" data-rowddate="' + data.delivery_date + '" data-rowpurchase="' + data.purchase_method_id +'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                        tableBody.append(markup);
                                    }
                                } else if (data.service != null && data.itemgroup == null) {
                                    if (lang == 1) {
                                        markup = '<tr><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.sector.sector_name_na + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.service.service_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.purchase.method_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="' + data.id + '" data-rowitem="' + data.item + '" data-rowsectorid="' + data.sector_id + '" data-rowserviceid="' + data.service_type_id + '" data-rowitemgroupid="' + data.item_group_id + '" data-rowbudget="' + data.budget + '" data-rowsdate="' + data.start_date + '" data-rowddate="' + data.delivery_date + '" data-rowpurchase="' + data.purchase_method_id +'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                        tableBody.append(markup);
                                    } else {
                                        markup = '<tr><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.sector.sector_name_fo + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.service.service_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.purchase.method_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="' + data.id + '" data-rowitem="' + data.item + '" data-rowsectorid="' + data.sector_id + '" data-rowserviceid="' + data.service_type_id + '" data-rowitemgroupid="' + data.item_group_id + '" data-rowbudget="' + data.budget + '" data-rowsdate="' + data.start_date + '" data-rowddate="' + data.delivery_date + '" data-rowpurchase="' + data.purchase_method_id +'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypedeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                        tableBody.append(markup);
                                    }
                                } else if (data.service == null && data.itemgroup != null) {
                                    if (lang == 1) {
                                        markup = '<tr><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.sector.sector_name_na + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.itemgroup.item_group_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.purchase.method_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="' + data.id + '" data-rowitem="' + data.item + '" data-rowsectorid="' + data.sector_id + '" data-rowserviceid="' + data.service_type_id + '" data-rowitemgroupid="' + data.item_group_id + '" data-rowbudget="' + data.budget + '" data-rowsdate="' + data.start_date + '" data-rowddate="' + data.delivery_date + '" data-rowpurchase="' + data.purchase_method_id +'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypedeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                        tableBody.append(markup);
                                    } else {
                                        markup = '<tr><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.sector.sector_name_fo + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.itemgroup.item_group_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.purchase.method_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="' + data.id + '" data-rowitem="' + data.item + '" data-rowsectorid="' + data.sector_id + '" data-rowserviceid="' + data.service_type_id + '" data-rowitemgroupid="' + data.item_group_id + '" data-rowbudget="' + data.budget + '" data-rowsdate="' + data.start_date + '" data-rowddate="' + data.delivery_date + '" data-rowpurchase="' + data.purchase_method_id +'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypedeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                        tableBody.append(markup);
                                    }
                                } else {
                                    if (lang == 1) {
                                        markup = '<tr><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.sector.sector_name_na + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.purchase.method_name_na + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="' + data.id + '" data-rowitem="' + data.item + '" data-rowsectorid="' + data.sector_id + '" data-rowserviceid="' + data.service_type_id + '" data-rowitemgroupid="' + data.item_group_id + '" data-rowbudget="' + data.budget + '" data-rowsdate="' + data.start_date + '" data-rowddate="' + data.delivery_date + '" data-rowpurchase="' + data.purchase_method_id +'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                        tableBody.append(markup);
                                    } else {
                                        markup = '<tr><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + totalRowCount + '</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.item + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.sector.sector_name_fo + '</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.budget + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.start_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.delivery_date + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">' + data.purchase.method_name_fo + '</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" data-rowid="' + data.id + '" data-rowitem="' + data.item + '" data-rowsectorid="' + data.sector_id + '" data-rowserviceid="' + data.service_type_id + '" data-rowitemgroupid="' + data.item_group_id + '" data-rowbudget="' + data.budget + '" data-rowsdate="' + data.start_date + '" data-rowddate="' + data.delivery_date + '" data-rowpurchase="' + data.purchase_method_id +'" data-rowactsdate="'+act_start+'"data-rowactedate="'+act_end+'" class="btn btn-sm btn-primary btn-round btn-fab editItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" href="' + url + '" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDeleteItem"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';
                                        tableBody.append(markup);
                                    }
                                }
                            }
                $(document).on("click", ".exportPdf", function (e) {
                    var act=0;
                    var project=0;
                    var pid=$("#selectedproject").val();
                    var aid=$("#selectedactivity").val();
                    var act=$("#checkForActivityNull").val();
                    window.location.href = '{{url('/plans/export/1')}}' + '/' + pid+ '/' + aid+ '/' + act ;
                });

                $(document).on("click", ".exportExcel", function (e) {
                    var act=0;
                    var project=0;
                    var pid=$("#selectedproject").val();
                    var aid=$("#selectedactivity").val();
                    var act=$("#checkForActivityNull").val();
                    window.location.href = '{{url('/plans/export/2')}}' + '/' + pid+ '/' + aid+ '/' + act;
                });
                $( "#sector_id" ).change(function() {
                    var sector = $('#sector_id').find(":selected").val();
                    getService(sector);
                    getItemGroup(sector);
                });
                function getService(sector) {
                    $("#service_type_id_loader").show();
                    var list1 ="<option selected  value=''></option>";
                    $id=sector;
                    $.get('{{url('/service/by/sector')}}'+'/'+$id,function(data){
                        $.each(data.list, function (index, value) {
                            list1+='<option value=' +index + '>' + value + '</option>';
                        });
                        $("#service_type_id").html(list1);
                        $("#service_type_id").selectpicker("refresh");
                        $("#service_type_id_loader").hide();
                    });
                }
                function getItemGroup(sector) {
                    $("#item_group_id_loader").show();
                    var list1 ="<option selected  value=''></option>";
                    $id=sector;
                    $.get('{{url('/itemgroup/by/sector')}}'+'/'+$id,function(data){
                        $.each(data.list, function (index, value) {
                            list1+='<option value=' +index + '>' + value + '</option>';
                        });
                        $("#item_group_id").html(list1);
                        $("#item_group_id").selectpicker("refresh");
                        $("#item_group_id_loader").hide();
                    });
                }
                function clearPlanScreen(){
                    document.getElementById("formPlanCreate").reset();
                    $('.selectpicker').selectpicker('refresh');
                    $("#activitylabel").html("");
                    $("#projectlabel").html("");
                    $("#selectedproject").val(0);
                    $("#selectedactivity").val(0);
                    $("#checkForActivityNull").val(0);
                    $("#actStartDate").val(0);
                    $("#actEndDate").val(0);
                    $ ("#activityname").html("");
                    $ ("#projectname").html("");
                    $ ("#currencyname").html("");
                    $ ("#location").html("");
                    $ ("#governorate").html("");
                    $("#plan tbody").empty();


                }
            </script>
                @endsection
            @section('js')
                <!-- Forms Validations Plugin -->
                <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
                <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
                <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
                <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

                <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
                <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
                <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
                <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
            @endsection

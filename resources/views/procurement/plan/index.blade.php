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

            &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;  <button type="button" id="rejectBtn" data-toggle="modal" data-target="#opportunityApproveConfirmModal"  class="btn btn-rose  btn-sm ">
                {{$labels['select_project'] ?? 'select project'}}
            </button> &nbsp; &nbsp; &nbsp; <label class="form-control-sm" id="projectlabel"></label><br>
            &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp; &nbsp; &nbsp; &nbsp;  <button type="button" id="rejectBtn1" data-toggle="modal" data-target="#activityModal"  class="btn btn-primary  btn-sm ">
                {{$labels['select_activity'] ?? 'select activity'}}
            </button> &nbsp; &nbsp; &nbsp;<label class="form-control-sm" id="activitylabel"></label>



            <div class="col-md-12" style="padding-right:+10em;"><div class="form-group has-default bmd-form-group">  &nbsp; &nbsp; &nbsp; <label class="form-control-sm" id="projectlabel"></label>&nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <label class="form-control-sm" id="activitylabel"></label></div></div>
            <div id="result-msg">

                            <hr>
                <input type="hidden" name="project_id" id="selectedproject" value="0">
                <input name="activity_id" type="hidden" id="selectedactivity" value="0">
                <form action="" method="post" id="formVendorCreate" novalidate="novalidate">
{{--                    {!! Form::open(['route' => '','novalidate'=>'novalidate','action'=>'post' ,'id'=>'formVendorCreate']) !!}--}}
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

                    <div id="info"></div>
{{--            <table id="plan" class="table" id="plans">--}}
{{--                <thead>--}}
{{--                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['serial'] ?? 'Serial'}}</div></div></th>--}}
{{--                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['item'] ?? 'Item'}}</div></div></th>--}}
{{--                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['budget'] ?? 'Budget'}}</div></div></th>--}}
{{--                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['purchaseway'] ?? 'Purchase Way'}}</div></div></th>--}}
{{--                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['servicetype'] ?? 'Service Type'}}</div></div></th>--}}
{{--                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['itemgroup'] ?? 'Item Group'}}</div></div></th>--}}
{{--                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['start date'] ?? 'Start Date'}}</div></div></th>--}}
{{--                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['deliverydate'] ?? 'Delivery Date'}}</div></div></th>--}}
{{--                <th></th>--}}
{{--                <th></th>--}}
{{--                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-success btn-round btn-fab" onclick="myFunction()" style="margin-bottom:+0.5em;">--}}
{{--                                <i class="material-icons">add</i>--}}
{{--                            </button></div></div></th>--}}
{{--                </thead>--}}
{{--                <tbody>--}}

{{--                </tbody>--}}
{{--            </table>--}}




            <form class="col-md-12">


            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    <a href="{{route('vendors.index')}}" class="btn btn-default btn-sm">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    <button btn="btnToggleDisabled" type="submit" id="btnAddvendor"
                            class="btn btn-next btn-rose pull-right btn-sm">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>

                </div>

            </div>
                <table id="plan" class="table" >
                    <thead>
                    <tr>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['serial'] ?? 'Serial'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['item'] ?? 'Item'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['sector'] ?? 'Sector'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['service'] ?? 'Service'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['itemgroup'] ?? 'Item Group'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['budget'] ?? 'Budget'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['start date'] ?? 'Start Date'}}</div></div></th>
                    <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['deliverydate'] ?? 'Delivery Date'}}</div></div></th>
                        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['purchaseway'] ?? 'Purchase Way'}}</div></div></th>

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
                                    <button onclick="myFunction()" class="btn btn-next btn-sm  mt-2 btn-rose" style="line-height: 23px;">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        {{$labels['search'] ?? 'search'}}
                                    </button>
                                </div>

                            </div>
                            <table id="projectInfo" class="table dataTable no-footer table-bordered">
                                <tbody>


                               </tbody>
                            </table>


                            <div class="col-md-12">
                                <div class="card-footer ml-auto mr-auto">
                                    <div class="ml-auto mr-auto">
                                        <a data-dismiss="modal" aria-label="Close" id="modal-dismiss-f" href="#"  class="btn btn-sm btn-default">
                                            {{$labels['cancel'] ?? 'cancel'}}
                                        </a>
                                        <button type="submit" onclick="addProjectName()" class="btn btn-next btn-sm btn-rose pull-right">
                                            <div class="loader pull-left" style="display: none;"></div>
                                            {{$labels['select'] ?? 'select'}}
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
                                    <button onclick="myFunction1()" class="btn btn-next btn-sm  mt-2 btn-rose" style="line-height: 23px;">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        {{$labels['search'] ?? 'search'}}
                                    </button>
                                </div>

                            </div>
                            <table id="activityInfo" class="table dataTable no-footer table-bordered">
                                <tbody>

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
                                    </div>
                                </div>
                            </div>


                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>






    </div><!--to here-->

@endsection
        @section('script')


            <script>

                $(document).ready(function () {
                    datetimepicker();
                });
                $(document).on('submit', '#formVendorCreate', function (e) {
                    if (!is_valid_form($(this))) {
                        return false;
                    }
                    e.preventDefault();
                    var form = new FormData($(this)[0]);
                    var url = '{{url('plans/store/')}}';
                    var project=$("#selectedproject").val();
                    var activity=$("#selectedactivity").val();
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
                               var table = document.getElementById("plan");
                                var totalRowCount = table.rows.length;


                                tableBody = $("#plan tbody");

                                if(data.service!=null && data.itemgroup!=null){
                                if(data.lang==1){
                                            markup = '<tr> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+totalRowCount+'</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.item+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.sector.sector_name_na+'</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.service.service_name_na+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.itemgroup.item_group_name_na+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.budget+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.start_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.delivery_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.purchase.method_name_na+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-primary btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                                '                                <i class="material-icons">edit</i>\n' +
                                                '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-danger btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                                '                                <i class="material-icons">delete</i>\n' +
                                                '                            </button></div></div></td></tr>';



                                        tableBody.append(markup);}
                                else{

                                    markup = '<tr> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+totalRowCount+'</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.item+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.sector.sector_name_fo+'</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.itemgroup.item_group_name_fo+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.budget+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.start_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.delivery_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.purchase.method_name_fo+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-primary btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                        '                                <i class="material-icons">edit</i>\n' +
                                        '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-danger btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                        '                                <i class="material-icons">delete</i>\n' +
                                        '                            </button></div></div></td></tr>';



                                    tableBody.append(markup);}

                              /*  });*/

                            }
                                else if(data.service!=null && data.itemgroup==null){
                                    if(data.lang==1){
                                        markup = '<tr> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+totalRowCount+'</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.item+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.sector.sector_name_na+'</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.service.service_name_na+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.budget+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.start_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.delivery_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.purchase.method_name_na+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-primary btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-danger btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';



                                        tableBody.append(markup);}
                                    else{

                                        markup = '<tr> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+totalRowCount+'</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.item+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.sector.sector_name_fo+'</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.service.service_name_fo+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.budget+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.start_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.delivery_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.purchase.method_name_fo+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-primary btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-danger btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';



                                        tableBody.append(markup);}

                                    /*  });*/

                                }
                                else if(data.service==null && data.itemgroup!=null){
                                    if(data.lang==1){
                                        markup = '<tr> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+totalRowCount+'</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.item+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.sector.sector_name_na+'</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.itemgroup.item_group_name_na+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.budget+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.start_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.delivery_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.purchase.method_name_na+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-primary btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-danger btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';



                                        tableBody.append(markup);}
                                    else{

                                        markup = '<tr> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+totalRowCount+'</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.item+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.sector.sector_name_fo+'</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.itemgroup.item_group_name_fo+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.budget+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.start_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.delivery_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.purchase.method_name_fo+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-primary btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-danger btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';



                                        tableBody.append(markup);}

                                    /*  });*/

                                }
                                else{

                                    if(data.lang==1){
                                        markup = '<tr> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+totalRowCount+'</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.item+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.sector.sector_name_na+'</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.budget+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.start_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.delivery_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.purchase.method_name_na+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-primary btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-danger btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';



                                        tableBody.append(markup);}
                                    else{

                                        markup = '<tr> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+totalRowCount+'</div></div></td> <td ><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.item+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.sector.sector_name_fo+'</di></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.budget+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.start_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.list.delivery_date+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group">'+data.purchase.method_name_fo+'</div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-primary btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">edit</i>\n' +
                                            '                            </button></div></div></td><td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-danger btn-round btn-fab"  style="margin-bottom:+0.5em;">\n' +
                                            '                                <i class="material-icons">delete</i>\n' +
                                            '                            </button></div></div></td></tr>';



                                        tableBody.append(markup);}

                                    /*  });*/

                            }

                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                document.getElementById("formVendorCreate").reset();
                                $('.selectpicker').selectpicker('render');




                            } else {
                                myNotify('warning', 'warning', 'warning', '5000', data.message);
                               // myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            }
                        },
                    });
                });
            </script>
            <script>
                function myFunction(){
                    var val=document.getElementById("select").value;
                    $id=val;

                   $.get('{{url('/search')}}'+'/'+$id,function(data) {
                       if (data.status != 'false') {
                           let rowNo = 0;
                           //     $('#projectInfo').empty();
                           //     $('#projectInfo').html(data.project);
                           tableBody = $("#projectInfo tbody");
                           tableBody.empty();






                           $.each(data.project, function (index, value) {
                               if(rowNo<10){
                                   if(data.id==1){
                               markup = '<tr> <td style="padding: 10px !important;"><input type=radio  name="projectid" value='+data.project[index].id+'></td> <td ><p class="ml-2">'+data.project[index].project_name_na+'</td></tr>';
                               }
                                   else{
                                       markup = '<tr> <td style="padding: 10px !important;"><input type=radio  name="projectid" value='+data.project[index].id+'></td> <td ><p class="ml-2">'+data.project[index].project_name_fo+'</td></tr>';

                                   }


                                           tableBody.append(markup);
                                           rowNo++;}
                                            });
                                   }


                               });
                            }


                function myFunction1(){
                    var val=document.getElementById("selectact").value;
                    $id=val;

                    $.get('{{url('/searchAct')}}'+'/'+$id,function(data) {
                        if (data.status != 'false') {
                            let rowNo = 0;
                            tableBody = $("#activityInfo tbody");
                            tableBody.empty();






                            $.each(data.activity, function (index, value) {
                                if(rowNo<10){
                                    if(data.id==1){
                                        markup = '<tr> <td style="padding: 10px !important;"><input type=radio  name="activityid" value='+data.activity[index].id+'></td> <td ><p class="ml-2">'+data.activity[index].activity_name_na+'</td></tr>';
                                    }
                                    else{
                                        markup = '<tr> <td style="padding: 10px !important;"><input type=radio  name="activityid" value='+data.activity[index].id+'></td> <td ><p class="ml-2">'+data.activity[index].activity_name_fo+'</td></tr>';

                                    }


                                    tableBody.append(markup);
                                    rowNo++;}
                            });
                        }


                    });
                }



                function addProjectName(){
                                var project_lists = @json($project_list);
                                var id=@json($id);
                                var ele = document.getElementsByName('projectid');
                                var ele1=0;

                                for(var i = 0; i < ele.length; i++) {
                                    if(ele[i].checked){
                                        document.getElementById("selectedproject").value
                                            = ele[i].value;

                                        ele1=ele[i].value;
                                }

                                }

                    tableBody = $("#activityproject tbody");
                    tableBody.empty();
                                $.each(project_lists, function (index, value) {
                                    if(project_lists[index].id==ele1) {
                                        if (id==1){


                                        $("#projectlabel").html(project_lists[index].project_name_na);

                                    }else

                                       $("#projectlabel").html(project_lists[index].project_name_fo);

                                        document.getElementById("selectedcurrency").value
                                            = project_lists[index].currency_id;
                                        //document.getElementById("currency_id").innerHTML=project_lists[index].currency.currency_name
                                }
                                });

                               $("#opportunityApproveConfirmModal").modal('hide');
                    tableBody = $("#plan tbody");
                      tableBody.empty();

                            }


                function addActivityName(){
                    var activity_lists = @json($activity_list);
                    var id=@json($id);
                    var ele = document.getElementsByName('activityid');
                    var ele1=0;

                    for(var i = 0; i < ele.length; i++) {
                        if(ele[i].checked){
                            document.getElementById("selectedactivity").value
                                = ele[i].value;

                            ele1=ele[i].value;
                        }
                    }
                    $.each(activity_lists, function (index, value) {
                        if(activity_lists[index].id==ele1) {
                            if (id==1)

                                $("#activitylabel").html(activity_lists[index].activity_name_na);
                            else
                                $("#activitylabel").html(activity_lists[index].activity_name_fo);
                        }
                    });
                    $("#activityModal").modal('hide');
                    tableBody = $("#plan tbody");
                      tableBody.empty();
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

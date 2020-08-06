
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
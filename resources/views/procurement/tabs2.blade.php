{{--<html>--}}
{{--<head>--}}
{{--   --}}
@extends('procurement.layout')
@section("css")
    <style>
        .modal-dialog .modal-header .close {
            position: unset;
        }
        .modal-dialog .modal-content .card-signup .modal-header {
            padding-top: 10px;
        }
    </style>
@endsection
@section('content')
    <style>
    .sidebar{
        width: 130px !important;
    }
    .sidebar-wrapper{
        width: 130px !important;
    }
    .sidebar-background:after {
        /*background: #04365f !important;*/
        background: #22263d !important;
        opacity: 1;

    }
    .sidebar-background {
        background-image:none !important;
    }
    .navbar-dark{
        box-shadow: none !important;
    }
    .main-panel {
        width: calc(100% - 140px);
    }
    .card .card-header{
        z-index: 0 !important;
    }
    .sidebar .logo:after{
        display: none !important;
    }
    .sidebar-wrapper .ps-scrollbar-y{
        top: 0px !important;
        height: 0px !important;
    }
    .mainli .dropdown-menu .dropdown-item{
        margin: 0px !important;
        padding: 10px !important;
    }
    .mainli .dropdown-menu .dropdown-item a{
        margin: auto;
    }
    .title-content-sp{
        /*margin: auto !important;*/
    }
    .main-a-tag:active,.main-a-tag:focus,.main-a-tag:visited{/*.main-a-tag:hover**/
        /*background: #5d76a8;*/
    }

    .mainli .dropdown-menu a:active,.mainli .dropdown-menu a:focus,.mainli .dropdown-menu a:visited,.mainli .dropdown-menu a:hover{/*.main-a-tag:hover**/
        /*background: #5d76a8 !important;*/
    }
    .mainli:active,.mainli:focus,.mainli:visited,.mainli:hover{/*.main-a-tag:hover**/
        background: #5d76a8 !important;
    }

    .proposal-writing{
        margin-top: -8px !important;
        padding-top: 0px !important;
    }
    .submenu a{
        font-size: 12px !important;
    }
    .ps-container{
        overflow: initial !important;
    }
    .mainli a{
        font-size: 14px !important;
    }
    .mainli{
        margin-top: 5px;
        margin-bottom: 5px;
        background: #1d344a;
        border-radius: 10px;
        height: 100px;
        min-height: 100px;
        max-height: 100px;
    }
    .main-a-tag i{
        font-size: 24px !important;
        margin-bottom: 10px;
    }
    .modern-menu{
        margin-left: 5%;
    }
    .main-a-tag{
        margin-top: 10px !important;
    }
    .submenu{
        left: 124px !important;
        position: absolute !important;
        top: 0px !important;
    }
    .ps-scrollbar-y-rail{
        height: auto !important;
    }
    .navbar .collapse .navbar-nav .nav-item .nav-link{
        margin-left: 0px !important;
    }
    #navigation-example{
        border-bottom: 1px solid #d2d2d2 !important;
    }
    .ps-scrollbar-x-rail {
        width: auto !important;
        overflow-x: hidden !important;
    }
    .selectedmenu{background: #5d76a8 !important;
    }
    </style>
{{--</head>--}}
{{--<body>--}}


{{--    <div class="col-md-12 col-12 mr-auto ml-auto">--}}
{{--        <div class="card card-wizard" data-color="rose" id="createTaskWizard">--}}
{{--            <div class="card-header text-center">--}}
{{--                <h3 class="card-title">--}}
{{--                    {{$labels['concept_title'] ?? 'Concept'}}--}}
{{--                </h3>--}}
{{--                <h5 class="card-description"></h5>--}}
{{--            </div>--}}
{{--            <div class="wizard-navigation">--}}
<div class="sidebar" data-color="rose" data-background-color="black"
     data-image="{{asset('/assets/img/sidebar-1.jpg')}}" style="top: 70px;">
    <div class="sidebar-wrapper">

        <div class="">
            <nav class="navbar  navbar-dark" style="width:100%;background: transparent !important;">
                <button hidden class="navbar-toggler" type="button" aria-expanded="true" data-toggle="collapse" data-target="#main_nav">

                </button>
                <div class="collapse navbar-collapse show" id="main_nav" style="width:100%;background: transparent !important;">

                    <ul class="navbar-nav container modern-menu" style="width:100%;background: transparent !important;" >
                        <li  class="nav-item mainli"><div style="padding-top:1em">
                                <div class="card-icon"><i class="material-icons">storage</i></div></div> <a  class="nav-link active" id="tabno1" href="#main_info" data-toggle="tab" role="tab">
                                {{$labels['concept_label'] ?? 'Information'}}
                            </a> </li>
                        <li  class="nav-item mainli"><div style="padding-top:1em">
                                <div class="card-icon"><i class="material-icons">group_work</i></div></div> <a class="nav-link" id="tabno2" href="#concept_tab" data-toggle="tab" role="tab">
                                {{$labels['concept_title'] ?? 'Concept'}}
                            </a> </li>
                        <li  class="nav-item mainli"> <div style="padding-top:1em">
                                <div class="card-icon"><i class="material-icons">line_weight</i></div></div><a class="nav-link" id="tabno3" href="#comments" data-toggle="tab" role="tab">
                                {{$labels['notes_label'] ?? 'Notes'}}
                            </a> </li>
                        <li  class="nav-item mainli"> <div style="padding-top:1em">
                                <div class="card-icon"><i class="material-icons">weekend</i></div></div><a class="nav-link" id="tabno4" href="#feedback" data-toggle="tab" role="tab">
                                {{$labels['feed_back_label'] ?? 'Donor Feedback'}}
                            </a> </li>
                        <li  class="nav-item mainli"><div style="padding-top:1em">
                                <div class="card-icon"><i class="material-icons">payment</i></div></div>  <a class="nav-link" id="tabno5" href="#log_hour" data-toggle="tab" role="tab">
                                {{$labels['attachments'] ?? 'attachments'}}
                            </a> </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
    </div>
    <div class="card-body">

        <div align="center" id="loader-icon-new" class="col-md-12">
            <div style="display: none;" class="loader loader-div"></div>
        </div>

        <div class="tab-content">
            <div class="tab-pane active" id="main_info">
                <div id="task_main_info">
                    @if($p=="edit")
                        {!! Form::open(['route' => 'vendors.update' ,'action'=>'post' ,'id'=>'formOpportinunityCreate']) !!}
                    @else
                        {!! Form::open(['route' => 'vendors.store' ,'action'=>'post' ,'id'=>'formOpportinunityCreate']) !!}
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{--                            <div class="col-md-6 opp-progress-status" style="display: none;">--}}
                    {{--                                <h6 style="text-transform: capitalize;font-weight: bold;">{{$labels['opp_status_label'] ?? 'Status'}} : <span style="text-transform: capitalize;font-weight:normal;" id="progress-stage">In progress</span></h6>--}}
                    {{--                                <h6 style="text-transform: capitalize;font-weight: bold;">{{$labels['opp_createdby_label'] ?? 'Created By'}} : <span id="progress-by" style="text-transform: capitalize;font-weight: normal;">{{Auth::user()->user_full_name ?? ""}}</span></h6>--}}

                    {{--                            </div>--}}

                    <div class="col-md-12 opp-progress-approve-reject" id="fill-opp-progress-approve-reject">
                        <div class="col-md-6 pull-left">
                            <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">{{$labels['opp_status_label'] ?? 'Status'}} : <span style="text-transform: capitalize;font-weight:normal;color:red;" id="title-app-rej">@if($p=="edit") hh@else @endif</span></h6>
                            @if($c !=1)
                                <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">{{$labels['opp_by_label'] ?? 'By'}} : <span id="title-app-rej-by" style="text-transform: capitalize;font-weight: normal;color:green;"></span></h6>
                            @endif
                            <h6 style="text-transform: capitalize;font-weight: bold;" class="pull-left mr-5">{{$labels['opp_date_label'] ?? 'Date'}} : <span id="title-app-rej-date" style="text-transform: capitalize;font-weight: normal;color:yellow;"></span></h6>
                        </div>
                        <div class="col-md-6 pull-right">
                            <div class="pull-left col-md-4">
                                <h6 style="text-transform: capitalize;font-weight: bold;" >{{$labels['opp_createdby_label'] ?? 'Created By'}} : <span id="title-create-by" style="text-transform: capitalize;font-weight: normal;">@if($p=="edit") kk@else @endif</span></h6>
                            </div>
                            <div class="pull-left col-md-8">
                                @if($c !=0)
                                    <a href="{{route('vendors.update',$c ?? 0)}}" style="font-size: 12px;color: #3F51B5;" class="pull-left col-md-6" id=""><div class="ripple-container"></div><i class="material-icons">link</i>Opportunity No : 0</a>
                                @endif
                                @if($c !=0)
                                    <a href="{{route('vendors.update',$c ?? 0)}}" style="font-size: 12px;color: #3F51B5;" class="pull-left col-md-6" id=""><div class="ripple-container"></div><i class="material-icons">link</i>Proposal No : 0</a>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                    {{--                            {!! $html !!}--}}

                    <input type="hidden" value="@if($p=="edit"){{$email_list??""}} @else @endif" name="follower_email" id="follower_email">
                    <input id="fixed_status_val" type="hidden" value="@if($p=="edit") 2 @else 1 @endif" />

                    <input type="hidden" name="arr_members" id="arr_members" value="">
                    <input type="hidden" name="arr_jobs" id="arr_jobs" value="">

                    <div class="col-md-12">
                        <div class="card-footer ml-auto mr-auto">
                            <div class="col-md-1"></div>
                            <div class="col-md-10" >
                                <table id="table" class="drawTable table"><thead><tr><th style="width: 40%">{{$labels['team_members'] ?? 'Team Members'}}</th><th style="width: 40%">{{$labels['job_title'] ?? 'Job Title'}}</th><th style="width: 20%">{{$labels['actions'] ?? 'actions'}}</th></tr></thead><tbody class="appendRows">
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-12">
                        <input type="hidden" id="activity_start_date" value="">
                        <a href="#" class="btn btn-next btn-rose pull-right btn-sm" id="nextProjectMain">
                            {{$labels['next'] ?? 'next'}}
                        </a>

                        {{--<button type="button" id="rejectBtn" data-toggle="modal" data-target="#opportunityApproveConfirmModal"  class="btn btn-danger  btn-sm pull-right">--}}
                        {{--{{$labels['opportunity_reject'] ?? 'Reject'}}--}}

                        {{--<div class="pull-left" style="display: none;"></div>--}}
                        {{--</button>--}}

                        {{--<a href="#" id="cancelRejectBtn" class="btn btn-danger  btn-sm pull-right">--}}
                        {{--{{$labels['opportunity_cancel_reject'] ?? 'Cancel reject'}}--}}

                        {{--<div class="pull-left" style="display: none;"></div>--}}
                        {{--</a>--}}

                        <button type="button" data-toggle="modal" data-target="#opportunityApproveConfirmModal" id="approveBtn" class="btn btn-success  btn-sm pull-right">
                            {{$labels['confirm_label'] ?? 'Confirm'}}

                            <div class="pull-left" style="display: none;"></div>
                        </button>

                        <button href="#"  id="cancelApproveBtn"  class="btn btn-success  btn-sm pull-right">
                            {{$labels['cancel_confirm_label'] ?? 'Cancel confirm'}}

                            <div class="pull-left" style="display: none;"></div>
                        </button>

                        <button href="#"  id="deleteApporBtn"  class="btn btn-danger  btn-sm pull-right">
                            {{$labels['opportunity_delete'] ?? 'Delete'}}
                            <div class="pull-left" style="display: none;"></div>
                        </button>

                        <button type="submit" id="saveTaskbtn" class="btn btn-primary  btn-sm pull-right">
                            {{$labels['save'] ?? 'save'}}

                            <div class="loader pull-left" style="display: none;"></div>
                        </button>

                        <span id="display-opp-link"></span>
                        <span id="display-reference-link"></span>

                        <a href="{{route('vendors.index')}}" class="btn btn-sm btn-default pull-left"
                           id="nextProjectMain2">
                            {{$labels['back'] ?? 'back'}}
                            <div class="ripple-container"></div>
                        </a>

                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
            <div class="tab-pane" id="assigned_to">
                <div id="assigned_to_content">
                    <div align="center" id="loader-icon-a" class="col-md-12">
                        <div class="loader loader-div"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="concept_tab">
                <div id="attachments_fixed_div_main"></div>
                <div align="center" id="loader-icon-c" class="col-md-12">
                    <div class="loader loader-div"></div>
                </div>
            </div>




            <div class="tab-pane" id="comments">
                <div id="comments_content">
                    <div align="center" id="loader-icon-c" class="col-md-12">
                        <div class="loader loader-div"></div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="feedback">
                <div id="feedback_content">
                    <div align="center" id="loader-icon-c" class="col-md-12">
                        <div class="loader loader-div"></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="log_hour">



                <input type="hidden" id="object_primary_id" value="{{$c}}">

                <div id="attachments_fixed_div"></div>
                <div id="attachments_not_fixed_div"></div>
                <div align="center" id="loader-icon-c" class="col-md-12">
                    <div class="loader loader-div"></div>
                </div>


            </div>


            {{--<div class="tab-pane" id="attachments">--}}
            {{--<input type="hidden" id="object_primary_id" value="">--}}
            {{--<!-- <div align="center" id="loader-icon" class="col-md-12"> <div class="loader loader-div">  </div></div> -->--}}
            {{--<div id="files-content">--}}

            {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>
    <div class="card-footer">
        <div class="mr-auto">

        </div>
        <a href="{{route('vendors.store')}}" class="btn btn-finish btn-fill btn-rose btn-wd"
           style="display: none;color: white;" >finish</a>

        <div class="clearfix"></div>
    </div>
    <div class="modal fade" id="opportunityApproveConfirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="card card-signup card-plain">
                    <div class="modal-header">
                        <h5 class="modal-title card-title" id="comments_modal_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">clear</i>
                        </button>
                    </div>
                    <div class="modal-body">

                        {!! Form::open(['route' => 'vendors.store' ,'action'=>'post' ,'id'=>'formOppStatusChange']) !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h3 class="text-center p-2 bolder" id="approved_reject_title"></h3>

                        <div class="col-md-12">
                            <label for="edit_note" class="col-form-label bolder">Date :</label>
                            <label for="edit_note" class="col-form-label">{{\Carbon\Carbon::now()->format('d/m/Y')}} , {{\Carbon\Carbon::now()->format('H:i')}}</label>
                        </div>
                        <div class="col-md-12">
                            <label for='edit_note' class='col-form-label bolder'>Note</label>
                            <div class='form-group has-default bmd-form-group'>
                                <textarea class='form-control'  name='note' id='approved_reject_note' ></textarea>
                                <input type="hidden" value="" name="type" id="approved_reject_type">
                                <input type="hidden" value="" name="opp_id" id="approved_reject_opp_id">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="card-footer ml-auto mr-auto">
                                <div class="ml-auto mr-auto">
                                    <a data-dismiss="modal" aria-label="Close" data-dismiss="modal" aria-label="Close" id="modal-dismiss-f" href="#" class="btn btn-sm btn-default">
                                        {{$labels['cancel'] ?? 'cancel'}}
                                    </a>
                                    <button type="submit" class="btn btn-next btn-sm btn-rose pull-right">
                                        <div class="loader pull-left" style="display: none;"></div>
                                        {{$labels['save'] ?? 'save'}}
                                    </button>
                                </div>
                            </div>
                        </div>


                        {!! Form::close() !!}

                    </div>
                </div>
            </div>


{{--        </div>--}}
{{--        </div>--}}
{{--    </div>--}}


                @endsection
{{--</body>--}}
{{--</html>--}}
@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>


@endsection
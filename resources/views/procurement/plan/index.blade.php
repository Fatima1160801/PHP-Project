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

            &nbsp; &nbsp; &nbsp; &nbsp;   <button type="button" id="rejectBtn" data-toggle="modal" data-target="#opportunityApproveConfirmModal"  class="btn btn-rose  btn-sm ">
                {{$labels['select_project'] ?? 'select project'}}
            </button>
            &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp; &nbsp; &nbsp; &nbsp;  <button type="button" id="rejectBtn1" data-toggle="modal" data-target="#activityModal"  class="btn btn-primary  btn-sm ">
                {{$labels['select_activity'] ?? 'select activity'}}
            </button>
<br>
{{--            <div class="col-md-12" style="padding-right:+10em;"><div class="form-group has-default bmd-form-group">  <input type="text" class="form-control-sm">&nbsp; &nbsp; &nbsp; &nbsp;--}}
{{--                     <input type="text" class="form-control-sm"></div></div>--}}
            <div id="result-msg">
{{--            <div class="col-md-12" style="padding-right:+10em;"><div class="form-group has-default bmd-form-group"> <select  class="selectpicker " name="project" id="project"><option value="">Project Name</option>--}}
{{--                        @if(!empty($project_list))--}}

{{--                            @foreach($project_list  as $item)--}}
{{--                               <option value="{{$item->id}}" >{{$item->project_name_na ?? ""}}</option>--}}

{{--                                              @endforeach--}}


{{--                    @endif--}}
{{--                    </select>--}}
{{--                    &nbsp; &nbsp; &nbsp; &nbsp;--}}
{{--                    @if(!empty($activity_list))--}}
{{--                 <select  class="selectpicker " name="activity" id="activity"><option value="">Activity Name</option>--}}
{{--                            @foreach($activity_list  as $item)--}}
{{--                                <option  value="{{$item->id}}" >{{$item->{'activity_name_'.lang_character()} ?? "" }}</option>--}}

{{--                            @endforeach--}}

{{--                        </select></div></div>--}}
{{--                            @endif--}}
                            <hr>

                    {!! Form::open(['route' => 'vendors.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formVendorCreate']) !!}
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
            <div id="info"></div>
            <table class="table" id="plans">
                <thead>
                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['serial'] ?? 'Serial'}}</div></div></th>
                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['item'] ?? 'Item'}}</div></div></th>
                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['type'] ?? 'Type'}}</div></div></th>
                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['budget'] ?? 'Budget'}}</div></div></th>
                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['purchaseway'] ?? 'Purchase Way'}}</div></div></th>
                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['servicetype'] ?? 'Service Type'}}</div></div></th>
                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['itemgroup'] ?? 'Item Group'}}</div></div></th>
                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['start date'] ?? 'Start Date'}}</div></div></th>
                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['deliverydate'] ?? 'Delivery Date'}}</div></div></th>
                <th></th>
                <th></th>
                <th><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-success btn-round btn-fab" onclick="myFunction()" style="margin-bottom:+0.5em;">
                                <i class="material-icons">add</i>
                            </button></div></div></th>
                </thead>
            </table>

{{--            /*<h4>{{$labels['project'] ?? 'Project'}}: <span><script>document.getElementById("project").options[document.getElementById("project").selectedIndex].text;</script></span></h4>--}}
{{--            <h4>{{$labels['activity'] ?? 'Activity'}}: <span><script>document.getElementById("activity").options[document.getElementById("activity").selectedIndex].text;</script></span></h4>--}}
{{--            <h4>{{$labels['location'] ?? 'Location'}}: <span></span></h4>--}}
{{--            <h4>{{$labels['governorate'] ?? 'Governorate'}}: <span></span></h4>--}}
{{--            <h4>{{$labels['currency'] ?? 'Currency'}}: <span></span></h4>--}}


            <div class="col-md-12">


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

            {!! Form::close() !!}
        </div>
    </div>
    </div>

        <div class="modal fade" id="opportunityApproveConfirmModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="card card-signup card-plain">
                       <div  class="modal-header">
                            <h5 class="modal-title card-title" id="comments_modal_title"></h5>
                            <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                            </a>
                        </div>
                        <div class="modal-body">


                            <h3 class="text-center p-2 bolder mt-0" id="approved_reject_title"></h3>

                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                            <div class='row'>
                                                <div class=' col-md-12'>
                                                    <div class='form-group has-default bmd-form-group'>
                                                        <input type='text'  value=''  class='form-control pull-left'  name='budget' id='budget'    required minLength='0' maxLength='100'   alt='Budget'   autocomplete='off'   ></div>
                                                </div>

                                            </div>

                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-next btn-sm btn-rose pull-right">
                                            <div class="loader pull-left" style="display: none;"></div>
                                            {{$labels['save'] ?? 'save'}}
                                        </button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>


                                <div class="col-md-12">

                            <div class="col-md-12">
                                <table id="projectInfo" class="table dataTable no-footer table-bordered">
{{--                                    <tr>--}}
{{--                                        <th></th>--}}
{{--                                        <th>Project Name</th>--}}
{{--                                        </tr>--}}
                                    <tbody>
                                    @if(!empty($project_list))
                                        @foreach($project_list  as $item)
                                        <tr style="" >
                                            <td style=""><input type="radio"  name="projectid" value="{{$item->id}}"></td>

                                            <td>{{$item->{'project_name_'.lang_character()} ?? "" }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>




                                </table>
                                <label for='edit_note' class='col-form-label bolder'></label>
                                <div class='form-group has-default bmd-form-group' >

                                    <input type="hidden" value="" name="type" id="approved_reject_type">
                                    <input type="hidden" value="" name="opp_id" id="approved_reject_opp_id">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="card-footer ml-auto mr-auto">
                                    <div class="ml-auto mr-auto">
                                        <a data-dismiss="modal" aria-label="Close" id="modal-dismiss-f" href="#"  class="btn btn-sm btn-default ">
                                            {{$labels['cancel'] ?? 'cancel'}}
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="activityModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="card card-signup card-plain">
                                            <div class="modal-header">
                                                <h5 class="modal-title card-title" id="comments_modal_title"></h5>
                                                <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i class="material-icons">clear</i>
                                                </a>
                                            </div>
                                            <div class="modal-body">


                                                <h3 class="text-center p-2 bolder mt-0" id="approved_reject_title"></h3>

                                                <div class="col-md-12">
                                                    <label for="edit_note" class="col-form-label bolder">Date :</label>
                                                    <label for="edit_note" class="col-form-label">{{\Carbon\Carbon::now()->format('d/m/Y')}} , {{\Carbon\Carbon::now()->format('H:i')}}</label>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for='edit_note' class='col-form-label bolder'>Activity Name:</label>
                                                    <div class='form-group has-default bmd-form-group'>
                                                        <textarea class='form-control'  name='note' id='approved_reject_note' ></textarea>
                                                        <input type="hidden" value="" name="type" id="approved_reject_type">
                                                        <input type="hidden" value="" name="opp_id" id="approved_reject_opp_id">
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="card-footer ml-auto mr-auto">
                                                        <div class="ml-auto mr-auto">
                                                            <a data-dismiss="modal" aria-label="Close" id="modal-dismiss-f" href="#"  class="btn btn-sm btn-default">
                                                                {{$labels['cancel'] ?? 'cancel'}}
                                                            </a>
                                                            <button type="submit" class="btn btn-next btn-sm btn-rose pull-right">
                                                                <div class="loader pull-left" style="display: none;"></div>
                                                                {{$labels['search'] ?? 'search'}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
        @section('script')
            <script>
                $(document).on('change', '#project','#activity', function (e) {
                    document.getElementById("info").innerHTML(
                                '<h4>{{$labels['project'] ?? 'Project'}}: <span>'+document.getElementById("project").options[document.getElementById("project").selectedIndex].val()+'</span></h4>'+
                               ' <h4>{{$labels['activity'] ?? 'Activity'}}: <span>'+document.getElementById("activity").options[document.getElementById("activity").selectedIndex].val()+'</span></h4>'+
                              '<h4>{{$labels['location'] ?? 'Location'}}: <span></span></h4>'+
                              '  <h4>{{$labels['governorate'] ?? 'Governorate'}}: <span></span></h4>'+
                               ' <h4>{{$labels['currency'] ?? 'Currency'}}: <span></span></h4>'

                );

                });


            </script>
            <script>
                $(document).on('submit', '#formVendorCreate', function (e) {
                    if (!is_valid_form($(this))) {
                        return false;
                    }
                    e.preventDefault();
                    var form = new FormData($(this)[0]);
                    var url = $(this).attr('action');
                    var project = document.getElementById("project").options[document.getElementById("project").selectedIndex].val();
                    var activity = document.getElementById("activity").options[document.getElementById("project").selectedIndex].val();
                    $.ajax({
                        url: url,
                        data: {form,project,activity},
                        type: 'post',
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $('#btnAddvendor').attr("disabled", true);
                            $('#btnAddvendor div.loader').show();
                        },
                    });
                });
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

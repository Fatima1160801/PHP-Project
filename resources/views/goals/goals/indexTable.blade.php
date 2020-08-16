@extends('layouts._layout')


@section('css')
  <style>
    .card-header {
      padding: 13px 14px !important;
    }

    .btn-prog-objective {
      padding: 3px 4px;
    }
  </style>
@endSection
@section('content')


      <div class="col-md-12" style=" background-color: #fff7d0; border-radius: 10px; margin-bottom: 20px ">
        <div class="row">
          @if(isset($strategics))
            <div class='col-md-6'>
              <div class="row">
                <label style="text-align: center;padding: 17px;font-weight: bold;"
                       for='strategic_id' class='col-md-4 col-form-label'>

                  {{$labels['strategic_index'] ??'strategic_index'}}
                </label>

                <div class='col-md-6'>
                  <div class='form-group has-default bmd-form-group'>
                    <select id="strategic_id" name="strategic_id"
                            class="form-control  selectpicker" data-live-search='true'
                            data-style='btn btn-link'>

                      @foreach($strategics as $strategic)

                        @php
                          $checked ='';
                                  if($strategic->id == $strategic_id){
                                      $checked ='selected';
                                      }
                        @endphp
                        <option value="{{$strategic->id}}" {{$checked}}>{{$strategic->strategic_name_na}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          @endif
          <div class='col-md-6'>
            <div class="row">
              <label style="text-align: center;padding: 17px;font-weight: bold;"
                     for='strategic_id' class='col-md-4 col-form-label'>

                {{$labels['status'] ??'status'}}
              </label>

              <div class='col-md-6'>

                <div class='form-group has-default bmd-form-group'>

                  <select id="status_id" name="status_id"
                          class="form-control  selectpicker" data-live-search='true'
                          data-style='btn btn-link'>

                    <option value="0" @if($status==0 || $status==null)  selected @endif >
                      {{  statusLang(0)}}
                    </option>
                    <option value="1" @if($status==1) selected @endif>
                      {{statusLang(1)}}
                    </option>
                  </select>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     <br>
      <br>
  <div class="col-md-12 col-12 mr-auto ml-auto">
    <!--      Wizard container        -->
    <div class="wizard-container">

      <div class="card card-wizard" data-color="rose" id="strategicWizard">


        <div class="card-header text-center">
          {{--<h4  >{{$labels['goals_list'] ?? 'goals_list'}}</h4>--}}

        </div>
        <div class="wizard-navigation">
          <ul class="nav nav-pills nav-project">
            <li class="nav-item">
              <a data-project-id="" class="nav-link active" href="#strategic_tab"
                 data-toggle="tab"
                 role="tab">

                {{--{{$labels['strategic_tab']??'strategic_tab'}}--}}
                {{$labels['goals_list']??'goals_list'}}

              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#program_tab" data-toggle="tab" role="tab">
                {{$labels['program_tab']??'program_tab'}}

              </a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="strategic_tab">

              <a href="{{route('goals.main.create')}}" class="btn btn-sm btn-success "
                 rel="tooltip" data-original-title=""
                 title="{{$labels['add_main_goals'] ?? 'add_main_goals'}}" data-placement="top"
                 id="AddMainGoals">
                <i class="material-icons">add</i>
                {{$labels['add_main_goals'] ?? 'add_main_goals'}}
              </a>
              {{--<a href="{{route('goals.main.index.tree')}}" class="btn btn-sm btn-default pull-right"--}}
              {{--rel="tooltip" data-original-title="" title="tree" data-placement="top"--}}
              {{--id="AddMainGoals">--}}
              {{--<i class="material-icons">format_align_right</i>--}}
              {{--</a>--}}


              <table class="table org-goal" id="table">
                <tbody>
                @if($goals_indic_result_view != null)

                  @foreach($goals_indic_result_view->where('goal_parent_id','0')->unique('goal_id')  as $index=>$goal)
                    <tr>
                      <td style="width: 2% !important;" class="   height-30"></td>
                      <td style="width: 2% !important;" class="  height-30"></td>
                      <td style="width: 14% !important;" class="height-30"></td>
                      <td style="width: 14% !important;" class="height-30"></td>
                      <td style="width: 10% !important;" class="height-30 "></td>
                      <td style="width: 22% !important;" class="height-30"></td>
                      <td style="width: 22% !important;" class="height-30"></td>
                      <td style="width: 10% !important;" class="height-30"></td>
                    </tr>
                    <tr class="main-goal-style">
                      <td colspan="7">
                        <img src="{{asset('\images\mg.png')}}" style=" width: 25px; ">
                        {{ $goal->goal_name }}
                      </td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success btn-sm ">
                            {{$labels['actions']??'actions'}}
                          </button>
                          <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                  data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="    width: 200px;">

                            <li>
                              <a href="{{route('goals.main.edit',$goal->goal_id)}}" id="EditGoals">
                                {{$labels['edit'] ?? 'edit'}}
                              </a>
                            </li>

                            <li>
                              <a href="{{route('goals.indicators.create',$goal->goal_id)}}"
                                 id="AddIndicators">
                                {{$labels['add_indicator'] ?? 'add_indicator'}}
                              </a>
                            </li>

                            <li>
                              <a href="{{route('goals.sub.create',$goal->goal_id)}}" id="EditActivity">
                                {{$labels['add_sub_goal'] ?? 'add_sub_goal'}}
                              </a>
                            </li>

                            <li>
                              <a href="{{route('goals.main.destroy',$goal->goal_id)}}"
                                 id="DeleteMainGoals">
                                {{$labels['delete'] ?? 'delete'}}


                              </a>
                            </li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    {{--<tr>--}}
                    {{--<td></td>--}}
                    {{--<td colspan="4">Indicator</td>--}}
                    {{--<td></td>--}}
                    {{--</tr>--}}

                    @if($goals_indic_result_view->where('goal_id',$goal->goal_id)->where('indic_id','!=','null')->count() >0)
                      @foreach($goals_indic_result_view->where('goal_id',$goal->goal_id)->where('indic_id','!=','null')->unique('indic_id') as $index=>$indic)
                        @if($indic->indic_id)
                          <tr>
                            <td style="border-bottom: 1px solid #ffffff"></td>
                            <td style="border-bottom: 1px solid #ffffff"></td>
                            <td colspan="5">
                              <img src="{{asset('images/i.png')}}" style="margin-top: -15px;width: 25px; ">
                              {{$indic->indicator_name}}

                            </td>
                            <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-success btn-sm ">
                                  {{$labels['actions']??'actions'}}
                                </button>
                                <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                        data-toggle="dropdown">
                                  <span class="caret"></span>
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu" style="    width: 168px;">

                                  <li>
                                    <a href="{{route('goals.indicators.edit',$indic->indic_id)}}"
                                       id="EditIndicator">
                                      {{$labels['edit_indicator'] ?? 'edit_indicator'}}
                                    </a>
                                  </li>
                                  <li>
                                    <a href="{{route('goals.indicators.destroy',$indic->indic_id)}}"
                                       id="DeleteIndicator">
                                      {{$labels['delete_indicator'] ?? 'delete_indicator'}}
                                    </a>
                                  </li>
                                  {{--<li>--}}
                                  {{--<a href="{{route('goals.results.create',[$indic->goal_id,$indic->indic_id])}}"--}}
                                  {{--id="AddResult">--}}
                                  {{--{{$labels['add_result'] ?? 'add_result'}}--}}
                                  {{--</a>--}}
                                  {{--</li>--}}
                                </ul>
                              </div>
                            </td>

                          </tr>
                        @endif


                      @endforeach
                    @endif

                    @if($goals_indic_result_view->where('goal_parent_id',$goal->goal_id)->count() >0)
                      @foreach($goals_indic_result_view->where('goal_parent_id',$goal->goal_id)->unique('goal_id') as$index=>$goal_sub )
                        {{--style="background-color: #fb9208;color: white;margin: 0px;"--}}
                        <tr class="sub-goal-style">
                          <td></td>
                          <td colspan="6">
                            <img src="{{asset('\images\sg.png')}}" style=" width: 25px; ">
                            {{ $goal_sub->goal_name }}

                          </td>
                          <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-success btn-sm ">
                                {{$labels['actions']??'actions'}}
                              </button>
                              <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                      data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu" style="    width: 168px;">

                                <li>
                                  <a href="{{route('goals.sub.edit',$goal_sub->goal_id)}}"
                                     id="EditGoals">
                                    {{$labels['edit_sub_goals'] ?? 'edit_sub_goals'}}
                                  </a>
                                </li>
                                <li>
                                  <a href="{{route('goals.sub.destroy',$goal_sub->goal_id)}}"
                                     id="DeleteSubGoals">
                                    {{$labels['delete'] ?? 'delete'}}
                                  </a>
                                </li>
                                <li>
                                  <a href="{{route('goals.indicators.create',$goal_sub->goal_id)}}"
                                     id="AddIndicators">
                                    {{$labels['add_indicator'] ?? 'add_indicator'}}
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        </tr>

                        @if($goals_indic_result_view->where('goal_id',$goal_sub->goal_id)->where('indic_id','!=','null')->count() >0)
                          @foreach($goals_indic_result_view->where('goal_id',$goal_sub->goal_id)->where('indic_id','!=','null')->unique('indic_id') as $index=>$indic)
                            @if($indic->indic_id)
                              <tr>
                                <td class="" style="border-bottom: 1px solid #ffffff"></td>
                                <td class="" style="border-bottom: 1px solid #ffffff"></td>
                                <td colspan="5">
                                  <img src="{{asset('images\i.png')}}" style="margin-top: -15px;width: 25px; ">
                                  {{$indic->indicator_name}}

                                </td>

                                <td>
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm ">
                                      {{$labels['actions']??'actions'}}
                                    </button>
                                    <button type="button"
                                            class="btn btn-success btn-sm dropdown-toggle"
                                            data-toggle="dropdown">
                                      <span class="caret"></span>
                                      <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu" style="    width: 168px;">

                                      <li>
                                        <a href="{{route('goals.indicators.edit',$indic->indic_id)}}"
                                           id="EditIndicator">
                                          {{$labels['edit_indicator'] ?? 'edit_indicator'}}
                                        </a>
                                      </li>
                                      <li>
                                        <a href="{{route('goals.indicators.destroy',$indic->indic_id)}}"
                                           id="DeleteIndicator">
                                          {{$labels['delete_indicator'] ?? 'delete_indicator'}}
                                        </a>
                                      </li>
                                      {{--<li>--}}
                                      {{--<a href="{{route('goals.results.create',[$indic->goal_id,$indic->indic_id])}}"--}}
                                      {{--id="AddResult">--}}
                                      {{--{{$labels['add_result'] ?? 'add_result'}}--}}
                                      {{--</a>--}}
                                      {{--</li>--}}
                                    </ul>
                                  </div>
                                </td>

                              </tr>
                            @endif


                          @endforeach
                        @endif

                      @endforeach
                    @endif



                  @endforeach
                @endif
                </tbody>
              </table>

              <div class="col-md-12">
                <a href="#" class="btn btn-next btn-default  btn-sm pull-right " id="btnNextLocation">
                  {{$labels['next'] ?? 'next'}}
                </a>
              </div>
            </div>
            <div class="tab-pane" id="program_tab">
              <a class="btn btn-primary btn-sm pull-right mytooltip"
                 href="{{ route('strategic.programs.create',$strategic_id) }}"
                 data-toggle="modal" data-target="#modalProgram" id="addProgram"
                >
                <span class="mytooltiptext">   {{$labels['add_program'] ??'add_program'}}</span>
                <i class="fa fa-plus"></i>

              </a>

              <div class="collapse-group">
                @if(sizeof($programs)>0)


                  <button class="btn btn-primary btn-sm open-button btn-prog-objective" type="button">
                    Expand all
                  </button>
                  <button class="btn btn-primary btn-sm  close-button btn-prog-objective" type="button">

                    Close all
                  </button>
                  @foreach($programs as $index__=>$program)
                    <div class="card" id="div_program_{{$program->id}}">
                      <header class="card-header bg-primary my-bg-primary">
                        <a href="#" data-toggle="collapse" data-target="#collapseModule{{$program->id}}"
                           aria-expanded="true" class="">
                          <i class="icon-action fa fa-chevron-down text-white"></i>
                          <span class="title "
                                id="prog_name_{{$program->id}}"> {{$program->{'program_name_'.lang_character()} }} </span>
                        </a>
                        <a class="  pull-right mytooltip"
                           href="{{ route('strategic.programs.edit',$program->id) }}"
                           data-toggle="modal" data-target="#modalProgram" id="editProgram">
                          <i class="material-icons">edit</i>
                          <span class="mytooltiptext">   {{$labels['edit'] ??'edit'}}</span>

                        </a>
                        <a class="  pull-right mytooltip"
                           href="{{ route('strategic.program.delete',$program->id) }}" id="DeleteProgram">
                          <i class="material-icons">delete</i>
                          <span class="mytooltiptext">   {{$labels['delete'] ??'delete'}}</span>

                        </a>

                        <a class=" pull-right mytooltip"
                           href="{{route('strategic.programs.objective.create',$program->id)}}"
                           id="addProgramObjective" data-toggle="modal" data-target="#modalProgramObjective">
                          <i class="material-icons">add</i>
                          <span class="mytooltiptext">   {{$labels['add_objective'] ??'add_objective'}}</span>

                        </a>

                      </header>
                      <div class="collapse @if($index__ == 0) show @endif" id="collapseModule{{$program->id}}"
                           style="">
                        <article class="card-body">
                          <div class="row">
                            <div class="col-md-12" id="Table_{{$program->id}}">
                              @include('program/program_row',
                              [
                                 'program'=>$program,
                                 'labels'=>$labels,
                                 'strategic_id'=>$strategic_id,
                                 'objectives'=> \App\Models\Programs\ProgramObjective::getObjectives($program->id)
                               ]
                              )
                            </div>

                        </article> <!-- card-body.// -->
                      </div> <!-- collapse .// -->
                    </div>

                  @endforeach
                @endif

              </div>

              <div class="col-md-12">
                <a href="#" class="btn btn-sm btn-previous btn-fill btn-default btn-wd pull-left"
                   id="previous">
                  {{$labels['previous']??'previous'}}
                </a>

                <a href="{{route('activity.mainActivity.index')}}"
                   class="btn btn-sm  btn-fill btn-rose btn-wd pull-right" id="finish">
                  {{$labels['finish']??'finish'}}

                </a>

              </div>

            </div>
          </div>
        </div>

        <!-- wizard container -->
      </div>
    </div>
  </div>

  <div class="modal fade  bd-example-modal-lg " id="modalProgram" tabindex="-1" role="">
    <div class="modal-dialog  modal-lg " role="document">
      <div id="contentModal">

      </div>
    </div>
  </div>
  <div class="modal fade  bd-example-modal-lg " id="modalProgramObjective" tabindex="-1" role="">
    <div class="modal-dialog  modal-lg " role="document">
      <div id="contentModal">

      </div>
    </div>
  </div>

@endSection
@section('script')
  <script>


      var org_indicators_array = @json($org_indicators);
      console.log(org_indicators_array);
      $(function () {
          active_nev_link('goals');
          $('.selectpicker').selectpicker();

          setTimeout(function () {
              $('.selectpicker').selectpicker('refresh');


          }, 1000);
          wizard();
      });

      function wizard() {
          wizardStrategic.initMaterialWizard();
          setTimeout(function () {
              $('#strategicWizard').addClass('active');
          }, 600);
      }

      $(document).on('click', '#DeleteSubGoals', function (e) {
          e.preventDefault();
          $this = $(this);

          swal({

              text: '{{ $messageDeleteSubGoals['text']}}',
              showCancelButton: true,
              confirmButtonClass: 'btn btn-success btn-sm',
              cancelButtonClass: 'btn btn-danger btn-sm',
              buttonsStyling: false,
          }).then(result => {
              if (result == true) {
                  // var project_id = $('#formProjectMain #id').val();
                  url = $(this).attr('href');
                  $.ajax({
                      url: url,
                      type: 'delete',
                      beforeSend: function () {

                      },
                      success: function (data) {
                          if (data.status == 'true') {
                              $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                          }
                          myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                      },
                      error: function () {
                      }
                  });
              }
          })
      });

      $(document).on('click', '#DeleteMainGoals', function (e) {
          e.preventDefault();
          $this = $(this);
          swal({
              text: '{{ $messageDeleteMainGoals['text']}}',
              showCancelButton: true,
              confirmButtonClass: 'btn btn-success  btn-sm',
              cancelButtonClass: 'btn btn-danger btn-sm',
              buttonsStyling: false,
          }).then(result => {
              if (result == true) {
                  // var project_id = $('#formProjectMain #id').val();
                  url = $(this).attr('href');
                  $.ajax({
                      url: url,
                      type: 'delete',
                      beforeSend: function () {

                      },
                      success: function (data) {
                          if (data.status == 'true') {
                              $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                          }
                          myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                      },
                      error: function () {
                      }
                  });
              }
          })
      });


      $(document).on('click', '#DeleteResult', function (e) {
          e.preventDefault();
          $this = $(this);
          swal({
              confirmButtonClass: 'btn btn-success  btn-sm',
              cancelButtonClass: 'btn btn-danger  btn-sm',
              buttonsStyling: false,
              text: '{{$messageDeleteResult['text']}}',
              showCancelButton: true
          }).then(result => {
              if (result == true) {
                  // var project_id = $('#formProjectMain #id').val();
                  url = $(this).attr('href');
                  $.ajax({
                      url: url,
                      type: 'delete',
                      beforeSend: function () {

                      },
                      success: function (data) {
                          if (data.status == 'true') {
                              $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                          }
                          myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                      },
                      error: function () {
                      }
                  });
              }
          })
      });


      $(document).on('click', '#DeleteIndicator', function (e) {
          e.preventDefault();
          $this = $(this);
          swal({
              confirmButtonClass: 'btn btn-success  btn-sm',
              cancelButtonClass: 'btn btn-danger  btn-sm',
              text: '{{ $messageDeleteIndicator['text']}}',
              buttonsStyling: false,
              showCancelButton: true
          }).then(result => {
              if (result == true) {
                  // var project_id = $('#formProjectMain #id').val();
                  url = $(this).attr('href');
                  $.ajax({
                      url: url,
                      type: 'delete',
                      beforeSend: function () {

                      },
                      success: function (data) {
                          if (data.status == 'true') {
                              $($this).closest('tr').css('background', 'red').delay(1000).hide(1000);
                          }
                          myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                      },
                      error: function () {
                      }
                  });
              }
          })
      });


      $(document).on('change', '#strategic_id', function (e) {
          e.preventDefault();
          var strategic_id = $('#strategic_id').val();
          var status_id = $('#status_id').val();
          var url = '{{route("goals.main.index.table")}}' + '/' + strategic_id + '/' + status_id;
          window.location.href = url;
      });

      $(document).on('change', '#status_id', function (e) {
          e.preventDefault();
          var strategic_id = $('#strategic_id').val();
          var status_id = $('#status_id').val();
          var url = '{{route("goals.main.index.table")}}' + '/' + strategic_id + '/' + status_id;
          window.location.href = url;
      });


      /*open modal  program ***/

      $(document).on('click', '#addProgram', function (e) {
          e.preventDefault();
          var url_ = $(this).attr('href');
          $.ajax({
              url: url_,
              type: 'get',
              dataTypes: 'html',
              beforeSend: function () {
                  $('#modalProgram #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
              },
              success: function (data) {
                  if (data.status == true) {
                      $('#modalProgram #contentModal').empty();
                      $('#modalProgram #contentModal').html(data.html);
                      $('.selectpicker ').selectpicker();
                      funValidateForm();
                      $('.selectpicker ').selectpicker();

                  }
              },
              error: function () {
              }
          });
      });

      function closeModalAddPrograme() {
          $('#modalProgram').modal('hide');
      }

      function cleanformAddProgram() {
          $('#formAddProgram #id').val('')
          $('#formAddProgram #strategic_id').val('')
          $('#formAddProgram #program_name_na').val('')
          $('#formAddProgram #program_name_fo').val('')
      }

      $(document).on('submit', '#formAddProgram', function (e) {
          e.preventDefault();
          $this = $(this);
          var data_ = $(this).serialize();
          var url_ = $(this).attr('action');
          $.ajax({
              url: url_,
              dataTypes: 'json',
              data: data_,
              type: 'post',
              beforeSend: function () {
                  $($this).find('#saveProgram').prop("disabled", true);
                  $($this).find('#saveProgram .loader').css('display', 'block');
              },
              success: function (data) {
                  if (data.status == true) {
                      $($this).find('#saveProgram').prop("disabled", false);
                      $($this).find('#saveProgram .loader').css('display', 'none');

                      if (data.prog_name != null) {
                          $('#prog_name_' + data.id).text(data.prog_name)
                      }
                      if (data.html != null) {
                          $('.collapse-group').append(data.html)
                      }

                      closeModalAddPrograme();
                      cleanformAddProgram();
                  }
                  myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
              },
              error: function () {
                  $($this).find('#saveProgram').prop("disabled", false);
                  $($this).find('#saveProgram .loader').css('display', 'none');
              }
          })
      });


      $(document).on('click', '#editProgram', function (e) {
          e.preventDefault();
          var url_ = $(this).attr('href');
          $.ajax({
              url: url_,
              type: 'get',
              dataTypes: 'html',
              beforeSend: function () {
                  $('#modalProgram #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
              },
              success: function (data) {
                  if (data.status == true) {
                      $('#modalProgram #contentModal').empty();
                      $('#modalProgram #contentModal').html(data.html);
                      $('.selectpicker ').selectpicker();

                      funValidateForm();
                      $('.selectpicker ').selectpicker();

                  }
              },
              error: function () {
              }
          });
      });

      /*open modal  program  objective***/

      $(document).on('click', '#addProgramObjective', function (e) {
          e.preventDefault();
          var url_ = $(this).attr('href');
          $.ajax({
              url: url_,
              type: 'get',
              dataTypes: 'html',
              beforeSend: function () {
                  $('#modalProgramObjective #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
              },
              success: function (data) {
                  if (data.status == true) {
                      $('#modalProgramObjective #contentModal').empty();
                      $('#modalProgramObjective #contentModal').html(data.html);
                      funValidateForm();
                      $('.selectpicker ').selectpicker();
                  }
              },
              error: function () {
              }
          });
      });

      function closeModalAddProgramObjective() {
          $('#modalProgramObjective').modal('hide');
      }

      function cleanformAddProgramObjective() {
          $('#formAddPObjective #id').val('')
          $('#formAddPObjective #program_id').val('')
          $('#formAddPObjective #objective_name_na').val('')
          $('#formAddPObjective #objective_name_fo').val('')
      }

      $(document).on('submit', '#formAddPObjective', function (e) {
          e.preventDefault();
          $this = $(this);
          var data_ = $(this).serialize();
          var url_ = $(this).attr('action');
          $.ajax({
              url: url_,
              dataTypes: 'json',
              data: data_,
              type: 'post',
              beforeSend: function () {
                  $($this).find('#saveProgramObjective').prop("disabled", true);
                  $($this).find('#saveProgramObjective .loader').css('display', 'block');
              },
              success: function (data) {
                  console.log(data);

                  if (data.status == true) {
                      $($this).find('#saveProgramObjective').prop("disabled", false);
                      $($this).find('#saveProgramObjective .loader').css('display', 'none');

                      if (data.objective_name != null) {
                          $('#objective_name_' + data.id).text(data.objective_name)
                      }
                      if (data.html != null) {
                          $('.collapse-group #program_table_' + data.programs_id).append(data.html)
                      }

                      closeModalAddProgramObjective();
                      cleanformAddProgramObjective();
                  }
                  myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
              },
              error: function () {
                  $($this).find('#saveProgramObjective').prop("disabled", false);
                  $($this).find('#saveProgramObjective .loader').css('display', 'none');
              }
          })
      });


      $(document).on('click', '#edit_objective', function (e) {
          e.preventDefault();
          var url_ = $(this).attr('href');
          $.ajax({
              url: url_,
              type: 'get',
              dataTypes: 'html',
              beforeSend: function () {
                  $('#modalProgramObjective #contentModal').html('<div align="center" class="col-md-12 "> <div class="loader loader-div">  </div></div>');
              },
              success: function (data) {
                  if (data.status == true) {
                      $('#modalProgramObjective #contentModal').empty();
                      $('#modalProgramObjective #contentModal').html(data.html);
                      funValidateForm();
                      $('.selectpicker ').selectpicker();


                  }
              },
              error: function () {
              }
          });
      });

      var count_ = 0;

      function addRowIndicator(objective_id) {
          showBtnSave(objective_id);
          count_ += 1;
          console.log(count_);
          var html = '<tr class="tr-new" style="   background-color: #fff;">';
          html += ' <td >';
          html += '<input required class="form-control po_indicator_name_na" type="text" name="po_indicator_name_na_new[' + objective_id + '][' + count_ + ']">';
          html += '</td><td >';
          html += '<input  required class="form-control po_indicator_name_fo" type="text" name="po_indicator_name_fo_new[' + objective_id + '][' + count_ + ']">';
          html += '</td><td >';
          html += ' <select required class="form-control selectpicker list-of-types org_indicator_id" data-live-search="true" ' +
              ' name="org_indicator_id_new[' + objective_id + '][' + count_ + ']"  id="org_indicator_id" data-style="btn btn-link"> ';

          html += ' <option value=""></option>';

          $.each(org_indicators_array, function (index, value) {
              html += ' <option value="' + index + '">' + value + '</option>';
          });

          var delete_ = "{{$labels["delete"] ?? "delete"}}";
          html += '</select>';
          html += '</td> ';
          html += '<td><a style="color: #fff"  class="btn btn-sm btn-danger btn-round mytooltip  btn_delete_indicator_new" > <span class="mytooltiptext">'+delete_+'</span>  <i class="material-icons">delete</i></a></td>';
          html += '</tr>';
          $('#objective_table_' + objective_id + ' #objective_indicator_' + objective_id + ' tbody').append(html);
          $('.org_indicator_id').selectpicker('refresh');
      }


      $(document).on('click', '#addObjectiveIndicator', function (e) {
          e.preventDefault();
          console.log('addObjectiveIndicator');
          var bjective_id = $(this).attr('data-bjective-id');
          addRowIndicator(bjective_id);
          $('.org_indicator_id').selectpicker();

      });

      $(document).on('submit', '#formAddIndicator', function (e) {
          e.preventDefault();
          $this = $(this);
          var data_ = $(this).serialize();
          console.log(data_);
          var url_ = $(this).attr('action');
          $.ajax({
              url: url_,
              dataTypes: 'json',
              data: data_,
              type: 'post',
              beforeSend: function () {
                  $($this).find('#saveIndicator').prop("disabled", true);
                  $($this).find('#saveIndicator .loader').css('display', 'inline-block');
              },
              success: function (data) {
                  if (data.status == true) {
                      $($this).find('#saveIndicator').prop("disabled", false);
                      $($this).find('#saveIndicator .loader').css('display', 'none');
                      $('#objective_indicator_' + data.objective_id + ' tbody tr').remove()
                      $('#objective_indicator_' + data.objective_id + ' tbody').append(data.html)
                      $('.selectpicker').selectpicker();
                  }
                  myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
              },
              error: function () {
                  $($this).find('#saveIndicator').prop("disabled", false);
                  $($this).find('#saveIndicator .loader').css('display', 'none');
              }
          })
      })

      $(".open-button").on("click", function () {
          $(this).closest('.collapse-group').find('.collapse').collapse('show');
      });

      $(".close-button").on("click", function () {
          $(this).closest('.collapse-group').find('.collapse').collapse('hide');
      });


      $(document).ready(function () {
          disabledBtnSave();
      });

      function disabledBtnSave() {
          $('#formAddIndicator table').each(function (index, element) {
              var x = $(element).find('tbody tr').length;
              if (x == 0) {
                  $(element).closest('form').find('button').hide();
                  $(element).find('thead').hide();
              }
          })
      }

      function showBtnSave(objective_id) {

          $('#objective_indicator_' + objective_id).closest('form').find('button').show();
          $('#objective_indicator_' + objective_id).find('thead').show();

      }


      $(document).on('click', '.btn_delete_indicator', function (e) {

          e.preventDefault();
          $this = $(this);
          swal({
              text: '{{$messageDeleteIndicator['text']}}',
              confirmButtonClass: 'btn btn-success  btn-sm',
              cancelButtonClass: 'btn btn-danger  btn-sm',
              buttonsStyling: false,
              showCancelButton: true
          }).then(result => {
              if (result == true) {
                  url = $(this).attr('href');
                  $.ajax({
                      url: url,
                      type: 'delete',
                      beforeSend: function () {
                      },
                      success: function (data) {
                          if (data.status == true) {
                              $($this).closest('tr').css('background', '#F44336').delay(1000).hide(1000);
                          }
                          myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                      },
                      error: function () {
                      }
                  });
              }
          });

      });

      $(document).on('click', '.btn_delete_indicator_new', function (e) {

          e.preventDefault();
          $this = $(this);
          swal({
              text: '{{$messageDeleteIndicator['text']}}',
              confirmButtonClass: 'btn btn-success  btn-sm',
              cancelButtonClass: 'btn btn-danger  btn-sm',
              buttonsStyling: false,
              showCancelButton: true
          }).then(result => {
              $($this).closest('tr').css('background', '#F44336').delay(1000).hide(1000);

          });

      });

      $(document).on('click', '#deleteObjective', function (e) {

          e.preventDefault();
          $this = $(this);
          swal({
              text: '{{$messageDeleteObjective['text']}}',
              confirmButtonClass: 'btn btn-success  btn-sm',
              cancelButtonClass: 'btn btn-danger  btn-sm',
              buttonsStyling: false,
              showCancelButton: true
          }).then(result => {
              if (result == true) {
                  url = $(this).attr('href');
                  $.ajax({
                      url: url,
                      type: 'delete',
                      beforeSend: function () {
                      },
                      success: function (data) {
                          if (data.status == true) {
                              $('#objective_table_' + data.objective_id).remove();
                          }
                          myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                      },
                      error: function () {
                      }
                  });
              }
          });

      });
      $(document).on('click', '#DeleteProgram', function (e) {

          e.preventDefault();
          $this = $(this);
          swal({
              text: '{{$messageDeleteProgram['text']}}',
              confirmButtonClass: 'btn btn-success  btn-sm',
              cancelButtonClass: 'btn btn-danger  btn-sm',
              buttonsStyling: false,
              showCancelButton: true
          }).then(result => {
              if (result == true) {
                  url = $(this).attr('href');
                  $.ajax({
                      url: url,
                      type: 'delete',
                      beforeSend: function () {
                      },
                      success: function (data) {
                          if (data.status == true) {
                              $('#div_program_' + data.program_id).remove();
                          }
                          myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                      },
                      error: function () {
                      }
                  });
              }
          });

      });


  </script>



@stop




@section('js')

  <!-- Forms Validations Plugin -->
  <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>


  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
  {{--<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->--}}
  {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
  {{--<script src="{{ asset('js/datatables/datatables.min.js')}}"></script>--}}

  @if(\Illuminate\Support\Facades\Auth::user()->lang_id ==2)
    <script src="{{ asset('js/wizard-rtl.js')}}"></script>
  @else
    <script src="{{ asset('js/wizard.js')}}"></script>
  @endif



@endsection

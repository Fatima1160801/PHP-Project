
<div class="modal fade" id="modalDashboardSettings" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title" id="">Dashboard Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Choose the blocks that you want to be shown in your dashboard.</p>
                    {!! Form::open(['route' => 'dashboard_settings.save' ,'action'=>'post' ,'id'=>'formDashboardSettings']) !!}
                    @foreach($dashboardBlocks as $block)
                            <div class="togglebutton switch-sidebar-mini">
                                <label class="text-dark">
                                    <input name="block_{{$block->id}}" block-id="{{$block->id}}" type="checkbox" {{in_array($block->id,$userDashboardBlocksSetting) ? 'checked' : ''}} class="groupId default">
                                    <span class="toggle te"></span>
                                    {{$block->block_name}}
                                </label>
                            </div>
                    @endforeach
                    <div class="col-md-12">
                        <button type="submit" id="btn-dashboard-settings-save" class="btn btn-rose pull-right">
                            {{$labels['save'] ?? 'save'}}
                            <div class="loader pull-left" style="display: none;"></div>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modalDashboardProjectsFilter" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title" id="">Filter Projects</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'dashboard.projects.filter.new' ,'action'=>'post' ,'id'=>'formDashboardProjectsFilter']) !!}

                    <div class="row">
                        <label class="col-md-3 col-form-label" for="is_hidden">Project Status</label>
                        <div class="col-md-4">
                            <div class="form-group has-default bmd-form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="status_open" type="checkbox" value="1">
                                        <span class="form-check-sign"> <span class="check"></span> </span> Open
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="status_closed" type="checkbox" value="1">
                                        <span class="form-check-sign"> <span class="check"></span> </span> Closed
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="staff_id" class="col-md-3 col-form-label">Program</label>
                        <div class="col-md-4">
                            <div class='form-group has-default bmd-form-group'>
                                <select class='form-control selectpicker' data-live-search="true" name='program_id' data-style='btn btn-link'
                                        id='program_id'>
                                    <option style='height: 37px;' value></option>
                                    @if($programs)
                                        @foreach($programs as $program)
                                            <option value="{{$program->id}}">{{Auth::user()->lang_id == 1 ? $program->program_name_na : $program->program_name_fo}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="staff_id" class="col-md-3 col-form-label">By Date</label>
                        <div class="col-md-4">
                            <div class='form-group has-default bmd-form-group'>
                                <select class='form-control selectpicker' name='by_date' data-style='btn btn-link' id="by_date">
                                    <option style='height: 37px;' value=""></option>
                                    <option style='height: 37px;' value="l3m">Last 3 Months</option>
                                    <option style='height: 37px;' value="l6m">Last 6 Months</option>
                                    <option style='height: 37px;' value="ly">Last Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-md-3 col-form-label"></label>
                        <div class="col-md-4">
                            <button type="submit" btn="btnToggleDisabled" id="btn-dashboard-projects-filter" class="btn btn-rose pull-center">
                                 Search
                                <div class="loader pull-left" style="display: none;"></div>
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalDashboardActivitiesFilter" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-signup" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <h5 class="modal-title card-title" id="">Filter Projects</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'dashboard.activities.filter.new' ,'action'=>'post' ,'id'=>'formDashboardActivitiesFilter']) !!}

                    <div class="row">
                        <label class="col-md-3 col-form-label" for="is_hidden">Activity Status</label>
                        <div class="col-md-4">
                            <div class="form-group has-default bmd-form-group">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="status_open" type="checkbox" value="1">
                                        <span class="form-check-sign"> <span class="check"></span> </span> Open
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="status_closed" type="checkbox" value="1">
                                        <span class="form-check-sign"> <span class="check"></span> </span> Closed
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="staff_id" class="col-md-3 col-form-label">Project</label>
                        <div class="col-md-4">
                            <div class='form-group has-default bmd-form-group'>
                                <select class='form-control selectpicker' data-live-search="true" name='project_id' data-style='btn btn-link' id='project_id'>
                                    <option style='height: 37px;' value></option>
                                    @if($projects_all)
                                        @foreach($projects_all as $project_)
                                            <option value="{{$project_->id}}">{{Auth::user()->lang_id == 1 ? $project_->project_name_na : $project_->project_name_fo}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label for="staff_id" class="col-md-3 col-form-label">By Date</label>
                        <div class="col-md-4">
                            <div class='form-group has-default bmd-form-group'>
                                <select class='form-control selectpicker' name='by_date' data-style='btn btn-link' id="by_date">
                                    <option style='height: 37px;' value=""></option>
                                    <option style='height: 37px;' value="l3m">Last 3 Months</option>
                                    <option style='height: 37px;' value="l6m">Last 6 Months</option>
                                    <option style='height: 37px;' value="ly">Last Year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label for="" class="col-md-3 col-form-label"></label>
                        <div class="col-md-4">
                            <button type="submit" btn="btnToggleDisabled" id="btn-dashboard-activities-filter" class="btn btn-rose pull-center">
                                Search
                                <div class="loader pull-left" style="display: none;"></div>
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
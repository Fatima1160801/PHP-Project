@extends('procurement.layout')

@section('content')
    <div class="col-md-12 col-12 mr-auto ml-auto">
        <div class="card card-wizard" data-color="rose" id="createTaskWizard">

            <!--        You can switch " data-color="primary" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->
            <div class="card-header text-center">
                <h3 class="card-title">
                    {{$labels['concept_title'] ?? 'Concept'}}
                </h3>
                <h5 class="card-description"></h5>
            </div>
            <div class="wizard-navigation">
                <ul class="nav nav-pills">
                    <li class="nav-item" id="task_link" data-task-id="">
                        <a class="nav-link active" id="tabno1" href="#main_info" data-toggle="tab" role="tab">
                            {{$labels['concept_label'] ?? 'Information'}}
                        </a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="#assigned_to" data-toggle="tab" role="tab">
                            Assigned To
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" id="tabno2" href="#concept_tab" data-toggle="tab" role="tab">
                            {{$labels['concept_title'] ?? 'Concept'}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="tabno3" href="#comments" data-toggle="tab" role="tab">
                            {{$labels['notes_label'] ?? 'Notes'}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="tabno4" href="#feedback" data-toggle="tab" role="tab">
                            {{$labels['feed_back_label'] ?? 'Donor Feedback'}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="tabno5" href="#log_hour" data-toggle="tab" role="tab">
                            {{$labels['attachments'] ?? 'attachments'}}
                        </a>
                    </li>

                </ul>
            </div>
            <div class="card-body">

                <div align="center" id="loader-icon-new" class="col-md-12">
                    <div style="display: none;" class="loader loader-div"></div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="main_info">
                         <h1>kjjhujg</h1>
                    </div>
                    </div>
                    </div>
                    </div>
@endsection

    @section('js')
        <!-- Forms Validations Plugin -->
            <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
            <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
            <script src="{{ asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
            <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
            <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

            <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
            <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
            <script src="{{asset('js/datatables/datatables.min.js')}}"></script>


            @if(\Illuminate\Support\Facades\Auth::user()->lang_id ==2)
                <script src="{{asset('js/concept_edit_wizard_rtl.js')}}"></script>
            @else
                <script src="{{asset('js/concept_edit_wizard.js')}}"></script>
    @endif



@endsection
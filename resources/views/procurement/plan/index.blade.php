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
         @include('procurement.plan.plan_content')
         </div>
@endsection
        @section('script')
                    @include('procurement.plan.plan_script')
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

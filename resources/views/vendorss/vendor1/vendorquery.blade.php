@extends('layouts._layout')
@section('content')
<div class="card ">
    <div class="card-header card-header-rose  card-header-icon">
        <div class="card-icon">
            <i class="material-icons">desktop_windows</i>
        </div>
        <h4 class="card-title">
            {{$labels['searchvendor'] ?? 'Search Vendors'}}
        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>


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


        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('script')
<script>

    $(document).ready(function () {
        active_nev_link('visit-link');
        funValidateForm();

    });
    $( "#country_id" ).change(function() {
        var state = $('#country_id').find(":selected").val();
        getState(state);
    });
    function getState(state) {
        $("#country_id_loader").show();
        var list1 ="<option selected  value=''></option>";
        $id=state;
        $.get('{{url('/state/by/country')}}'+'/'+$id,function(data){
            $.each(data.list, function (index, value) {
                list1+='<option value=' +index + '>' + value + '</option>';
            });
            $("#state_id").html(list1);
            $("#state_id").selectpicker("refresh");

            $("#country_id_loader").hide();
        });
    }

    $( "#state_id" ).change(function() {
        var state = $('#state_id').find(":selected").val();
        getCity(state);
    });
    function getCity(state) {
        $("#state_id_loader").show();
        var list2 ="<option selected  value=''></option>";
        $id=state;
        $.get('{{url('/city/by/state')}}'+'/'+$id,function(data){
            $.each(data.list, function (index, value) {
                list2+='<option value=' +index + '>' + value + '</option>';
            });
            $("#city_id").html(list2);
            $("#city_id").selectpicker("refresh");

            $("#state_id_loader").hide();
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

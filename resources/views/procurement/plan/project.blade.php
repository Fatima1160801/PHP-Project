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


            <div id="result-msg"></div>

    {!! Form::open(['route' => 'vendors.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formVendorCreate']) !!}
          <h4>{{$labels['project'] ?? 'Project'}}: <span>Protection of The right</span></h4>
            <h4>{{$labels['item'] ?? 'Item'}}: <span>Protection of The right</span></h4>
            <h4>{{$labels['currency'] ?? 'Currency'}}: <span>Currency</span></h4>




            <table class="table" id="plans">
        <thead>
        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['serial'] ?? 'Serial'}}</div></div></th>
        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['activity'] ?? 'Activity'}}</div></div></th>
        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['item'] ?? 'Item'}}<span style="color: red">*</span></div></div></th>
        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['type'] ?? 'Type'}}<span style="color: red">*</span></div></div></th>
        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['budget'] ?? 'Budget'}}<span style="color: red">*</span></div></div></th>
        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['purchaseway'] ?? 'Purchase Way'}}<span style="color: red">*</span></div></div></th>
        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group">{{$labels['start date'] ?? 'Start Date'}}<span style="color: red">*</span></div></div></th>
        <th></th>
        <th><div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" class="btn btn-sm btn-success btn-round btn-fab" onclick="myFunction()" style="margin-bottom:+0.5em;">
                        <i class="material-icons">add</i>
                    </button></div></div></th>
        </thead>
    </table>
            <a href="" class="btn btn-sm btn-rose"
               data-toggle="tooltip" data-placement="top" title="Export Excel " id="btnReportExcel">
                <i class="material-icons">print</i> Excel
            </a>
            <a href="" class="btn btn-sm btn-info"
               data-toggle="tooltip" data-placement="top" title="Export Excel " id="btnReportExcel">
                <i class="material-icons">print</i> Print
            </a>
    {!! Form::close() !!}  </div>

    </div>
@endsection
@section('script')
    <script>
function myFunction(){
    var table = document.getElementById("plans");
    var totalRowCount = table.rows.length;
    if(totalRowCount-1<=9) {
        var row = table.insertRow(-1);
        var cell1 = row.insertCell(0).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="hidden" value="1" name="serial[]"/> <input type="text" value="" class="form-control  fullname-input" name="fullname[]"  minlength="0" maxlength="200"  autocomplete="off" ></div></div>';


        var cell2 = row.insertCell(1).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><select minlength="0" maxlength="11" name="job_title_id[]"  class="contactpersons   jobtitle"></select></div></div>';
        var cell3 = row.insertCell(2).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value="" class="form-control  tel check-is-number" name="tel[]"   autocomplete="off"></div></div>';
        var cell4 = row.insertCell(3).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value="" class="form-control    " name="contact_email[]"  minlength="0" maxlength="200"  autocomplete="off" ></div></div></div></div>';
        var cell5 = row.insertCell(4).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value="" class="form-control    " name="contact_email[]"  minlength="0" maxlength="200"  autocomplete="off" ></div></div></div></div>';
        var cell6 = row.insertCell(5).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value="" class="form-control    " name="contact_email[]"  minlength="0" maxlength="200"  autocomplete="off" ></div></div></div></div>';
        var cell7 = row.insertCell(6).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value="" class="form-control    " name="contact_email[]"  minlength="0" maxlength="200"  autocomplete="off" ></div></div></div></div>';

        var cell8 = row.insertCell(7).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><button type="button" rel="tooltip" class="btn btn-sm btn-primary btn-round btn-fab btnTypeDelete"+data-placement="top"  title=" Delete "><i class="material-icons">edit</i></button></div></div>';


    }
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

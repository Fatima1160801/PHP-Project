@extends('layouts._layout')
@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['addvendor'] ?? 'Add Vendors'}}
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
            <h3>Contact Persons</h3>
            <table class="table" id="personal contacts">
                <thead>
                <th>full name</th>
                <th>Job title</th>
                <th>Telephone</th>
                <th>Email</th>
                <th><button type="button" class="btn btn-success" onclick="myFunction()" style="margin-bottom:+0.5em;">
                        <span class="glyphicon glyphicon-plus"></span> Add
                    </button></th>
                </thead>


            </table>



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
            </div>


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

        $(document).on('submit', '#formVendorCreate', function (e) {
            if (!is_valid_form($(this))) {
                return false;
            }
            e.preventDefault();
            var form = new FormData($(this)[0]);
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnAddvendor').attr("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {

                    $('#btnAddvendor').attr("disabled", false);
                    $('.loader').hide();
                    if (data.status == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);

                        $('.loader').hide();
                    } else if (data.status == false) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    //$('#addBenf').prop("disabled", false);
                    $("#formVendorCreate").trigger("reset");
                    setTimeout(() => {
                        window.location.href = "{{route('vendors.index')}}";
                    }, 1000);

                },
                error: function (data) {

                }
            });
        });

        // $(document).on('click', '#cleanScreen', function (e) {
        //     e.preventDefault();
        //     $('#formOppStatusCreate')[0].reset();
        //     // $('#beneficiary_id').selectpicker('refresh')
        // })



    </script>
    <script>
        function myFunction() {
            /*  var d = 'Url.Action("numrow")';*/
            var table = document.getElementById("personal contacts");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0).innerHTML = '<input type="text" >';
            var cell2 = row.insertCell(1).innerHTML = '<select   name="unit_id" data-style="btn btn-link" id="unit_id"  data-live-search="true"   ><option></optuion><option value="14">Project Manager</option> <option value="15">Project Coordinator</option><option value="16">Manager</option><option value="18">Accountant</option><option value="19">Project  coordinator</option></select>';
            var cell3 = row.insertCell(2).innerHTML = '<input type="text" >';
            var cell4 = row.insertCell(3).innerHTML = '<input type="text" >';
            var cell5 = row.insertCell(4).innerHTML = '<button type="button" class="btn btn-success" onclick="func()">Save</button> <button type="button" class="btn btn-danger" onclick="func()">Delete</button>';

           /* var cell10 = row.insertCell(9).innerHTML = '<button type="button" class="btn btn-default btn-sm" ><span class= "glyphicon glyphicon-remove-sign" ></span ></button >';
            var cell11 = row.insertCell(10).innerHTML = '<button type="button" class="btn btn-default btn-sm" ><span class= "glyphicon glyphicon-pencil" ></span ></button >';
            var cell12 = row.insertCell(11).innerHTML = '<button type="button" class="btn btn-success" onclick="func()">Save</button>'*/




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



@endsection


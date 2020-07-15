@extends('layouts._layout')
@section('content')
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
            <table class="table" id="personal_contacts">
                <thead>
                <th>full name</th>
                <th>Job title</th>
                <th>Telephone</th>
                <th>Email</th>
                <th><button type="button" class="btn btn-sm btn-success btn-round btn-fab" onclick="myFunction()" style="margin-bottom:+0.5em;">
                        <i class="material-icons">add</i>
                    </button></th>
               </thead>
               <td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="hidden" value="1" name="serial[]"/> <input type="text" value="" class="form-control required fullname-input" name="fullname[]"  minlength="0" maxlength="200"  autocomplete="off" ></div></div> </td>
                <td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><select  class="selectpicker required jobtitle" name="job_title_id[]" id="jobs"><option value=""></option>
                       @if(!empty($job_list))
                            @foreach($job_list  as $item1)

                                <option value="{{$item1->id}}" >{{$item1->job_title_name_na ?? ""}}</option>

                           @endforeach
                        @endif

                    </select></div></div>

                </td>
                <td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value="" class="form-control required tel" name="tel[]"   autocomplete="off"></div></div></td>
                         <td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value="" class="form-control email required " name="contact_email[]"  minlength="0" maxlength="200"  autocomplete="off" ></div></div></td>
             <td><button type="button"
                        rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"
                        data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                    <i class="material-icons">delete</i></button></td>


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
        $(function () {
            active_nev_link('visit-link');
           // DataTableCall('#personal_contacts',5);
            $('[data-toggle="tooltip"]').tooltip();

            $(document).on('click', '.btnTypeDelete', function (e) {
                e.preventDefault();
                $this = $(this);
                $($this).closest('tr').remove();

               // $($this).closest('tr').css('background', 'red').delay(500).hide(1000);


            });





        });



    </script>
    <script>
        $(document).ready(function () {
            active_nev_link('visit-link');
            funValidateForm();
        });

        $(document).on('submit', '#formVendorCreate', function (e) {
            if (!is_valid_form($(this))) {
                return false;
            }
            var checkInputs= checkInputNullCreate();
           //  console.log(checkInputs);
            if(checkInputs) {

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
                        $("#formVendorCreate").trigger("reset");
                        setTimeout(() => {
                            window.location.href = "{{route('vendors.index')}}";
                        }, 1000);

                        $('.loader').hide();
                    } else {
                       myNotify('warning', 'warning', 'warning', '5000', data.message);
                        //myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                    }
                    //$('#addBenf').prop("disabled", false);


                },
                error: function (data) {

                }
            });
         }
           else{
               @if(!empty($abortSave))
               myNotify('{{$abortSave["icon"]}}', '{{$abortSave["title"]}}', '{{$abortSave["type"]}}', '5000','{{$abortSave["text"]}}');
               @endif
                   return false;
           }
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
            var table = document.getElementById("personal_contacts");
            var totalRowCount = table.rows.length;
            if(totalRowCount-1<=9){
            var row = table.insertRow(-1);
            var job_lists = @json($job_list);
            var itemList="<option value=''></option>";
            $.each(job_lists, function (index, value) {
                itemList+="<option value=" + value.id + '>' + value["job_title_name_na"] + "</option>";
            });
            var cell1 = row.insertCell(0).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="hidden" value="1" name="serial[]"/> <input type="text" value="" class="form-control required fullname-input" name="fullname[]"  minlength="0" maxlength="200"  autocomplete="off" ></div></div>';


            var cell2 = row.insertCell(1).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><select minlength="0" maxlength="11" name="job_title_id[]"  class="contactpersons required  jobtitle">'+itemList+'</select></div></div>';
            var cell3 = row.insertCell(2).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value="" class="form-control required tel" name="tel[]"   autocomplete="off"></div></div>';
            var cell4 = row.insertCell(3).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value="" class="form-control email required  " name="contact_email[]"  minlength="0" maxlength="200"  autocomplete="off" ></div></div></div></div>';
            var cell5 = row.insertCell(4).innerHTML = '<button type="button" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"+data-placement="top"  title=" Delete "><i class="material-icons">delete</i></button></td>';


            $(".contactpersons").selectpicker();
            }
           /* var cell10 = row.insertCell(9).innerHTML = '<button type="button" class="btn btn-default btn-sm" ><span class= "glyphicon glyphicon-remove-sign" ></span ></button >';
            var cell11 = row.insertCell(10).innerHTML = '<button type="button" class="btn btn-default btn-sm" ><span class= "glyphicon glyphicon-pencil" ></span ></button >';
            var cell12 = row.insertCell(11).innerHTML = '<button type="button" class="btn btn-success" onclick="func()">Save</button>'*/

        else{
                myNotify('{{$abortAdd["icon"]}}', '{{$abortAdd["title"]}}', '{{$abortAdd["type"]}}', '5000','{{$abortAdd["text"]}}');
            }


        }
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

         function checkInputNullCreate(){
               var val=true;
             $("input.fullname-input").each(function() {

                 if(!$(this).val()){
                     //$(this).css("background","red !important");

                     val= false;
                 }
             });
             $("select.jobtitle").each(function() {
                 if(!$(this).val()){
                     //$(this).css("background","red !important");

                     val= false;
                 }
             });
              $("input.tel").each(function() {
                  if(!$(this).val()){
                      //$(this).css("background","red !important");

                      val=false;
                 }
             });
             $("input.email").each(function() {
                 if(!$(this).val()){
                     //$(this).css("background","red !important");

                     val=false;
                 }
             });
             return val;
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


@extends('layouts._layout')
@section('content')

  <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">-->
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['editvendor'] ?? 'Edit Vendors'}}
            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            {!! Form::open(['route' => 'vendors.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formVendorUpdate']) !!}
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
            <table  class="table" id="personal contacts">
                <thead>
                <th>full name</th>
                <th>Job title</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>
                    <button type="button" class="btn btn-sm btn-success btn-round btn-fab" onclick="myFunction()" style="margin-bottom:+0.5em;">
                        <i class="material-icons">add</i>
                    </button></th>
                </thead>
                <tbody>
                @if(!empty($contact))
                    @foreach($contact  as $index => $item)
                        <tr>

                            <td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="hidden" value="1" name="serial1[]"/><input type="text" value={{$item->full_name ?? ""}} class="form-control"  name="fullname1[]"  minlength="0" maxlength="200" alt="Website" autocomplete="off" ></div></div>
                            </td>
                            <td><select  class="selectpicker" name="job_title_id1[]" id="jobs"><option value="0"></option>
                                @if(!empty($job_list))
                                    @foreach($job_list  as $item1)

                                    <option value="{{$item1->id}}" @if($item->job_title_id == $item1->id) selected @endif >{{$item1->job_title_name_na ?? ""}}</option>

                                        @endforeach
                                    @endif

                                </select>

                            </td>
                            <td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value={{$item->tel_number ?? ""}} class="form-control"  name="tel1[]"  minlength="0" maxlength="200" alt="Website" autocomplete="off" ></div></div></td>
                            <td><div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="email" value={{$item->email ?? ""}} class="form-control   name="contact_email1[]"  minlength="0" maxlength="200" alt="Website" autocomplete="off" ></div></div></td>
                          <td> <button type="button"
                                    rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnTypeDelete"
                                    data-placement="top"  title=" {{$labels['delete'] ?? 'delete'}} ">
                                  <i class="material-icons">delete</i></button></td>

                        </tr>

                    @endforeach
                @endif

                </tbody>
            </table>



            <div class="col-md-12">

                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <a href="{{route('vendors.index')}}" class="btn btn-default btn-sm">
                            {{$labels['back'] ?? 'back'}}
                        </a>
                        <button btn="btnToggleDisabled" type="submit" id="btnEditvendor"
                                class="btn-sm btn btn-next btn-rose pull-right">
                            <div class="loader pull-left " style="display: none;"></div> {{$labels['save'] ?? 'save'}}
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
            DataTableCall('#personal contacts',5);
            $('[data-toggle="tooltip"]').tooltip();

            $(document).on('click', '.btnTypeDelete', function (e) {
                e.preventDefault();
                $this = $(this);
                swal({
                    text: '{{$messageDeleteType['text']}}',
                    confirmButtonClass: 'btn btn-success  btn-sm',
                    cancelButtonClass: 'btn btn-danger  btn-sm',
                    buttonsStyling: false,
                    showCancelButton: true
                }).then(result => {
                    if (result == true){

                                    $($this).closest('tr').css('background','red').delay(1000).hide(1000);

                                }else {
                                    myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                }


                        });

                })
            });



    </script>

    <script>
        $(document).ready(function () {
            active_nev_link('visit-link');
            funValidateForm();
            var state = '{{$vendorObj->state_id}}';
            console.log(state);
            var select=getCity(state);
            setTimeout(function(){
                var city='{{$vendorObj->city_id}}';
                console.log(city);
                $('#city_id').val(city);
                $("#city_id").selectpicker("refresh");
                }, 2000);






        });


        $(document).on('submit', '#formVendorUpdate', function (e) {

            if (!is_valid_form($(this))) {
                return false;
            }

            e.preventDefault();

            var form = new FormData($(this)[0]);
            var url = $(this).attr('action');
            // alert($(this).attr('action'));s
            $.ajax({
                url: url,
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnEditvendor').attr("disabled", true);
                    $('.loader').show();
                },
                success: function (data) {
                    $('#btnEditvendor').attr("disabled", false);
                    $('.loader').hide();
                    if (data.status == true) {
                        myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                        $('.loader').hide();
                    }
                    setTimeout(() => {
                        window.location.href = "{{route('vendors.index')}}";
                    }, 1000);


                },
                error: function (data) {

                }
            });

        });



    </script>

    <script>
        function myFunction() {
            /*  var d = 'Url.Action("numrow")';*/
            var table = document.getElementById("personal contacts");
            var select=document.getElementById("jobs");
            var job_lists = @json($job_list);
            var itemList='<option value="0"></option>';
            $.each(job_lists, function (index, value) {
                itemList+='<option value=' + value.id + '>' + value["job_title_name_na"] + '</option>';
            });



            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="hidden" value="1" name="serial[]"/><input type="text" value="" class="form-control  " name="fullname[]"  minlength="0" maxlength="200" alt="Website" autocomplete="off" ></div></div>'
            var cell2 = row.insertCell(1).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><select name="job_title_id[]"   class="contactpersons selectpicker">'+itemList+'</select></div></div>';
            var cell3 = row.insertCell(2).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="text" value="" class="form-control  " name="tel[]"  minlength="0" maxlength="200" alt="Website" autocomplete="off"></div></div>';
            var cell4 = row.insertCell(3).innerHTML = '<div class="col-md-12"><div class="form-group has-default bmd-form-group"><input type="email" value="" class="form-control  " name="contact_email[]"  minlength="0" maxlength="200" alt="Website" autocomplete="off" ></div></div></div></div>';
            var cell5 = row.insertCell(4).innerHTML = '<button type="button" class="btn btn-sm btn-danger btn-round btn-fab" onclick="func()"><i class="material-icons">delete</i></button>';

            $(".contactpersons").selectpicker();
            /* var cell10 = row.insertCell(9).innerHTML = '<button type="button" class="btn btn-default btn-sm" ><span class= "glyphicon glyphicon-remove-sign" ></span ></button >';
             var cell11 = row.insertCell(10).innerHTML = '<button type="button" class="btn btn-default btn-sm" ><span class= "glyphicon glyphicon-pencil" ></span ></button >';
             var cell12 = row.insertCell(11).innerHTML = '<button type="button" class="btn btn-success" onclick="func()">Save</button>'*/




        }
        $( "#state_id" ).change(function() {
            var state = $('#state_id').find(":selected").val();
            getCity(state);
        });
        function getCity(state) {
            var list ="<option selected  value=''></option>";
            $id=state;
            $.get('{{url('/city/by')}}'+'/'+$id,function(data){
                $.each(data.city, function (index, value) {
                    list+='<option value=' +index + '>' + value + '</option>';
                });
                $("#city_id").html(list);
                $("#city_id").selectpicker("refresh");
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

@extends('layouts._layout')

@section('content')


    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">business_center</i>
            </div>
            <h4 class="card-title">
                {{$labels['screen_donor'] ?? 'screen_donor'}}
            </h4>
        </div>
        <div class="card-body ">
            <a href="{{route('project.donors.donorWizard')}}" class="mytooltip btn-setting-nav"
               data-toggle="tooltip" data-placement="top" title="">
                <i class="material-icons">add</i><span class="mytooltiptext"> {{$labels['add'] ?? 'add'}} </span>
            </a>

            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{$labels['english_donor_name'] ?? 'english_donor_name'}} </th>
                    <th>{{$labels['arabic_donor_name'] ?? 'arabic_donor_name'}}</th>
                    <th>{{$labels['type'] ?? 'type'}}</th>
                    <th> {{$labels['donor_status'] ?? 'donor_status'}}</th>
                    <th>{{$labels['actions'] ?? 'actions'}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($donors  as $index=>$donor)

                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$donor->donor_name_na}}</td>
                        <td>{{$donor->donor_name_fo}}</td>
                        <td>@if($donor->type==0)
                               <span class="badge badge-info">Funder</span>
                                 @else
                            <span class="badge badge-warning">Partner</span>
                                 @endif</td>
                        <td> {!! activeLabel($donor->ishidden) !!}</td>
                        <td>

                            <a href="{{route('project.donors.donorWizard',$donor->id)}}"
                               class="mytooltip btn-setting-nav" data-toggle="tooltip"
                               data-placement="top" title="">
                                <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}} </span>
                            </a>

                            <a href="{{route('project.donors.destroy',$donor->id)}}"
                               class="mytooltip btn-setting-nav" id="deleteDonor"
                               data-tooltip="tooltip" data-placement="right" title="">
                                <i class="material-icons">delete</i><span class="mytooltiptext"> {{$labels['delete'] ?? 'delete'}}</span>
                            </a>


                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
@section('script')



    <script>

        $(document).ready(function () {
            active_nev_link('donors1');
            DataTableCall('#table',6);

            $('[data-toggle="tooltip"]').tooltip();


        })

        $(document).on('click', '#deleteDonor', function (e) {
            e.preventDefault();
            $this = $(this);

            swal({
                text: '{{$messageDeleteDonor['text']}}',
                confirmButtonClass: 'btn btn-success  btn-sm',
                cancelButtonClass: 'btn btn-danger  btn-sm',
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
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                                $('#contentModal .close').click();
                            } else {
                                myNotify(data.message.icon, data.message.title, data.message.type, '5000', data.message.text);
                            }
                        },
                        error: function () {
                        }
                    });
                }
            })
        });

    </script>
@endsection

@section('js')
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection



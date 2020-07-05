@extends('layouts._layout')

@section('content')



    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">Screen</h4>
        </div>
        <div class="card-body ">


            {{--{!! Form::open(['route' => 'label.store' ,'action'=>'post' ,'id'=>'formLabelCreate']) !!}--}}
            {{--@if ($errors->any())--}}
            {{--<div class="alert alert-danger">--}}
            {{--<ul>--}}
            {{--@foreach ($errors->all() as $error)--}}
            {{--<li>{{ $error }}</li>--}}
            {{--@endforeach--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--@endif--}}

            {{--<div class='row'>--}}
            {{--<label for='screen_id' class='col-md-3 col-form-label'></label>--}}
            {{--<div class='col-md-7'>--}}
            {{--<div class='form-group has-default bmd-form-group'>--}}
            {{--{!!  Form::select('screen_id',$screens,null,['class'=>'form-control  selectpicker ','data-style'=>'btn btn-link']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class='row'>--}}
            {{--<label for='lang_id' class='col-md-3 col-form-label'></label>--}}
            {{--<div class='col-md-7'>--}}
            {{--<div class='form-group has-default bmd-form-group'>--}}
            {{--{!!  Form::select('lang_id',['1'=>'English' ,'2'=>'Arabic'],null,['class'=>'form-control  selectpicker ','data-style'=>'btn btn-link']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="col-md-12">--}}

            {{--<div class="card-footer ml-auto mr-auto">--}}
            {{--<div class="ml-auto mr-auto">--}}
            {{--<a href="{{route('goals.main.index')}}" class="btn btn-default">Back</a>--}}
            {{--<button type="submit" class="btn btn-next btn-rose pull-right">--}}
            {{--{{ inputButtonName( 'save') }}--}}
            {{--</button>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="material-datatables">
            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Screen Name Enghish</th>
                    <th>Screen Name Arabic</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($screens as $index=>$screen)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$screen->screen_name_na}}</td>
                        <td>{{$screen->screen_name_fo}}</td>
                        <td>
                            <a href="{{route('setting.label.create',[$screen->id,1])}}" rel="tooltip" class="btn btn-sm btn-primary btn-round "
                               rel="tooltip" data-original-title=""
                               data-placement="top" id="">
                                English
                                <i class="material-icons">language</i>
                            </a>
                            <a href="{{route('setting.label.create',[$screen->id,2])}}" rel="tooltip" class="btn btn-sm btn-label btn-round "
                               rel="tooltip" data-original-title=""
                               data-placement="top" id="">
                                Arabic
                                <i class="material-icons">language</i>
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
    $(function () {
        DataTableCall('#table');

        $('[data-toggle="tooltip"]').tooltip();
        //CheckSessionStatus(icon = 'done', title = 'SUCCESS', type = 'success', delay = '5000');
    })

</script>

@endsection



@section('js')

    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
        <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection


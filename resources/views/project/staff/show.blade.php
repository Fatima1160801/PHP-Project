@extends('layouts._layout')

@section('content')
@include('project.staff.show_render')
{{--    <div class="card ">--}}
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">business_center--}}
{{--                </i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">Show Staff</h4>--}}

{{--        </div>--}}

{{--        --}}
{{--        --}}
{{--        <div class="card-body ">--}}
{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            {!! Form::hidden('id',$data->id ,['class'=>'hidden','id'=>'id']) !!}--}}

{{--                                    {!! $html !!}--}}

{{--        {!! Form::close() !!}--}}

{{--        <div class="card-footer ml-auto mr-auto">--}}
{{--                <div class="ml-auto mr-auto">--}}
{{--                        <a href="{{route('project.staff.index')}}"class="btn btn-sm btn-default pull-left">--}}
{{--                            {{$labels['back'] ?? 'back'}}--}}
{{--                        </a>--}}
{{--                </div>--}}
{{--        </div>--}}
{{--    </div>--}}



@endsection
@section('script')
<script>
     $(document).ready(function(){
         active_nev_link('staff-link');
         $('.selectpicker').selectpicker();



     })
            datetimepicker();
            function datetimepicker() {
            $('.datetimepicker').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                },
                format: 'DD/MM/YYYY'
            });
        }
    </script>
@endsection




@section('js')

  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
@endsection
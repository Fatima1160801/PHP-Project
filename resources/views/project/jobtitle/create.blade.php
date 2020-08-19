@extends('layouts._layout')

@section('content')

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">work--}}
{{--                </i>--}}
{{--            </div>--}}
            <h4 class="card-title">
                {{$labels['screen_job_title_add'] ?? 'screen_job_title_add'}}
            </h4>

        </div>


        {!! Form::open(['route' => 'project.jobtitle.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAdd']) !!}
        <div class="card-body ">
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

            <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                            <a href="{{route('project.jobtitle.index')}}"class="btn btn-sm btn-default pull-left">
                                {{$labels['back'] ?? 'back'}}</a>
                            <button  btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="saveJobtitle">
                                {{$labels['save'] ?? 'save'}}


                                <div class="loader pull-left" style="display: none;">  </div>
                            </button>
                    </div>
            </div>

            {!! Form::close() !!}
    </div>



@endsection
@section('script')
<script>
     $(document).ready(function(){
         $('.selectpicker').selectpicker();
         active_nev_link('job_title');
         funValidateForm();
     })

     $(document).on('submit','#formAdd', function (e) {
         if (!is_valid_form($(this))) {
             return false
         }
     })
    </script>
@endsection

@section('js')
    <!-- Forms Validations Plugin -->
        <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>


        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
@endsection
@extends('layouts._layout')

@section('content')

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
            <div class="card-icon">
                <i class="material-icons">business_center
                </i>
            </div>
            <h4 class="card-title">Show {{$screenName}}</h4>
        </div>

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

            {!! Form::hidden('id',$data->id ,['class'=>'hidden','id'=>'id']) !!}

                {!! $html !!}
            {!! Form::close() !!}

        <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    <a href="{{route('project.donors.index')}}"class="btn btn-sm btn-default pull-left">
                        {{$labels['back'] ?? 'back'}}
                    </a>                </div>
        </div>

    </div>



@endsection
@section('script')
<script>
     $(document).ready(function(){
         $('.selectpicker').selectpicker();

     })
       
    </script>
@endsection




@section('js')
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
@endsection


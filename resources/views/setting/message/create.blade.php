@extends('layouts._layout')

@section('content')



    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">{{$screenName}}</h4>
        </div>
        <div class="card-body ">


            {!! Form::open(['route' => 'setting.message.store' ,'action'=>'post' ,'id'=>'formGoalsCreate']) !!}
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


            <div class="col-md-12">

                <div class="card-footer ml-auto mr-auto">
                    <div class="ml-auto mr-auto">
                        <a href="{{route('setting.message.index')}}" class="btn btn-default">
                            {{$labels['back'] ?? 'back'}}
                        </a>
                        <button type="submit" class="btn btn-next btn-rose pull-right">

                            {{$labels['save'] ?? 'save'}}
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
        $('.selectpicker').selectpicker();
    })
</script>
@endsection



@section('js')

    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
@endsection


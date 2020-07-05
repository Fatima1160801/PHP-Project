@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"> Screen</div>

                    <div class="panel-body">

                        @foreach($screen as $s)
                             <a href="{{route('permission.screen.screenuser',$s->screen_id)}}" class="btn-primary btn ">
                                 {{$s->screen_name_na}}
                             </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

@endsection



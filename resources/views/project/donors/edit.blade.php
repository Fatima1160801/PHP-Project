{!! Form::open(['route' => 'project.donors.store' ,'action'=>'post' ,'novalidate'=>'novalidate','id'=>'formEditDonor','enctype'=>'multipart/form-data']) !!}
{{ csrf_field() }}
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

<div class="">
    <div class="ml-auto mr-auto">

    </div>
</div>


<div class="col-md-12">

    <a href="#" class="btn btn-next btn-default  btn-sm pull-right " id="btnNextDonorContact">
        {{$labels['next'] ?? 'next'}}
    </a>

    <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="updateDonor">

        {{$labels['save'] ?? 'save'}}
        <div class="loader pull-left" style="display: none;"></div>
    </button>

    <a href="{{route('project.donors.index')}}" class="btn  btn-default  btn-sm pull-left" id="">
        {{$labels['back'] ?? 'back'}}
    </a>

</div>


{!! Form::close() !!}





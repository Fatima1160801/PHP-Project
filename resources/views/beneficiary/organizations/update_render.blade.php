<div class="card-body ">

    <div id="result-msg"></div>


    {!! Form::open(['route' => 'beneficiary.oraganizations.update' ,'action'=>'post' ,'id'=>'formBeneficiaryOrgUpdate']) !!}
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
{{--                <a href="{{route('beneficiary.oraganizations.index')}}" class="btn btn-default  btn-sm ">--}}
{{--                    {{$labels['back']??'back'}}--}}
{{--                </a>--}}
                <button type="button" class="btn btn-default btn-sm" onclick="defaultVal()">
                    {{$labels['back'] ?? 'back'}}
                </button>
                <button btn="btnToggleDisabled" type="submit" id="btnEditBenOrg" class="btn btn-sm  btn-next btn-rose pull-right">
                    <div class="loader pull-left" style="display: none;"></div>
                    {{$labels['save']??'save'}}
                </button>
            </div>
        </div>
    </div>


    {!! Form::close() !!}
</div>
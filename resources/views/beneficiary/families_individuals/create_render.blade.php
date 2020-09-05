<div class="card-body ">

    <div id="result-msg"></div>


    {!! Form::open(['route' => 'beneficiary.fam_indev.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formBeneficiaryCreate']) !!}
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

    <div class="row">
        @if($customFields->count() > 0)
            <input type="hidden" name="custom_fields_count" value="{{$customFields->count()}}">
            @foreach($customFields as $customField)
                {!! customField($customField,json_decode($beneficiary->custom_fields,true)) !!}
            @endforeach
        @endif
    </div>
    <hr>

    <div class="col-md-12">
        <div class="card-footer ml-auto mr-auto">
            <div class="ml-auto mr-auto">
{{--                @if($id==1)--}}
{{--                <a href="{{route('beneficiary.fam_indev.index')}}" class="btn btn-default btn-sm">--}}
{{--                    {{$labels['back'] ?? 'back'}}--}}
{{--                </a>--}}
{{--                @else--}}
                    <button type="button" class="btn btn-default btn-sm" onclick="defaultVal()">
                        {{$labels['back'] ?? 'back'}}
                    </button>
{{--                    @endif--}}
                <button type="submit" id="addBenf" class="btn btn-next btn-rose pull-right btn-sm" btn="btnToggleDisabled">
                    <div class="loader pull-left" style="display: none;"></div>
                    {{$labels['save'] ?? 'save'}}
                </button>
            </div>
        </div>
    </div>


    {!! Form::close() !!}
</div>
<div class="modal fade modal-mini modal-primary" id="myModal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تحذير</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
            </div>
            <div class="modal-body">
                <p style=" text-align: center; font-size: 14px; line-height: 24px; ">Are you sure you want to do this?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-link" data-dismiss="modal">
                    لا
                </button>
                <button id="btnModelSave" type="button" class="btn btn-success btn-link">نعم

                </button>
            </div>
        </div>
    </div>
</div>

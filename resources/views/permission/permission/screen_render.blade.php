{{--<div class="card " style="margin-bottom: -12px;--}}
{{--    margin-top: 0;--}}
{{--    margin-right: 3px !important;--}}
{{--    width: 110%;--}}
{{--    /* margin-right: -14px; */--}}
{{--    margin-left: -20px;">--}}
    <div class="card-header card-header-rose  card-header-icon" id="createmodal">
        {{--            <div class="card-icon">--}}
        {{--                <i class="material-icons">desktop_windows</i>--}}
        {{--            </div>--}}
{{--        <h4 class="card-title">--}}
{{--            {{$labels['brand'] ?? ' Brand'}}--}}
{{--        </h4>--}}
    </div>
    <div class="card-body ">
        <button type="button" hidden btn="btnToggleDisabled" data-id="{{$id}}" id="btnGroupPrm"
                class="btn btn-next pull-right btn-sm btn-rose ">
            <div class="loader pull-left" ></div> {{$labels['select'] ?? 'Select'}}
        </button>
        <div id="result-msg"></div>

        {!! $html !!}

        <div id="loader" class="col-md-2" style="padding-left:300px;"><div class="loader pull-center" style="display: none;swidth: 30px;
 height: 30px;"></div></div>

        <div class="col-md-12" id="grant_result">

            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">

                </div>
            </div>
        </div>

    </div>
{{--</div>--}}
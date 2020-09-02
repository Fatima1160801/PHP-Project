<div class="card-header card-header-rose  card-header-icon" style="
    margin-top: -12%;
">
    {{--            <div class="card-icon">--}}
    {{--                <i class="material-icons">desktop_windows</i>--}}
    {{--            </div>--}}
    <h4 class="card-title"style="font-weight: bold;text-align: center;">
        {{$labels['LabelsSettings'] ?? 'LabelsSettings'}}
    </h4>
</div>
<div class="card-body ">

    <div id="result-msg"></div>


    {!! Form::open(['route'=>'labelsSettings.search','novalidate'=>'novalidate','method'=>'post' ,'id'=>'formSearchLabel']) !!}

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
    <input type="hidden" name="button_clicked" id="button_clicked" value="">
    <div class="col-md-12">
        <div class="card-footer ml-auto mr-auto">
            <div class="ml-auto mr-auto">
                <button btn="btnToggleDisabled" type="submit" id="btnSearch"
                        class="btn btn-next btn-rose pull-right btn-sm">
                    <div class="loader pull-left" style="display: none;"></div> {{$labels['search'] ?? 'search'}}
                </button>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">

            <div class=" col-md-3 bolder">
                {{$labels['label'] ?? 'Label'}}
            </div>
            <div class=" col-md-3 bolder">
                {{$labels['labelHint'] ?? 'Label  Hint'}}
            </div>
            <div class=" col-md-3 bolder">
                {{$labels['labelNew'] ?? 'Label New'}}
            </div>
            <div class=" col-md-3 bolder">
                {{$labels['labelHintNew'] ?? 'Label Hint New'}}
            </div>
        </div>
    </div>
    <hr>
    @if(!empty($results) && sizeof($results) >0)
        @foreach($results as $result)
            <div class="col-md-12">
                <div class="row">
                    <!-- <label for="interface_type_na" class="col-md-1 col-form-label">label</label> -->
                    <div class=" col-md-3">
                        <div class="form-group has-default bmd-form-group">
                            <label>{{$result->label ?? ""}}</label>
                            {{--<input type="text" value="{{$result->label}}" class="form-control  " name="label_{{$result->id}}" id="label_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">--}}
                        </div>
                    </div>
                    <div class=" col-md-3">
                        <div class="form-group has-default bmd-form-group">
                            <label>{{$result->label_hint ?? ""}}</label>
                            {{--<input type="text" value="{{$result->label_hint}}" class="form-control  " name="labelHint_{{$result->id}}" id="labelHint_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">--}}
                        </div>
                    </div>
                    <div class=" col-md-3">
                        <div class="form-group has-default bmd-form-group">
                            <input type="text" value="" class="form-control  " name="labelNew_{{$result->id}}" id="labelNew_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">
                        </div>
                    </div>
                    <div class=" col-md-3">
                        <div class="form-group has-default bmd-form-group">
                            <input type="text" value="" class="form-control  " name="labelHintNew_{{$result->id}}" id="labelHintNew_{{$result->id}}" required="" minlength="0" maxlength="100" alt="Inerface">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-md-12">

            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    <button btn="btnToggleDisabled" type="submit" id="btnSave"
                            class="btn btn-next btn-rose pull-right btn-sm">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                </div>
            </div>
        </div>
    @endif
    {!! Form::close() !!}
{{--    <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.system.screen')}}"'>Back</button>--}}

</div>
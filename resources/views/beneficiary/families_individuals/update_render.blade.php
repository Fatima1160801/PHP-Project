<div class="card-body">
    <div id="result-msg"></div>
    <ul id="taps_" class="nav nav-pills nav-pills-warning" role="tablist">
        <li class="nav-item" style="    width: 49%;">
            <a class="nav-link active" data-toggle="tab" href="#benInfo" role="tablist">
                {{$labels['beneficiary_info'] ?? 'beneficiary_info'}}
            </a>
        </li>
        @if($beneficiary->ben_type_id == 2)
            <li id="ben_fam_tap" class="nav-item" style="    width: 49%;">
                <a class="nav-link" data-toggle="tab" href="#benFam" role="tablist">
                    {{$labels['family_individuals'] ?? 'family_individuals'}}
                </a>
            </li>
        @endif
    </ul>
    <div class="tab-content tab-space">
        <div class="tab-pane active" id="benInfo">
            {!! Form::open(['route' => 'beneficiary.fam_indev.update' ,'action'=>'post' ,'id'=>'formBeneficiaryUpdate']) !!}
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
{{--                        @if($id==1)--}}
                        {{--                <a href="{{route('beneficiary.fam_indev.index')}}" class="btn btn-default btn-sm">--}}
                        {{--                    {{$labels['back'] ?? 'back'}}--}}
                        {{--                </a>--}}
                        {{--                @else--}}
                        <button type="button" class="btn btn-default btn-sm" onclick="defaultVal()">
                            {{$labels['back'] ?? 'back'}}
                        </button>
                        {{--                    @endif--}}
                        <button type="submit" id="editBenf" class="btn btn-next btn-rose pull-right btn-sm">
                            <div class="loader pull-left" style="display: none;"></div>
                            {{$labels['save'] ?? 'save'}}
                        </button>
                    </div>
                </div>
            </div>


            {!! Form::close() !!}
        </div>
        <div class="tab-pane" id="benFam">
            <button type="button" id="btn-createfm-modal" href="{{route('beneficiary.fam_indev.createfm',$beneficiary->id)}}" class="btn btn-primary "
                    data-toggle="tooltip"
                    title="  {{$labels['add_individual'] ?? 'add_individual'}}" >
                <i class="material-icons">add</i>
                {{$labels['add_individual'] ?? 'add_individual'}}
            </button>

            <table class="table" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>
                        {{$labels['individual_name'] ?? 'individual_name'}}
                    </th>
                    <th>
                        {{$labels['identification_number'] ?? 'identification_number'}}
                    </th>
                    <th>
                        {{$labels['relation_type'] ?? 'relation_type'}}
                    </th>
                    <th>
                        {{$labels['added_at'] ?? 'added_at'}}
                    </th>
                    <th>
                        {{$labels['actions'] ?? 'actions'}}
                    </th>
                </tr>
                </thead>
                <tbody id="enfamtable">
                @foreach($ben_familiy_members  as $index=>$ben_familiy_member)

                    <tr data-id="{{$ben_familiy_member->id}}">
                        <td>{{$index+1}}</td>
                        <td>{{$ben_familiy_member->ind_name_na}}</td>
                        <td>{{$ben_familiy_member->ind_idno}}</td>
                        <td><?php $x = DB::table('c_relation_types')->where('id', $ben_familiy_member->relation_type)->first(); echo Auth::user()->lang_id == 1 ? $x->relation_name_na : $x->relation_name_fo; ?></td>
                        <td>{{$ben_familiy_member->created_at}}</td>
                        <td>
{{--                            <a href="{{route('beneficiary.fam_indev.geteditfm',$ben_familiy_member->id)}}"--}}
{{--                                    class="mytooltip btn-setting-nav editBenFam"  data-toggle="tooltip" data-placement="top" title="--}}
{{--                                            ">--}}
{{--                                <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>--}}
{{--                            </a>--}}
                            <a href="#" data-id="{{$ben_familiy_member->id}}"
                                                                class="mytooltip btn-setting-nav editBenFam"  data-toggle="tooltip" data-placement="top" title="
                                                                        ">
                                                            <i class="material-icons">edit</i><span class="mytooltiptext">{{$labels['edit'] ?? 'edit'}}</span>
                                                        </a>
                            <a href="{{ route('beneficiary.fam_indev.deletefm',$ben_familiy_member->id)}}"
                               id="btnFamIndevDelete" rel="tooltip" class="mytooltip btn-setting-nav"
                               data-placement="top"  title="
                                   ">
                                <i class="material-icons">delete</i><span class="mytooltiptext"> {{$labels['delete'] ?? 'delete'}}</span>
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="createfmModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-signup" role="document">
                <div class="modal-content">
                    <div class="card card-signup card-plain">
                        <div class="modal-header">
                            <h5 class="modal-title card-title">
                                {{$labels['add_individual'] ?? 'add_individual'}}


                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                {!! Form::open(['route' => 'beneficiary.fam_indev.storefm' ,'action'=>'post' ,'id'=>'formBeneficiaryFamCreate']) !!}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div id="createfm-modal-form"></div>


                                <div class="col-md-12">

                                    <div class="card-footer ml-auto mr-auto">
                                        <div class="ml-auto mr-auto">
                                            <a id="modal-dismiss" href="#" class="btn btn-default btn-sm">
                                                {{$labels['cancel'] ?? 'cancel'}}

                                            </a>
                                            <button type="submit" class="btn btn-next btn-rose pull-right btn-sm" id="saveInd">
                                                {{$labels['save'] ?? 'save'}}
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editfmModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-signup" role="document">
                <div class="modal-content">
                    <div class="card card-signup card-plain">
                        <div class="modal-header">
                            <h5 class="modal-title card-title">
                                {{$labels['edit_individual'] ?? 'edit_individual'}}

                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="material-icons">clear</i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                {!! Form::open(['route' => 'beneficiary.fam_indev.updatefm' ,'action'=>'post' ,'id'=>'formBeneficiaryFamUpdate']) !!}
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div id="editfmModal-modal-form"></div>


                                <div class="col-md-12">

                                    <div class="card-footer ml-auto mr-auto">
                                        <div class="ml-auto mr-auto">
                                            <a id="modal-dismiss" href="#" class="btn btn-default btn-sm">
                                                {{$labels['cancel'] ?? 'cancel'}}

                                            </a>
                                            <button type="submit" class="btn btn-next btn-rose pull-right btn-sm" id="updatefmind">
                                                {{$labels['save'] ?? 'save'}}

                                            </button>
                                        </div>
                                    </div>
                                </div>


                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
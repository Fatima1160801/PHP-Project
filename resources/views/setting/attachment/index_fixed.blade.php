@if(!empty($allow_display))
    @if($allow_display==true)
{!! Form::open( ['route' => 'update.full.desc.update','action'=>'post' ,'id'=>'formEditFullDesc','style="margin-bottom: 30px;"']) !!}
<label for='edit_note' class='col-form-label'>Concept Full Description</label>
<div class='form-group has-default bmd-form-group'>
    @if(!empty($found_full_desc) )
        <textarea class='form-control' rows="10" name='full_desc' id='full_desc' required minLength='0' maxLength='4000' aria-required="true" aria-invalid="false" >{{$found_full_desc ? $found_full_desc->full_desc : ""}}</textarea>
    @else
        <textarea class='form-control' rows="10" name='full_desc' id='full_desc' required minLength='0' maxLength='4000' aria-required="true" aria-invalid="false" ></textarea>
    @endif
    <input type="hidden" value="{{$pr_id ?? 0}}" name="primary_id">
    <input type="hidden" value="{{$interface_type ?? 0}}" name="inter_id">
</div>
<button type="submit" class="btn btn-next btn-sm  btn-rose pull-right">
    <div class="loader pull-left" style="display: none;"></div>
    {{$labels['save'] ?? 'save'}}
</button>
{!! Form::close() !!}
    @endif
@endif


<div class="col-md-12" id="fixed">
    <div class="row">
        @if(sizeof($doc_setting))
            @foreach($doc_setting as $doc)
                @php $fixed = $fixed_doc->where('attachment_type_id',$doc->attachment_type_id)->first();    @endphp
                @if($fixed)


                    <div class="col-md-3" id="fixed_type_{{$fixed->attachment_type_id}}" style="padding-top: 48px;">
                        <div class="card card-profile" style="box-shadow: 0 1px 9px 3px rgba(12, 12, 12, 0.14);">
                            <div class="card-avatar">
                                <a href="#pablo">
                                    <img class="img" id="doc_img_"
                                         src="{{asset('images/filetype/'.strtolower($fixed->file_type).'.png')}}"
                                         style="width: 100px;height:100px;    padding: 13px;">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-category text-gray">{{$fixed->{'attachment_type_'.lang_character()} }}</h6>
                                <h4 class="card-title" id="doc_title_">{{$fixed->file_title ?? ""}}</h4>
                                <p class="card-description" id="doc_descpt_">
                                    {{$fixed->file_desc?? ""}}
                                </p>

                                <button data-href="{{route('attachments.fixed.edit',["id"=>$fixed->id ?? ""])}}"
                                        id="btnEditFixedFileModal" class="btn btn-sm btn-primary btn-round btn-fab"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Edit File">
                                    <i class="material-icons">open_in_browser</i>
                                </button>

                                <a href="{{p_url('/'.$fixed->file_path)}}" rel="tooltip" download
                                   class="btn btn-sm btn-info btn-round btn-fab download_link"
                                   rel="tooltip" data-original-title=""
                                   title=" {{$labels['download']??'download'}}"
                                   data-placement="top" id="doc_file_path_{{$fixed->id}}">
                                    <i class="material-icons">cloud_download</i>
                                </a>
                            </div>
                        </div>
                    </div>



                    {{--<div class='col-md-6 pull-left' id="fixed_type_{{$fixed->attachment_type_id}}" >--}}
                    {{--<div class='row'>--}}
                    {{--<div class="col-md-12">--}}
                    {{--<h2 class='col-md-3 col-form-label pull-left text-dirct text-bold'> {{$labels['document_type']??'Type'}}"</h2>--}}
                    {{--<div class="col-md-9 pull-right">--}}
                    {{--<div class="col-md-4 pull-left">--}}
                    {{--<button   data-href="{{route('attachments.fixed.edit',["id"=>$fixed->id ?? ""])}}" id="btnEditFixedFileModal" class="btn btn-sm btn-primary btn-round btn-fab" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit File">--}}
                    {{--<i class="material-icons">open_in_browser</i></button>--}}
                    {{--<a href="{{p_url('/'.$fixed->file_path)}}" rel="tooltip" download--}}
                    {{--class="btn btn-sm btn-info btn-round btn-fab download_link"--}}
                    {{--rel="tooltip" data-original-title=""--}}
                    {{--title=" {{$labels['download']??'download'}}"--}}
                    {{--data-placement="top" id="doc_file_path_{{$fixed->id}}">--}}
                    {{--<i class="material-icons">cloud_download</i>--}}
                    {{--</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-5 pull-left">--}}
                    {{--<h2  class='col-md-12 col-form-label pull-right text-dirct' id="categ_type_name_{{$fixed->id}}">{{$fixed->{'attachment_type_'.lang_character()} }}</h2>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-12">--}}
                    {{--<h2 class='col-md-4 col-form-label pull-left text-dirct text-bold'>{{$labels['document_title']??'Title'}}</h2>--}}
                    {{--<h2 id="doc_title_" class='col-md-8 col-form-label pull-right text-dirct'>{{$fixed->file_title ?? ""}}</h2>--}}

                    {{--</div>--}}
                    {{--<div class="col-md-12">--}}
                    {{--<h2 class='col-md-4 col-form-label pull-left text-dirct text-bold'>{{$labels['document_desc']??'Description'}}</h2>--}}
                    {{--<p id="doc_descpt_" class='col-md-8 col-form-label pull-right text-dirct'>{{$fixed->file_desc?? ""}}</p>--}}

                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                @else




                    <div class="col-md-3" id="fixed_type_{{$doc->attachment_type_id}}" style="padding-top: 48px;">
                        <div class="card card-profile" style="box-shadow: 0 1px 9px 3px rgba(12, 12, 12, 0.14);">
                            <div class="card-avatar">
                                <a href="#pablo">
                                    <img class="img" id="doc_img_"

                                         src="{{asset('images/filetype/upload.png')}}"
                                         style="width: 100px;height:100px;    padding: 22px;">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-category text-gray">{{$doc->{'attachment_type_'.lang_character()} }}</h6>
                                <h4 class="card-title" id="doc_title_"> </h4>
                                <p class="card-description" id="doc_descpt_">

                                </p>

                                <button data-href="{{route('attachments.fixed.create',["id"=>$doc->attachment_type_id ?? ""])}}"
                                        id="btnFixedFileModal" class="btn btn-sm btn-primary btn-round btn-fab"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Add File">
                                    <i class="material-icons">open_in_browser</i>
                                </button>

                                <button style="display: none" data-href="" id="btnEditFixedFileModal"
                                        class="btn btn-sm btn-primary btn-round btn-fab" data-toggle="tooltip"
                                        data-placement="top" title="" data-original-title="Edit File">
                                    <i class="material-icons">open_in_browser</i>
                                </button>

                                <a href="" rel="tooltip" download
                                   class="btn btn-sm btn-info btn-round btn-fab download_link"
                                   style="display: none"
                                   rel="tooltip" data-original-title=""
                                   title=" {{$labels['download']??'download'}}"
                                   data-placement="top" id="">
                                    <i class="material-icons">cloud_download</i>
                                </a>

                            </div>
                        </div>
                    </div>



                    {{--<div class='col-md-6 pull-left' id="fixed_type_{{$doc->attachment_type_id}}">--}}
                        {{--<div class='row'>--}}
                            {{--<div class="col-md-12">--}}
                                {{--<h2 class='col-md-3 col-form-label pull-left text-dirct text-bold'> {{$labels['document_type']??'Type'}}--}}
                                    {{--"</h2>--}}
                                {{--<div class="col-md-9 pull-right">--}}
                                    {{--<div class="col-md-4 pull-left">--}}

                                        {{--<button data-href="{{route('attachments.fixed.create',["id"=>$doc->attachment_type_id ?? ""])}}"--}}
                                                {{--id="btnFixedFileModal" class="btn btn-sm btn-primary btn-round btn-fab"--}}
                                                {{--data-toggle="tooltip" data-placement="top" title=""--}}
                                                {{--data-original-title="Add File">--}}
                                            {{--<i class="material-icons">open_in_browser</i>--}}
                                        {{--</button>--}}

                                        {{--<button style="display: none" data-href="" id="btnEditFixedFileModal"--}}
                                                {{--class="btn btn-sm btn-primary btn-round btn-fab" data-toggle="tooltip"--}}
                                                {{--data-placement="top" title="" data-original-title="Edit File">--}}
                                            {{--<i class="material-icons">open_in_browser</i>--}}
                                        {{--</button>--}}

                                        {{--<a href="" rel="tooltip" download--}}
                                           {{--class="btn btn-sm btn-info btn-round btn-fab download_link"--}}
                                           {{--style="display: none"--}}
                                           {{--rel="tooltip" data-original-title=""--}}
                                           {{--title=" {{$labels['download']??'download'}}"--}}
                                           {{--data-placement="top" id="">--}}
                                            {{--<i class="material-icons">cloud_download</i>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-5 pull-left">--}}
                                        {{--<h2 class='col-md-12 col-form-label pull-right text-dirct'--}}
                                            {{--id="">{{$doc->{'attachment_type_'.lang_character()} }}</h2>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-12">--}}
                                {{--<h2 class='col-md-4 col-form-label pull-left text-dirct text-bold'>{{$labels['document_title']??'Title'}}</h2>--}}
                                {{--<h2 id="doc_title_" class='col-md-8 col-form-label pull-right text-dirct'></h2>--}}

                            {{--</div>--}}
                            {{--<div class="col-md-12">--}}
                                {{--<h2 class='col-md-4 col-form-label pull-left text-dirct text-bold'>{{$labels['document_desc']??'Description'}}</h2>--}}
                                {{--<p id="doc_descpt_" class='col-md-8 col-form-label pull-right text-dirct'></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                @endif
            @endforeach
        @endif
    </div>
</div>

<input type="hidden" id="interface_type_val" value="{{$interface_type ?? 0}}">

@if($interface_type != 1 && $interface_type != 2&& $interface_type != 3 && $interface_type != 4 && $interface_type != 14 )
@if($attachment_type_not_show==0)
<a href="#" data-tabseq="1" class="goBack btn btn-sm btn-previous btn-fill btn-default btn-wd pull-left"
>
    {{$labels['previous'] ?? 'Previous'}}
</a>
<a href="#" data-tabseq="3" class="goNext btn btn-next btn-rose pull-right btn-sm"
>
    {{$labels['next'] ?? 'Next'}}
</a>
@else
    <a href="#" data-tabseq="4" class="goBack btn btn-sm btn-previous btn-fill btn-default btn-wd pull-left"
    >
{{$labels['previous'] ?? 'Previous'}}
    </a>
@endif
@endif
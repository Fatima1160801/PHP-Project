
<?php
$att_path = str_replace('server.php', '', $_SERVER['PHP_SELF']);
?>

            <table class="table" id="table">
                <thead>
                <tr>
                     <th>
                        {{$labels['file']??'file'}}
                    </th>
                    <th>
                        {{$labels['document_type']??'document_type'}}
                    </th>
                    <th>
                        {{$labels['description']??'description'}}
                    </th>
                    <th>
                        {{$labels['related_to']??'related_to'}}
                    </th>
                    <th>
                        {{$labels['actions']??'actions'}}
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($attachments as $index=>$attachment)
                    <tr>
                         <td><a href="{{public_path()}}/attach/{{$attachment->file_path}}"
                               download>{{$attachment->file_path}}</a></td>
                        <td>{{$attachment->attachmentType ? $attachment->attachmentType->{'attachment_type_'.lang_character()} :'' }}</td>
                        <td>{{$attachment->file_desc}}</td>
                        <td>{{$act_list[$attachment->activity_type][Auth::user()->lang_id]}}</td>
                        <td>
                            <a href="{{$att_path}}attach/{{$attachment->file_path}}" rel="tooltip" download
                               class="btn btn-sm btn-info btn-round btn-fab"
                               rel="tooltip" data-original-title=""
                               title="
                               {{$labels['download']??'download'}}"
                               data-placement="top" id="">
                                <i class="material-icons">cloud_download</i>
                            </a>
                            <button type="button" data-href="{{route('attachments.edit',$attachment->id)}}"
                                    rel="tooltip" class="btn btn-sm btn-success btn-round btn-fab btnAttachEdit"
                                    rel="tooltip" data-original-title=""
                                    title=" {{$labels['edit']??'edit'}} "
                                    data-placement="top" id="">

                                <i class="material-icons">edit</i>
                            </button>
                            <button type="button" href="{{route('attachments.delete',$attachment->id)}}"
                                    rel="tooltip"
                                    class="btn btn-sm btn-danger btn-round btn-fab btnAttachDelete"
                                    rel="tooltip" data-original-title="" title=" {{$labels['delete']??'delete'}}"
                                    data-placement="top" id="">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
<div id="link-search">{{$attachments->links("pagination::bootstrap-4")}}</div>



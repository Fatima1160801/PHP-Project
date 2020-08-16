<?php
  $att_path = str_replace('server.php','',$_SERVER['PHP_SELF']);
 ?>

<button data-href="{{route('attachments.create')}}" id="btnFileModal" class="btn btn-sm btn-primary btn-round btn-fab"
        data-toggle="tooltip" data-placement="top"
        title="{{$labels['add_file'] ?? 'add_file'}}"
>
    <i class="material-icons">add</i></button>
<br><br>

<div class="material-datatables">
    <table class="table" id="attachments-table">
        <thead>
        <tr>
            <th>#</th>
            <th>
                {{$labels['file'] ?? 'file'}}
            </th>
            <th>
                {{$labels['attachment_types']??'attachment_types'}}
            </th>
            <th>
                {{$labels['description'] ?? 'description'}}
            </th>
            <th>
                {{$labels['actions'] ?? 'actions'}}
            </th>
        </tr>
        </thead>
        <tbody id="attachments-list">
        @foreach($attachments as $index=>$attachment)
            <tr>
                <td>{{$index+1}}</td>
                <td>   <a href="{{$att_path}}attach/{{$attachment->file_path}}" download>{{$attachment->file_path}}</a></td>
                <td>{{$attachment->attachmentType ? $attachment->attachmentType->{'attachment_type_'.lang_character()} :'' }}</td>

                <td>{{$attachment->file_desc}}</td>
                <td>
                    <a href="{{$att_path}}attach/{{$attachment->file_path}}" rel="tooltip" download class="btn btn-sm btn-info btn-round btn-fab"
                       rel="tooltip" data-original-title="" title="Download"
                       data-placement="top" id="">
                        <i class="material-icons">cloud_download</i>
                    </a>
                    <button type="button" data-href="{{route('attachments.edit',$attachment->id)}}" rel="tooltip" class="btn btn-sm btn-success btn-round btn-fab btnAttachEdit"
                       rel="tooltip" data-original-title="" title="{{$labels['edit'] ?? 'edit'}}"
                       data-placement="top" id="">

                        <i class="material-icons">edit</i>
                    </button>
                    <button type="button" href="{{route('attachments.delete',$attachment->id)}}" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab btnAttachDelete"
                       rel="tooltip" data-original-title="" title="{{$labels['delete'] ?? 'delete'}}"
                       data-placement="top" id="">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>




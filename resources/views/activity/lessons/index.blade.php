<h4>
    {{$labels['lessons_index'] ?? 'lessons_index'}}
</h4>



<a href="#" rel="tooltip" class="btn btn-sm btn-primary btn-round btn-fab" data-toggle="modal" data-target="#modalLessons"
   data-original-titaddlocationle="" title="{{$labels['lessons_add'] ?? 'lessons_add'}}" data-placement="top" id="AddLessons">
    <i class="material-icons">add</i>
</a>

<table class="table">
    <thead>
    <tr>
        <th>
            {{$labels['lessons_type_id'] ?? 'lessons_type_id'}}
        </th>
        <th>
            {{$labels['related_to_id'] ?? 'related_to_id'}}
        </th>
        <th>
            {{$labels['description'] ?? 'description'}}
        </th>
        <th>
            {{$labels['recommendation'] ?? 'recommendation'}}
        </th>
        <th>
            {{$labels['actions']??'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($lessons as $lesson)
        <tr>
            <td>{{$lesson->type ? $lesson->type->{'activity_lessons_type_name_'.lang_character()} : '' }}</td>
            <td>{{$lesson->related ? $lesson->related->{'activity_lessons_related_name_'.lang_character()} : '' }}</td>
            <td>{{$lesson->description}}</td>
            <td>{{$lesson->recommendation}}</td>
            <td>


                <a href="{{ route('activity.lessons.edit',$lesson->id) }}" rel="tooltip"
                   class="btn btn-sm btn-primary btn-round btn-fab" data-toggle="modal" data-target="#modalLessons"
                   data-original-titaddlocationle="" title="{{$labels['edit']??'edit'}}" data-placement="top" id="btnEditActivityLessons">
                    <i class="material-icons">edit</i>
                </a>


                <a  href="{{ route('activity.lessons.delete',$lesson->id) }}" rel="tooltip" class="btn btn-sm btn-danger btn-round btn-fab" data-toggle="tooltip"
                            data-placement="top" title="{{$labels['remove']??'remove'}}" id="btnDeleteActivityLessons">
                        <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>

<div class="col-md-12">

    <a href="#" class="btn btn-previous btn-default btn-sm pull-left" id="previous-staff-tab">
        {{$labels['previous']??'previous'}}
    </a>


    <a href="#" class="btn btn-next btn-default  btn-sm pull-right " id="next-attachments-tab">
        {{$labels['next']??'next'}}
    </a>

</div>



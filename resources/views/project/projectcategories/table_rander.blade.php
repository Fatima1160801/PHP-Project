<table class="table dataTable no-footer table-bordered instrole" id="table">
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['english_category_name'] ?? 'english_category_name'}}
        </th>
        <th>
            {{$labels['arabic_category_name'] ?? 'arabic_category_name'}}
        </th>
        <th>
            {{$labels['category_status'] ?? 'category_status'}}
        </th>
        <th>
            {{$labels['actions'] ?? 'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($projectcategories as $index=>$category)

        <tr data-id="{{$category->id}}">
            <td>{{$index+1}}</td>
            <td>{{$category->category_name_na}}</td>
            <td>{{$category->category_name_fo}}</td>
            <td>
                {!! activeLabel($category->is_hidden ) !!}

            </td>
            <td>
                @if($id==1)
                <a href="{{route('project.projectcategories.edit',$category->id)}}"
                   class="mytooltip btn-setting-nav" data-toggle="tooltip"
                   data-placement="top"
                   title="

                           ">
                    <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                </a>
                @else
                    <a href="#"  data-id="{{$category->id}}"
                       class="btn-sm editRoleType  mytooltip btn-setting-nav"  data-toggle="tooltip" data-placement="top"

                    >
                        <i class="material-icons">edit</i><span class="mytooltiptext"> {{$labels['edit'] ?? 'edit'}}</span>
                    </a>
                @endif
                <a href="#" class="mytooltip btn-setting-nav" data-toggle="modal"
                        data-target="#delete{{$category->id}}"
                        data-tooltip="tooltip" data-placement="top"
                        title="
                        ">
                    <i class="material-icons">delete</i><span class="mytooltiptext"> {{$labels['delete'] ?? 'delete'}}</span>
                </a>

            </td>
        </tr>
        <!--Modal -->
        <div class="modal" id="delete{{$category->id}}" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Delete Project Category
                            Confirmation</h4>
                    </div>
                    @if($id==1)
                    {!! Form::open(['method' => 'DELETE','route' => ['project.projectcategories.destroy', $category->id,1],'style'=>'display:inline']) !!}
                    @else
                        {!! Form::open(['action' => 'DELETE','route' => ['project.projectcategories.destroy', $category->id,2],'style'=>'display:inline','id'=>'formDelete']) !!}

                    @endif
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p class="text-center">
                            Are you sure you want to delete this?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel
                        </button>
                        <button type="submit" class="btn btn-warning yes" data-id="{{$category->id}}">Yes, Delete</button>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div> <!-- End Modal -->

    @endforeach
    </tbody>
</table>
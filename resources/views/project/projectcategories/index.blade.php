@extends('layouts._layout')

@section('content')


    <div class="card ">
{{--        <div class="card-header card-header-rose card-header-text">--}}
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">storage</i>--}}
{{--            </div>--}}
{{--            <h4 class="card-title">--}}
{{--                {{$labels['screen_project_categories'] ?? 'screen_project_categories'}}--}}
{{--            </h4>--}}
{{--        </div>--}}
        <div class="card-body">
            <h4 class="card-title"><span>
                {{$labels['screen_project_categories'] ?? 'screen_project_categories'}}

            <a href="{{route('project.projectcategories.create')}}"
               class="btn btn-primary btn-round btn-fab btn-sm"
               data-toggle="tooltip" data-placement="top"
               title="{{$labels['add'] ?? 'add'}}">
                <i class="material-icons">add
                </i>
            </a></span></h4>
            <table class="table dataTable no-footer table-bordered" id="table">
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

                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$category->category_name_na}}</td>
                        <td>{{$category->category_name_fo}}</td>
                        <td>
                            {!! activeLabel($category->is_hidden ) !!}

                        </td>
                        <td>
                            <a href="{{route('project.projectcategories.edit',$category->id)}}"
                               class="btn btn-success btn-round btn-fab btn-sm" data-toggle="tooltip"
                               data-placement="top"
                               title="
                               {{$labels['edit'] ?? 'edit'}}
                                       ">
                                <i class="material-icons">edit</i>
                            </a>

                            <button class="btn btn-danger btn-round btn-fab btn-sm" data-toggle="modal"
                                    data-target="#delete{{$category->id}}"
                                    data-tooltip="tooltip" data-placement="top"
                                    title="
                        {{$labels['delete'] ?? 'delete'}}">
                                <i class="material-icons">delete</i>
                            </button>

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
                                {!! Form::open(['method' => 'DELETE','route' => ['project.projectcategories.destroy', $category->id],'style'=>'display:inline']) !!}
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
                                    <button type="submit" class="btn btn-warning">Yes, Delete</button>
                                </div>
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div> <!-- End Modal -->

                @endforeach
                </tbody>
            </table>
            <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.othersettings.screen')}}"'>Back</button>

        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            active_nev_link('project_category');
            DataTableCall('#table', 5)
        })
    </script>
@endsection



@section('js')
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
@endsection


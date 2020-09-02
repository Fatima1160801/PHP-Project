<div class="card-header card-header-rose card-header-text" id="createmodal">
    {{--            <div class="card-icon">--}}
    {{--                <i class="material-icons"> group_work--}}
    {{--                </i>--}}
    {{--            </div>--}}
    <h4 class="card-title" style="color:black;">Groups</h4>

</div>
<div class="card-body ">

    {!! Form::open(['route' => 'permission.group.store' ,'action'=>'post' ,'id'=>'formAdd']) !!}
    {!! Form::hidden('id') !!}
    <div class="row">
        <div class="col-md-8 form-group">

            {!! Form::text('group_name', '' ,['class'=>'form-control','placeholder'=>'Group Name']) !!}
        </div>
        <div class="col-md-2">
            {!! Form::submit('save',['class'=>' btn btn-primary' ,'id'=>'formAddSubmit']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    <div class="table-responsive">

        <table id="table " class="table  dataTable no-footer table-bordered">
            <thead>
            <tr class="text-primary">
                <th>#</th>
                <th> Group Name</th>
                <th>created by</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
                @include('permission.group.row')
            @endforeach

            </tbody>
        </table>
{{--        <button type="button"  class="btn  btn-sm btn-default" onclick='location.href="{{ route('settings.users.screen')}}"'>Back</button>--}}

    </div>
</div>
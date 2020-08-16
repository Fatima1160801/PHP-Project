<a href="{{route('project.donors.contact.create')}}" rel="tooltip" class="btn btn-sm btn-primary btn-round btn-fab"
   data-toggle="modal" data-target="#modalDonorContact"
   rel="tooltip" data-original-title="" title="
{{$labels['add']??'add'}}"
   data-placement="top" id="addDonorContact">
    <i class="material-icons">add</i>
</a>

@if($donors != null)
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>
            {{$labels['name_english']??'name_english'}}
        </th>
        <th>
            {{$labels['name_arabic']??'name_arabic'}}
        </th>
        <th>
            {{$labels['contacts_mobile']??'contacts_mobile'}}
        </th>
        <th>
         {{$labels['contact_job_title']??'contact_job_title'}}
        </th>
        <th>
            {{$labels['actions']??'actions'}}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($donors  as $index=>$donor)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{$donor->contact_person_na}}</td>
            <td>{{$donor->contact_person_fo}}</td>
            <td>{{$donor->contact_mobile}}</td>
            <td>{{$donor->contact_job_title}}</td>
            <td>
                <a href="{{route('project.donors.contact.edit',$donor->id)}}"
                   rel="tooltip" class="btn btn-sm btn-success btn-round btn-fab"
                   data-toggle="modal" data-target="#modalDonorContactEdit"
                   rel="tooltip" data-original-title="" title="{{$labels['edit']??'edit'}}"
                   data-placement="top" id="EditDonorContact">
                    <i class="material-icons">edit</i>
                </a>


                <a href="{{route('project.donors.contact.delete',$donor->id)}}" class="btn btn-danger btn-round btn-fab btn-sm" id="btnDeleteContact"
                data-tooltip="tooltip" data-placement="right" title="{{$labels['delete']??'delete'}}">
                <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>

    @endforeach
    </tbody>
</table>
@endif




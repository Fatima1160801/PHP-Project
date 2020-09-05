<div class="card-body ">
{{--    <a href="{{route('beneficiary.oraganizations.create')}}" class="btn btn-primary btn-sm btn-fab "--}}
{{--       data-toggle="tooltip" data-placement="top"--}}
{{--       title="  {{$labels['add_organization'] ?? 'add_organization'}}   " >--}}
{{--        <i class="material-icons">add</i></a>--}}

    <a href="#"
       class="mytooltip btn-setting-nav" onclick='addOrganizations()'id='addFam_indev'
       data-toggle="tooltip" data-placement="top"
       title=" ">
        <i class="material-icons">add</i><span class="mytooltiptext">Add</span>
    </a>
        <a href="{{route('beneficiary.organization.report.form')}}"
           class="mytooltip btn-setting-nav"
           rel="tooltip" data-placement="top"
           title="">
            <i class="material-icons">search</i><span class="mytooltiptext">{{$labels['search'] ?? 'search'}}</span>
        </a>
    <table class="table" id="table">
        <thead>
        <tr>
            <th>#</th>
            <th>

                {{$labels['organization_name'] ?? 'organization_name'}}
            </th>
            <th>
                {{$labels['organization_typee'] ?? 'organization_typee'}}
            </th>
            <th>
                {{$labels['telephone'] ?? 'telephone'}}
            </th>
            <th>
                {{$labels['added_at'] ?? 'added_at'}}
            </th>
            <th>
                {{$labels['actions'] ?? 'actions'}}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($beneficiaryOrganizations  as $index=>$beneficiaryOrganization)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$beneficiaryOrganization->{'ben_name_'.lang_character()} }}</td>
                <td>{{$beneficiaryOrganization->org_type?  $org_types[Auth::user()->lang_id][$beneficiaryOrganization->org_type] : $beneficiaryOrganization->org_type  }}</td>
                <td>{{$beneficiaryOrganization->ben_tel_no}}</td>
                <td>{{dateFormatSite($beneficiaryOrganization->created_at)}}</td>
                <td>
                    <a href="{{route('beneficiary.oraganizations.getedit',$beneficiaryOrganization->id)}}" data-id="{{$beneficiaryOrganization->id}}"
                       class="mytooltip btn-setting-nav editOrganzNew"  data-toggle="tooltip" data-placement="top"
                       title="{{$labels['edit'] ?? 'edit'}} ">
                        <i class="material-icons">edit</i>
                    </a>


                    <a href="{{ route('beneficiary.oraganizations.delete',$beneficiaryOrganization->id )}}"
                       id="btnBeneficiaryDelete" rel="tooltip" class="mytooltip btn-setting-nav"
                       data-placement="top"  title="{{$labels['delete'] ?? 'delete'}}">
                        <i class="material-icons">delete</i>
                    </a>

                    <a href="{{ route('activity.beneficiaries.beneficiaryForm',[$beneficiaryOrganization->id ,'3'] )}}"
                       id="btnBeneficiaryFormPrint" rel="tooltip" class="mytooltip btn-setting-nav"
                       data-placement="top" title=" {{$labels['print'] ?? 'print'}} ">
                        <i class="material-icons">print</i>
                    </a>

                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>
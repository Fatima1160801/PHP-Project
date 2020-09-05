<div class="card-body ">
{{--        <a href="{{route('beneficiary.fam_indev.create')}}"--}}
{{--           class="btn btn-primary btn-round btn-fab btn-sm"--}}
{{--           data-toggle="tooltip" data-placement="top"--}}
{{--           title="{{$labels['add_beneficiary'] ?? 'add_beneficiary'}} ">--}}
{{--            <i class="material-icons">add</i>--}}
{{--        </a>--}}

{{--    @if( Auth::user()->id == 1 || in_array(175,$userPermissions))--}}
{{--        <a href="{{route('beneficiary.famindv.report.form')}}"--}}
{{--           class="mytooltip btn-setting-nav"--}}
{{--           rel="tooltip" data-placement="top"--}}
{{--           title="{{$labels['search'] ?? 'search'}}">--}}
{{--            <i class="material-icons">search</i>--}}
{{--        </a>--}}
{{--    @endif--}}
    <a href="{{route('beneficiary.fam_indev.settings')}}"
       class="mytooltip btn-setting-nav"
       rel="tooltip" data-placement="top"
       title="{{Auth::user()->lang_id == 1 ? 'Settings' : 'إعدادات'}}">
        <i class="material-icons">settings</i>
    </a>
            <a href="#"
               class="mytooltip btn-setting-nav" onclick='addFam_indev()'id='addFam_indev'
               data-toggle="tooltip" data-placement="top"
               title=" ">
                <i class="material-icons">add</i><span class="mytooltiptext">Add</span>
            </a>
        @if( Auth::user()->id == 1 || in_array(175,$userPermissions))
            <a href="#"
               class="mytooltip btn-setting-nav report"
               rel="tooltip" data-placement="top"
               title="">
                <i class="material-icons">search</i><span class="mytooltiptext">{{$labels['search'] ?? 'search'}}</span>
            </a>
        @endif
        <a href="#"
           class="mytooltip btn-setting-nav setting"
           rel="tooltip" data-placement="top"
           title="">
            <i class="material-icons">settings</i><span class="mytooltiptext">{{Auth::user()->lang_id == 1 ? 'Settings' : 'إعدادات'}}</span>
        </a>

    <table class="table" id="table">
        <thead>
        <tr>
            <th>#</th>
            <th>
                {{$labels['beneficiary_name'] ?? 'beneficiary_name'}}
            </th>
            <th>
                {{$labels['beneficiary_type'] ?? 'beneficiary_type'}}
            </th>
            <th>
                {{$labels['identification_number'] ?? 'identification_number'}}
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
        @foreach($beneficiaries  as $index=>$beneficiary)

            <tr>
                <td>{{$index+1}}</td>
                <td>{{$beneficiary->{'ben_name_'.lang_character()} }}</td>
                <td>
                    {{$beneficiary->beneficiaryType->{'beneficieris_types_name_'.lang_character()} }}
                </td>
                <td>{{$beneficiary->ben_idno}}</td>
                <td>{{dateFormatSite($beneficiary->created_at)}}</td>
                <td>
                    <a href="{{route('beneficiary.fam_indev.getedit',$beneficiary->id)}}" data-id="{{$beneficiary->id}}"
                       class="mytooltip mytooltip btn-setting-nav editFamIndNew" data-toggle="tooltip"
                       data-placement="top"
                       title="{{$labels['edit'] ?? 'edit'}} "
                    >
                        <i class="material-icons">edit</i>
                    </a>


                    <a href="{{ route('beneficiary.fam_indev.delete',$beneficiary->id )}}"
                       id="btnBeneficiaryDelete" rel="tooltip" class="mytooltip mytooltip btn-setting-nav"
                       data-placement="top" title=" {{$labels['delete'] ?? 'delete'}} ">
                        <i class="material-icons">delete</i>
                    </a>

                    <a href="{{ route('activity.beneficiaries.beneficiaryForm',[$beneficiary->id ,$beneficiary->ben_type_id] )}}"
                       id="btnBeneficiaryFormPrint" rel="tooltip"
                       class="mytooltip mytooltip btn-setting-nav"
                       data-placement="top" title=" {{$labels['print'] ?? 'print'}} ">
                        <i class="material-icons">print</i>
                    </a>

                </td>
            </tr>



        @endforeach
        </tbody>
    </table>
</div>
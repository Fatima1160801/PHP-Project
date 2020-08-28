<div class="card " style="    margin-top: -15px;
    /* margin-right: 15px; */
    /* margin-right: 15px; */
    margin-bottom: -15px;
    width: 106%;
    margin-left: -21px;">
    <div class="card-header card-header-rose  card-header-icon" id="createmodal">
        <h4 class="card-title">

{{--           <i class="material-icons">layers</i> --}}
            {{$labels['cities']??'Governorate'}}

        </h4>
    </div>
    <div class="card-body ">

        <div id="result-msg"></div>

@if($save==1)
        {!! Form::open(['route' => 'settings.cities.store' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formCityCreate']) !!}
        @else
            {!! Form::open(['route' => 'settings.cities.update' ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formCityUpdate']) !!}
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! $html !!}


        <div class="col-md-12">

            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    @if($id==1)
                    <a href="{{route('settings.cities')}}" class="btn btn-sm btn-default">
                        {{$labels['back'] ?? 'back'}}
                    </a>
                    @else
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>@endif
                    @if($save==1)
                    <button type="submit" id="btnAddCity" class="btn btn-next btn-sm  btn-rose pull-right">
                        <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                    </button>
                    @else
                        <button type="submit" id="btnUpdateCity" class="btn btn-next btn-rose btn-sm pull-right">
                            <div class="loader pull-left" style="display: none;"></div> {{$labels['save'] ?? 'save'}}
                        </button>
                    @endif
                </div>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>
@section('script')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>


    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    {{--<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js')}}"></script>--}}
    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('js/modal_setting.js')}}"></script>
    <script src="{{ asset('js/wizardReport.js')}}"></script>
@endsection
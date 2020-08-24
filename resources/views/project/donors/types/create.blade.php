@extends('layouts._layout')

@section('content')

    <div class="card ">
        <div class="card-header card-header-rose card-header-text">
{{--            <div class="card-icon">--}}
{{--                <i class="material-icons">business_center--}}
{{--                </i>--}}
{{--            </div>--}}
            <h4 class="card-title">
                {{$labels['screen_add_donor_types']??'screen_add_donor_types'}}
            </h4>

        </div>


        {!! Form::open(['route' => 'project.donors.types.store'  ,'novalidate'=>'novalidate','action'=>'post' ,'id'=>'formAdd']) !!}
        <div class="card-body ">
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

            <div class="card-footer ml-auto mr-auto">
                <div class="ml-auto mr-auto">
                    <a href="{{route('project.donors.types.index')}}"
                       class="btn btn-sm btn-default pull-left">
                        {{$labels['back'] ?? 'back'}}</a>
                    <button btn="btnToggleDisabled" type="submit" class="btn btn-rose btn-sm pull-right" id="saveDonor">
                        {{$labels['save'] ?? 'save'}}
                        <div class="loader pull-left" style="display: none;"></div>
                    </button>
                </div>
            </div>


            {!! Form::close() !!}
        </div>


        @endsection

        @section('script')
            <script>
                function setFormValidation(id) {
                    $(id).validate({
                        highlight: function (element) {
                            $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
                            $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');
                        },
                        success: function (element) {
                            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
                            $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
                        },
                        errorPlacement: function (error, element) {
                            $(element).append(error);
                        },
                    });
                }

                $(document).ready(function () {
                    active_nev_link('donor_types');

                     funValidateForm();
                })

                $(document).on('submit', '#formAdd', function (e) {
                    if (!is_valid_form($(this))) {
                        return false
                    }
                })
            </script>
    @endsection
    @section('js')
        <!-- Forms Validations Plugin -->
            <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>


            <!-- Forms Validations Plugin -->
            <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
@endsection
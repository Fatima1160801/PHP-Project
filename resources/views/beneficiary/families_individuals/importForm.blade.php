@extends('layouts._layout')
@section('content')
    <div class="card ">
        <div class="card-header card-header-rose  card-header-icon">
            <div class="card-icon">
                <i class="material-icons">desktop_windows</i>
            </div>
            <h4 class="card-title">
                {{$labels['import-beneficiary'] ?? 'import-beneficiary'}}
            </h4>
        </div>
        <div class="card-body ">

            <div id="result-msg"></div>


            @if ( Session::has('success') )
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{ Session::get('success') }}</strong>
                </div>
            @endif

            @if ( Session::has('error') )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{ Session::get('error') }}</strong>
                </div>
            @endif

            <form action="{{ route('beneficiary.import.store') }}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="col-md-12">
                        <div class="row">
                            <label for="file" class="col-md-4 col-form-label"> Choose your xls/csv File </label>
                            <div class=" col-md-8">
                                <input type="file" name="file" class="form-control">
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card-footer ml-auto mr-auto">
                            <div class="ml-auto mr-auto">
                                <button type="submit" class="btn btn-next btn-rose pull-right btn-sm">
                                    {{$labels['save'] ?? 'save'}}
                                </button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>


    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection



@section('js')
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('assets/js/plugins/jquery.validate.min.js')}}"></script>

    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>


@endsection


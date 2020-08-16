<div class="modal-content ">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <div class="card-header  text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title"> {{$screenName}}</h4>
            </div>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'project.donors.contact.store' ,'action'=>'post' ,'id'=>'formAddDonorContact']) !!}

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
                <button id="btnDonorContactAdd" btn="btnToggleDisabled" type="submit" class="btn btn-next btn-rose pull-right">
                    {{$labels['save'] ?? 'save'}}
                    <div class="loader pull-left" style="display: none;"></div>
                </button>
            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}





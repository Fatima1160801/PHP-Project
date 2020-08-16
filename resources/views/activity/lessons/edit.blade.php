
<div class="modal-content">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <h5 class="modal-title card-title" id="">
                {{$labels['editActivityDelay']??'editActivityDelay'}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="material-icons">clear</i>
            </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'activity.lessons.update' ,'action'=>'post' ,'id'=>'formUpdateActivityLessons']) !!}

            {!! $html !!}
            <div class="row">
                <label for="" class="col-md-2 col-form-label"></label>
                <div class="col-md-4">
                    <button type="submit" btn="btnToggleDisabled" id="btn_edit_lessons"
                            class="btn btn-rose pull-center">
                        {{$labels['save']??'save'}}

                        <div class="loader pull-left" style="display: none;"></div>
                    </button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
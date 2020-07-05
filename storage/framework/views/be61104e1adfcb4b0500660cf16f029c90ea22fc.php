<div class="modal-content">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <h5 class="modal-title card-title" id="">
                <?php echo e($labels['lessons_add']??'lessons_add'); ?>

            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="material-icons">clear</i>
            </button>
        </div>
        <div class="modal-body">
            <?php echo Form::open(['route' => 'activity.lessons.store' ,'action'=>'post' ,'id'=>'formActivityLessonsAdd']); ?>


  <?php echo $html; ?>

            <div class="row">
                <label for="" class="col-md-2 col-form-label"></label>
                <div class="col-md-4">
                    <button type="submit" btn="btnToggleDisabled" id="btnAddLessons"
                            class="btn btn-rose pull-center">
                          <?php echo e($labels['save']??'save'); ?>

                        <div class="loader pull-left" style="display: none;"></div>
                    </button>
                </div>
            </div>

            <?php echo Form::close(); ?>

        </div>
    </div>
</div>

<style>
    .circle-ico{
        font-size: 16px !important;
        line-height: 35px !important;
        width: 35px !important;
        height: 35px !important;
        text-align: center !important;
        border-radius: 50% !important;
    }
    .edit-ico{
        color: white;
        background: #4caf50;
    }
    .delete-ico{
        color: white;
        background: #f44336;
    }
</style>
<?php echo Form::open(['route' => 'concept.note.store' ,'action'=>'post' ,'id'=>'formAddNote']); ?>


<div class='col-md-12' >
    <label for='description_na' class='col-form-label'><?php echo e($labels['opportunity_desc'] ?? 'Note'); ?></label>
        <div class='col-md-12'>
            <div class='form-group has-default bmd-form-group'>
                <textarea class='form-control' rows="10" name='note' id='note' required minLength='0' maxLength='1000' aria-required="true" aria-invalid="false" ></textarea>
                <input type="hidden" value="0"  name="opportunity_id" id="note_opp_id_input">
            </div>
        </div>
</div>

<a href="#" data-tabseq="4" class="goNext btn btn-next btn-rose pull-right btn-sm">
    <?php echo e($labels['next'] ?? 'Next'); ?>

</a>
<button type="submit" id="saveNotebtn" class="btn btn-primary btn-sm pull-right mb-5">
    <?php echo e($labels['note_save'] ?? 'Save'); ?>

    <div class="loader pull-left" style="display: none;"></div>
    <div class="ripple-container"></div>
</button>

<?php echo Form::close(); ?>

<a href="#" data-tabseq="2" class="goBack btn btn-sm btn-previous btn-fill btn-default btn-wd pull-left"
>
    <?php echo e($labels['previous'] ?? 'Previous'); ?>

</a>


<div class="clearfix"></div>
        <ul class="timeline timeline-simple">
            <?php if(sizeof($note_list) > 0): ?>
                <?php $__currentLoopData = $note_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="timeline-inverted">
                        <div class="timeline-badge">
                            <img src="<?php echo e($item->user_photo ? $item->user_photo  : url("public/images/default-avatar.jpg")); ?>" style="border-radius: 100%" width="53" height="53">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <a href="http://199.250.219.215/newpme/staff/1"><?php echo e($item->user_full_name ?? ""); ?></a>
                            </div>
                            <div class="dropdown pull-right" style="bottom: 40px;">
                                <button type="button" data-toggle="modal"  data-target="#opportunityNoteModal" data-donorid="<?php echo e($item->donor_id ?? 1); ?>" data-noteid="<?php echo e($item->id); ?>" data-note="<?php echo e($item->note); ?>"
                                        class="btn btn-sm btn-success btn-round btn-fab btnEditOpportunityNote"  data-placement="top"
                                        title="  Edit     ">
                                    <i class="material-icons">edit</i>
                                </button>

                                <a href="<?php echo e(route('concept.note.delete',$item->id )); ?>" id="btnOpportunityDeleteNote"
                                   class="btn btn-sm btn-danger btn-round btn-fab" data-donorid="<?php echo e($item->donor_id ?? 1); ?>"
                                   data-toggle="tooltip" data-placement="top"
                                   title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                                    <i class="material-icons">delete</i>
                                </a>

                                
                                        
                                        
                                    
                                
                            </div>
                            <div class="timeline-body" >
                                <p id="note-item-<?php echo e($item->id); ?>"><?php echo e($item->note ?? ""); ?></p>
                            </div>
                            <h6 class="pull-right">
                                <i class="fa fa-clock-o"></i> <?php echo e(date("d/m/Y H:i", strtotime(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at,'Asia/Gaza')))); ?>

                            </h6>

                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>


        </ul>
<input type="hidden" id="concept_st_val" value="<?php echo e($concept_status_id ?? 1); ?>" />




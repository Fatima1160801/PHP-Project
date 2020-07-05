<style>
    .text-dirct{
        text-align: left !important;
    }
    .text-bold{
        font-weight: bold !important;
    }
    .mtop{
        margin-top: 30px;
    }
</style>

<div class="clearfix"></div>

<hr>
<div class='col-md-8'>
    <h4><?php echo e($labels['document_other']??'Other Documents'); ?> </h4>
    <div class='row'>
   <div class="col-md-3">
       <label for='opportunity_source_id' class='col-form-label text-bold'><?php echo e($labels['document_type']??'Type'); ?></label>
   </div>
    <div class="col-md-6">
                <div class='form-group has-default bmd-form-group doc_parent'>
                    <select class='form-control  selectpicker  ' name='document_type_id'  data-style='btn btn-link' id='document_type_id' minLength='0' maxLength='10'>
                        <?php if(sizeof($none_fixed_type)): ?>
                            <option style='height: 37px;' value></option>
                            <?php $__currentLoopData = $none_fixed_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option style='height: 37px;' value="<?php echo e($item->attachment_type_id); ?>"><?php echo e($item->{'attachment_type_'.lang_character()}); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
    </div>

    <div class="col-md-2">
        <button data-href="" id="btnFileModalNew" class="btn btn-sm btn-primary btn-round btn-fab"
                data-toggle="tooltip" data-placement="top"
                title="<?php echo e($labels['add_file'] ?? 'add_file'); ?>">
       <i class="material-icons">add</i></button>
    </div>
    </div>

</div>


<div class="table-responsive mtop">

    <table class="table " id="table">
        <thead>
        <tr>
            <th width="50">#</th>
            <th width="120">
                <?php echo e($labels['document_type'] ?? 'type'); ?>

            </th>
            <th width="120">
                <?php echo e($labels['document_title'] ?? 'title'); ?>

            </th>
            <th width="220">
                <?php echo e($labels['document_desc'] ?? 'Description'); ?>

            </th>
            <th width="170">
                <?php echo e($labels['actions']??'actions'); ?>

            </th>
        </tr>
        </thead>
        <tbody>
        <?php if(!empty($none_fixed_doc)): ?>
            <?php $__currentLoopData = $none_fixed_doc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index+1); ?></td>
                    <td ><?php echo e($doc->{'attachment_type_'.lang_character()}); ?></td>
                    <td ><?php echo e($doc->file_title ?? ""); ?></td>
                    <td ><?php echo e($doc->file_desc ?? ""); ?></td>
                    <td >
                        
                        
                        <a href="<?php echo e(p_url('/'.$doc->file_path)); ?>" rel="tooltip" download
                           class="btn btn-sm btn-info btn-round btn-fab"
                           rel="tooltip" data-original-title=""
                           title="
                               <?php echo e($labels['download']??'download'); ?>"
                           data-placement="top" id="">
                            <i class="material-icons">cloud_download</i>
                        </a>
                        <button type="button" data-href="<?php echo e(route('attachments.edit',$doc->id)); ?>"
                                rel="tooltip" class="btn btn-sm btn-success btn-round btn-fab btnAttachEdit"
                                rel="tooltip" data-original-title=""
                                title=" <?php echo e($labels['edit']??'edit'); ?> "
                                data-placement="top" id="">

                            <i class="material-icons">edit</i>
                        </button>
                        <button type="button" href="<?php echo e(route('attachments.delete',$doc->id)); ?>"
                                rel="tooltip"
                                class="btn btn-sm btn-danger btn-round btn-fab btnAttachDelete"
                                rel="tooltip" data-original-title="" title=" <?php echo e($labels['delete']??'delete'); ?>"
                                data-placement="top" id="">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>



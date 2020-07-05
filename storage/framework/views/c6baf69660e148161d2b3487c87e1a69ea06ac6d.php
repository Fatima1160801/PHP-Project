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

<div class="col-md-12">

    <div class='col-md-6 pull-left'>
        <div class='row'>
            <div class="col-md-12">
                <h2 class='col-md-3 col-form-label pull-left text-dirct text-bold'> <?php echo e($labels['document_type']??'Type'); ?></h2>
                <div class="col-md-9 pull-right">
                    <div class="col-md-4 pull-left">
                        <button data-tid="1" data-href="<?php echo e(route('attachments.edit',["id"=>$doc->id ?? ""])); ?>" id="btnConceptFileModal" class="btn btn-sm btn-primary btn-round btn-fab" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add File">
                            <i class="material-icons">open_in_browser</i></button>
                        <a href="<?php echo e(p_url('/'.$doc->file_path)); ?>" rel="tooltip" download
                           class="btn btn-sm btn-info btn-round btn-fab"
                           rel="tooltip" data-original-title=""
                           title="
                               <?php echo e($labels['download']??'download'); ?>"
                           data-placement="top" id="doc_file_path_<?php echo e($doc->id ?? 0); ?>">
                            <i class="material-icons">cloud_download</i>
                        </a>
                    </div>
                    <input type="hidden" id="concept_static_file" value="12" />

                    <div class="col-md-5 pull-left">
                        <h2  class='col-md-12 col-form-label pull-right text-dirct' id="categ_type_name_<?php echo e($doc->id ?? 0); ?>">Concept</h2>
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <h2 class='col-md-4 col-form-label pull-left text-dirct text-bold'><?php echo e($labels['document_title']??'Title'); ?></h2>
                <h2 id="doc_title_<?php echo e($doc->id ??0); ?>" class='col-md-8 col-form-label pull-right text-dirct'><?php echo e($doc->file_title ?? ""); ?></h2>

            </div>
            <div class="col-md-12">
                <h2 class='col-md-4 col-form-label pull-left text-dirct text-bold'><?php echo e($labels['document_desc']??'Description'); ?></h2>
                <p id="doc_descpt_<?php echo e($doc->id ??0); ?>" class='col-md-8 col-form-label pull-right text-dirct'><?php echo e($doc->file_desc?? ""); ?></p>

            </div>
        </div>
    </div>

</div>
<div class="clearfix"></div>
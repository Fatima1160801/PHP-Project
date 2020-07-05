<div class="modal-content ">
    <div class="card card-signup card-plain">
        <div class="modal-header">
            <div class="card-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>

                <h4 class="card-title">
                    <?php echo e($labels['create_actually_targeted_beneficiaries'] ?? 'create_actually_targeted_beneficiaries'); ?> " <?php echo e($benef_type); ?>"
                </h4>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-2">
                    <ul class="nav nav-pills nav-pills-rose flex-column" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#search_actual_beneficiary"
                               role="tablist">
                                <?php echo e($labels['search'] ?? 'search'); ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#actual_beneficiary_list" role="tablist">
                                <?php echo e($labels['list'] ?? 'list'); ?>

                            </a>
                        </li>

                    </ul>
                </div>

                <div class="col-md-10" style="
    background-color: #fcfcfc;
">
                    <div class="tab-content">
                        <div class="tab-pane active" id="search_actual_beneficiary">
                            <div class="row" id="form_search_actual">
                                <div class="col-md-12">
                                    <form action="<?php echo e(route('project.project.targetedBeneficiaries.search_actual_beneficiary')); ?>"
                                          method="get" id="formSearchActualBeneficiary"
                                          no-jquery-validate="no-jquery-validate">
                                        <input type="hidden" value="<?php echo e($targeted_beneficiaries_id); ?>"
                                               name="targeted_beneficiaries_id">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-default bmd-form-group">
                                                            <input type="text" class="form-control" name="search"
                                                                   id="search"
                                                                   placeholder="<?php echo e($labels['search_placeholder'] ?? 'search_placeholder'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button btn="btnToggleDisabled" type="submit"
                                                        class="btn   btn-rose   btn-sm  pull-right"
                                                        id="search">
                                                    <?php echo e($labels['search']??'search'); ?>

                                                    <div class="loader pull-left" style="display: none;"></div>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row" id="result_search_actual">
                                <div class="col-md-12">

                                </div>


                                <div class="card-body col-md-12">

                                </div>
                                <div class="col-md-12" align="center">
                                    <a href="#" class="btn btn-sm btn-rose" id="addActualBeneficiarySelected" hidden
                                       data-toggle="tooltip" data-placement="top" title="Add">
                                        <?php echo e($labels['add_selected']??'add_selected'); ?>

                                        <div class="loader pull-left" style="display: none;"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="actual_beneficiary_list" style=" padding: 14px; ">
                            <div class="card-body">

                                <?php echo $__env->make('project.project.targeted_beneficiaries.list_actual_beneficiary',compact('actuallyTargetedBeneficiaries','labels'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

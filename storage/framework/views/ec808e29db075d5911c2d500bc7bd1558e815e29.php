<?php $__env->startSection("css"); ?>
    <style>
        .main-list div.card.card-stats {
            min-height: 190px;
            height: 190px;
            max-height: 190px;
        }
        /*.sort-itm2 i.material-icons {*/
        /*    text-align: left;*/
        /*    margin-left: 5px;*/
        /*}*/

        .sort-itm2 i.material-icons {
            text-align: left !important;
            margin-left: 5px;
        }
        .card-category{
            color:#757575 !important;
        }
        #drawActivityMoreParent .card-icon,#drawTaskMoreParent .card-icon,#drawProjectMoreParent .card-icon,#drawOppMoreParent .card-icon,#drawConceptMoreParent .card-icon,#drawProposalMoreParent .card-icon{
            padding: 1px !important;
        }
        #drawActivityMoreParent .card,#drawTaskMoreParent .card,#drawProjectMoreParent .card,#drawOppMoreParent .card,#drawConceptMoreParent .card,#drawProposalMoreParent .card{
            min-height: 250px;
            max-height: 250px;
            height: 250px;
            margin: auto;
            border: 1px solid #b1b1b1;
        }
        #drawActivityMoreParent .card-category,#drawTaskMoreParent .card-category,#drawProjectMoreParent .card-category,#drawOppMoreParent .card-category,#drawConceptMoreParent .card-category,#drawProposalMoreParent .card-category {
        font-weight: bold !important;
        }

        #drawActivityMoreParent .card-header,#drawTaskMoreParent .card-header,#drawProjectMoreParent .card-header,#drawOppMoreParent .card-header,#drawConceptMoreParent .card-header,#drawProposalMoreParent .card-header {
            min-height: 120px;
            max-height: 120px;
            /*overflow: hidden;*/
            height: 120px;
        }
        #drawActivityMoreParent .card-footer,#drawTaskMoreParent .card-footer,#drawProjectMoreParent .card-footer,#drawOppMoreParent .card-footer,#drawConceptMoreParent .card-footer,#drawProposalMoreParent .card-footer {
        margin: auto;
        }
        .sort-itm2 .card-icon{
            width: 20% !important;
        }

        .sort-itm2 .card-icon .btn-round{
           float: right !important;
            margin-right: 5px !important;
        }
        .parg-white{
            font-weight: bold !important;
            color: white !important;
        }
        .force-m-t{
           margin-top:0px !important;
        }
        .force-m-b{
            margin-bottom: 15px !important;
        }
        .extend-btn,.extend-btn:hover,.extend-btn:active,.extend-btn:focus,.extend-btn:visited{
            background: none !important;
            border: none !important;
        }
        .extend-btn:hover{
            background: none !important;
            border: none !important;
        }
        .extend-btn:focus{
            background: none !important;
            border: none !important;
        }

        .status-card{
            color: #FF9800;
            width: 40%;
            margin: auto;
            padding: 2px;
            border-radius: 5px;
            font-size: 10px;
            text-transform: uppercase;
        }
    </style>
<?php $__env->stopSection(); ?>

<div class="col-md-12">
    <?php if(in_array(1,$userDashboardBlocksSetting)): ?>
        <div class="row sortable main-list">

          <?php if(!empty($widget_list)): ?>
                <?php $__currentLoopData = $widget_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($item->id==1): ?>
                        <?php echo $__env->make('dash_widget.project', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php elseif($item->id==2): ?>
                        <?php echo $__env->make('dash_widget.activity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php elseif($item->id==3): ?>
                        <?php echo $__env->make('dash_widget.task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php elseif($item->id==4): ?>
                        <?php echo $__env->make('dash_widget.opport', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php elseif($item->id==5): ?>
                        <?php echo $__env->make('dash_widget.concept', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php elseif($item->id==6): ?>
                        <?php echo $__env->make('dash_widget.proposal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php else: ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>


        </div>
    <?php endif; ?>
<div class="sortable2 main-list-no2">
    <?php if(!empty($widget_list_no2)): ?>
        <?php $__currentLoopData = $widget_list_no2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($item->id==7): ?>
                <?php if(in_array(2,$userDashboardBlocksSetting)): ?>
                    <?php echo $__env->make('dash_widget.project_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            <?php elseif($item->id==8): ?>
                <?php if(in_array(3,$userDashboardBlocksSetting)): ?>
                    <?php echo $__env->make('dash_widget.activity_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            <?php elseif($item->id==9): ?>



            <?php elseif($item->id==10): ?>
                <?php if(in_array(4,$userDashboardBlocksSetting)): ?>
                    <?php echo $__env->make('dash_widget.task_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            <?php elseif($item->id==11): ?>
                <?php if(in_array(7,$userDashboardBlocksSetting)): ?>
                    <?php echo $__env->make('dash_widget.opport_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            <?php elseif($item->id==12): ?>
                <?php if(in_array(8,$userDashboardBlocksSetting)): ?>
                    <?php echo $__env->make('dash_widget.concept_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            <?php elseif($item->id==13): ?>
                <?php if(in_array(9,$userDashboardBlocksSetting)): ?>
                    <?php echo $__env->make('dash_widget.proposal_list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php endif; ?>
            <?php else: ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>


</div>


</div>



<?php if(in_array(6,$userDashboardBlocksSetting)): ?>
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons"></i>
                </div>
                <h4 class="card-title text-direction  margin-right-100 "><?php echo e($labels['my_agenda']??'my_agenda'); ?></h4>
            </div>
            <div class="card-body">

                <a href="<?php echo e(route('agenda.create')); ?>" class="btn btn-primary btn-sm btn-round btn-fab"
                   data-toggle="tooltip" data-placement="top" title="Add New Agenda">
                    <i class="material-icons">add</i>
                </a>

                <div class="row">
                    <div class="col-md-12">
                        <div id="agendaCalendar"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(in_array(5,$userDashboardBlocksSetting)): ?>
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="material-icons"></i>
                </div>
                <h4 class="card-title text-direction  margin-right-100 "><?php echo e($labels['system_logs']??'system_logs'); ?></h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 ">
                        <div class="panel panel-default">
                            <?php echo Form::open(['route' => 'dashboard.trans_logs.filter' ,'action'=>'post' ,'id'=>'formDashboardLogsFilter']); ?>


                            <div class="row">
                                <label for="staff_id"
                                       class="col-md-1 col-form-label"> <?php echo e($labels['user']??'user'); ?></label>
                                <div class="col-md-3">
                                    <div class='form-group has-default bmd-form-group'>
                                        <select class='form-control selectpicker' data-live-search="true" name='user_id'
                                                data-style='btn btn-link' id='user_id'>
                                            <option style='height: 37px;' value></option>
                                            <?php if($users): ?>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($user_->id); ?>"><?php echo e($user_->user_full_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <label for="staff_id"
                                       class="col-md-1 col-form-label"> <?php echo e($labels['transtype']??'transtype'); ?> </label>
                                <div class="col-md-3">
                                    <div class='form-group has-default bmd-form-group'>
                                        <select class='form-control selectpicker' name='trans_type[]'
                                                data-style='btn btn-link' multiple id="trans_type">
                                            <option style='height: 37px;' value=""></option>
                                            <option style='height: 37px;' value="1">Add</option>
                                            <option style='height: 37px;' value="2">Update</option>
                                            <option style='height: 37px;' value="3">Delete</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="staff_id"
                                       class="col-md-1 col-form-label">  <?php echo e($labels['fromdate']??'fromdate'); ?> </label>
                                <div class="col-md-3">
                                    <div class='form-group has-default bmd-form-group'>
                                        <input type='text' class='form-control datetimepicker' name='logs_from_date'
                                               id='logs_from_date' autocomplete="off" alt=''>
                                    </div>
                                </div>
                                <label for="staff_id"
                                       class="col-md-1 col-form-label"> <?php echo e($labels['todate']??'todate'); ?></label>
                                <div class="col-md-3">
                                    <div class='form-group has-default bmd-form-group'>
                                        <input type='text' class='form-control datetimepicker' name='logs_to_date'
                                               id='logs_to_date' autocomplete="off" alt=''>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" btn="btnToggleDisabled" id="btn-dashboard-logs-filter"
                                            class="btn btn-rose pull-center">
                                        <?php echo e($labels['search']??'search'); ?>


                                        <div class="loader pull-left" style="display: none;"></div>
                                    </button>
                                </div>
                            </div>

                            <?php echo Form::close(); ?>

                            <br><br>
                            <div align="center" style="display: none" id="loader-icon-a-logs" class="col-md-12">
                                <div class="loader loader-div"></div>
                            </div>

                            <div id="table_logs"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


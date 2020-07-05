<div class="row">



    <?php if($indicatorResultChainVM != null): ?>

        <table class="table">
            <thead>


            <tr style="background-color: #efe4af">
                <th colspan="10" align="center">
                    <h6>  <?php echo e($labels['indicator_type'] ?? 'indicator_type'); ?> :
                        <b>  <?php echo e($labels['quantitative'] ?? 'quantitative'); ?></b></h6>
                </th>
            </tr>

            <tr class=" text-primary">
                <th colspan="2">
                    <?php echo e($labels['indicator_name'] ?? 'indicator_name'); ?>

                </th>

                <th>
                    <?php echo e($labels['level'] ?? 'level'); ?>

                </th>

                <th colspan="2">
                    <?php echo e($labels['Level_name'] ?? 'Level_name'); ?>

                </th>

                <th> <?php echo e($labels['actions'] ?? 'action'); ?></th>
            </tr>
            </thead>
            <tbody>

            <?php $__currentLoopData = $indicatorResultChainVM->where('indicator_type',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$indicator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td colspan="2"><?php echo e($indicator->{'indicator_name_'.lang_character()}); ?></td>

                    <td><?php if($indicator->level_type == 1): ?>
                            Level I
                        <?php elseif($indicator->level_type == 2): ?>
                            Level II
                        <?php else: ?>
                            Level III
                        <?php endif; ?>
                    </td>
                    <td colspan="2"><?php echo e($indicator->{'level_name_'.lang_character()}); ?></td>

                    <td>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('project.project.achievement.create',[$indicator->project_id,$indicator->level_type,$indicator->level_id,$indicator->id,$indicator->indicator_type])); ?>"
                           rel="tooltip" data-toggle="modal" data-target="#modalAddAchievement"
                           data-original-title="" title="<?php echo e($labels['create_achievement'] ?? 'create_achievement'); ?>"
                           data-placement="top" id="addAchievement">
                            <?php echo e($labels['create_achievement'] ?? 'create_achievement'); ?>

                        </a>

                    </td>
                </tr>
               <?php  $Achievements =  $projectAchievement->where('level_type_id',$indicator->level_type)
                                                                ->where('level_id',$indicator->level_id)
                                                                ->where('indicator_type',$indicator->indicator_type)
                                                                ->where('id',$indicator->id)
               ?>
                <?php if(count($Achievements)>0): ?>
                       <tr style="background-color:  #efefef" >
                           <th style=" background-color: #fff; border: #fff; "></th>
                            <th style=" padding-left: 19px !important; ">
                                <?php echo e($labels['achievement_description'] ?? 'achievement_description'); ?>

                            </th>
                            <th>
                                <?php echo e($labels['measure_unit'] ?? 'measure_unit'); ?>

                            </th>
                            <th>
                                <?php echo e($labels['number_of_unit'] ?? 'number_of_unit'); ?>

                            </th>
                            <th>
                                <?php echo e($labels['date'] ?? 'date'); ?>

                            </th>
                            <th> <?php echo e($labels['actions'] ?? 'action'); ?></th>
                        </tr>


                        <?php $__currentLoopData = $Achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr  style="background-color: #fafafa">
                                <td style=" background-color: #fff; border: #fff; "></td>
                                  <td style=" padding-left: 19px !important; "><?php echo e(str_limit($achievement->description,40)); ?></td>
                                <td><?php echo e($achievement->unit ?  $achievement->unit->{'unit_name_'.lang_character1()}  :""); ?></td>
                                <td><?php echo e($achievement->number_of_unit); ?></td>
                                <td><?php echo e(dateFormatSite($achievement->date)); ?></td>
                                <td>
                                    <a class="btn btn-success btn-sm"
                                       href="<?php echo e(route('project.project.achievement.edit',$achievement->project_achievement_id)); ?>"
                                       rel="tooltip" data-toggle="modal" data-target="#modalAddAchievement"
                                       data-original-title="" title="<?php echo e($labels['edit_achievement'] ?? 'edit_achievement'); ?>"
                                       data-placement="top" id="editAchievement">
                                        <?php echo e($labels['edit_achievement'] ?? 'edit_achievement'); ?>

                                    </a>
                                    <a href="<?php echo e(route('project.project.achievement.destroy',$achievement->project_achievement_id )); ?>"
                                       id="btnDeleteAchievement" rel="tooltip" class="btn btn-sm btn-danger   "
                                       data-placement="top"
                                       title="<?php echo e($labels['delete_achievement'] ?? 'delete_achievement'); ?>">
                                        <?php echo e($labels['delete_achievement'] ?? 'delete_achievement'); ?>

                                        
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>
        </table>



        <table class="table">
            <thead>
            <tr style="background-color: #efe4af">
                <th colspan="10" align="center">
                    <h6><?php echo e($labels['indicator_type'] ?? 'indicator_type'); ?> :
                        <b>  <?php echo e($labels['qualitative'] ?? 'qualitative'); ?></b></h6>
                </th>
            </tr>


            <tr class=" text-primary">
                <th colspan="2">
                    <?php echo e($labels['indicator_name'] ?? 'indicator_name'); ?>

                </th>

                <th>
                    <?php echo e($labels['level'] ?? 'level'); ?>

                </th>

                <th >
                    <?php echo e($labels['Level_name'] ?? 'Level_name'); ?>

                </th>

                <th> <?php echo e($labels['actions'] ?? 'action'); ?></th>
            </tr>
            </thead>
            <tbody>

            <?php $__currentLoopData = $indicatorResultChainVM->where('indicator_type',2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$indicator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td colspan="2" ><?php echo e($indicator->{'indicator_name_'.lang_character()}); ?></td>

                    <td><?php if($indicator->level_id == 1): ?>
                            Level I
                        <?php elseif($indicator->level_id == 1): ?>
                            Level II
                        <?php else: ?>
                            Level III
                        <?php endif; ?>
                    </td>
                    <td  ><?php echo e($indicator->{'level_name_'.lang_character()}); ?></td>

                    <td>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('project.project.achievement.create',[$indicator->project_id,$indicator->level_type,$indicator->level_id,$indicator->id,$indicator->indicator_type])); ?>"
                           rel="tooltip" data-toggle="modal" data-target="#modalAddAchievement"
                           data-original-title="" title="<?php echo e($labels['create_achievement'] ?? 'create_achievement'); ?>"
                           data-placement="top" id="addAchievement">
                            <?php echo e($labels['create_achievement'] ?? 'create_achievement'); ?>

                        </a>

                    </td>
                </tr>

                <?php  $Achievements =  $projectAchievement->where('level_type_id',$indicator->level_type)
                                                                ->where('level_id',$indicator->level_id)
                                                                ->where('indicator_type',$indicator->indicator_type)
                                                                ->where('id',$indicator->id)
                ?>
                <?php if(count($Achievements)>0): ?>
                    <tr style="background-color:  #efefef" >
                        <th style=" background-color: #fff; border: #fff; "></th>
                        <th  style="padding-left: 15px"  >
                            <?php echo e($labels['description_achievement'] ?? 'description_achievement'); ?>

                        </th>
                        <th>
                            <?php echo e($labels['description'] ?? 'description'); ?>

                        </th>

                        <th>
                            <?php echo e($labels['date'] ?? 'date'); ?>

                        </th>
                        <th> <?php echo e($labels['actions'] ?? 'action'); ?></th>
                    </tr>


                    <?php $__currentLoopData = $Achievements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$achievement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr  style="background-color: #fafafa">
                            <td style=" background-color: #fff; border: #fff; "></td>
                            <td  style="padding-left: 15px">
                                <?php echo e(str_limit($achievement->achievement_description ,200)); ?>

                            </td>
                            <td><?php echo e(str_limit($achievement->description,40)); ?></td>
                            <td><?php echo e(dateFormatSite($achievement->date)); ?></td>
                            <td>
                                <a class="btn btn-success btn-sm"
                                   href="<?php echo e(route('project.project.achievement.edit',$achievement->project_achievement_id)); ?>"
                                   rel="tooltip" data-toggle="modal" data-target="#modalAddAchievement"
                                   data-original-title="" title="<?php echo e($labels['edit_achievement'] ?? 'edit_achievement'); ?>"
                                   data-placement="top" id="editAchievement">
                                    <?php echo e($labels['edit_achievement'] ?? 'edit_achievement'); ?>

                                </a>
                                <a href="<?php echo e(route('project.project.achievement.destroy',$achievement->project_achievement_id )); ?>"
                                   id="btnDeleteAchievement" rel="tooltip" class="btn btn-sm btn-danger   "
                                   data-placement="top"
                                   title="<?php echo e($labels['delete_achievement'] ?? 'delete_achievement'); ?>">
                                    <?php echo e($labels['delete_achievement'] ?? 'delete_achievement'); ?>

                                    
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>


    <?php else: ?>
        <tr align="center">
            <td colspan="4">
                <p>Data Not Found</p>
            </td>
        </tr>
    <?php endif; ?>

</div>




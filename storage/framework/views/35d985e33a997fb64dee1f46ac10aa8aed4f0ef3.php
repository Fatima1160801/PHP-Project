<?php if($projectOverallObjective == null): ?>

    <a href="<?php echo e(route('project.results.chain.createOverall')); ?>" id="ResultsChainCreateOverall"
       class="btn btn-sm btn-primary "
       data-toggle="modal" data-target="#modalResultsChainCreateOverall" >
        <i class="material-icons">add</i>
        <?php echo e($labels['project_add_overall_objective'] ?? 'project_add_overall_objective'); ?>

    </a>
<?php else: ?>

    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-pills-rose flex-column" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#level1" role="tablist">
                        <?php echo e($levelIName); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#level2" role="tablist">
                        <?php echo e($levelIIName); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#level3" role="tablist">
                        <?php echo e($levelIIIName); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#level4" role="tablist">
                        <?php echo e($labels['activities_list'] ?? 'activities'); ?>

                    </a>
                </li>
            </ul>
        </div>

        <div class="col-md-10" style="
    background-color: #fcfcfc;
">
            <div class="tab-content">
                <div class="tab-pane active" id="level1">

                    <table>
                        <tbody>

                        <tr>
                            <td colspan="2">
                                <a class="btn btn-success btn-sm"
                                   href="<?php echo e(route('project.results.chain.editOverall',$projectOverallObjective->id)); ?>"
                                   id="EditResultChainOverall"
                                   data-toggle="modal" data-target="#modalEditResultChainOverall"  >
                                    <?php echo e($labels['edit'] ?? 'edit'); ?> <?php echo e(' '.$levelIName); ?>



                                    
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 150px"><h6 class="tim-note"> <?php echo e($labels['Type'] ?? 'type'); ?></h6></td>
                            <td>
                                <p class="tim-note"> <?php echo e($projectOverallObjective->levelsType ? $projectOverallObjective->levelsType->{'levels_type_name_'.lang_character()} : ''); ?></p>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 150px"><h6 class="tim-note">  <?php echo e($labels['name'] ?? 'name'); ?> </h6></td>
                            <td>
                                <p class="tim-note"> <?php echo e($projectOverallObjective->{'overall_objective_name_'.lang_character()}); ?></p>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                   href="<?php echo e(route('project.results.chain.LevelICreateIndicator',$projectOverallObjective->id)); ?>"
                                   id="LevelICreateIndicator"
                                   data-toggle="modal" data-target="#modalresultCreateIndicator"  >
                                    <?php echo e($labels['addIndicator'] ?? 'addIndicator'); ?>

                                </a>

                            </td>
                        </tr>


                        <?php $indictors = $projectOverallObjective->indicators->where('project_id', $projectOverallObjective->project_id); ?>
                        <?php if($indictors->count()>0): ?>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th><?php echo e($labels_I['indicator_name']??'indicator_name'); ?></th>
                                    <th><?php echo e($labels_I['contributed_to']??'contributed_to'); ?></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $indictors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$indictor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr style=" background-color: #ffffff" width="100%">
                                        <td width="50%"><?php echo e($index+1); ?>

                                            - <?php echo e($indictor->{'level_I_indicator_name_'.lang_character()}); ?></td>
                                        <td>
                                            <?php echo e($indictor->orgIndicator ? $indictor->orgIndicator->{'indic_name_'.lang_character()} : ''); ?>

                                        </td>
                                        <td>

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-sm ">
                                                    <?php echo e($labels['actions']??'actions'); ?>

                                                </button>
                                                <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <i class="fa fa-sort-desc" aria-hidden="true" style=" font-size: 10px;top: -1px;"></i>
                                                </button>


                                                <ul class="dropdown-menu" role="menu" style="    width: 200px;">
                                                    <li>
                                                        <a href="<?php echo e(route('project.results.chain.LevelIEditIndicator',$indictor->id)); ?>"
                                                           id="LevelEditIndicator"
                                                           data-toggle="modal" data-target="#modalresultEditIndicator"
                                                            >
                                                            <?php echo e($labels['editIndicator'] ?? 'editIndicator'); ?>

                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo e(route('project.results.chain.LevelIDeleteIndicator',$indictor->id)); ?>"
                                                           id="btnDeleteLevel_I_Indicator"
                                                           >
                                                            <?php echo e($labels['delete'] ?? 'delete'); ?>

                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="level2">
                    <a class="btn btn-success btn-sm"
                       href="<?php echo e(route('project.results.chain.createSpecific',[$projectOverallObjective->project_id,$projectOverallObjective->id])); ?>"
                       id="AddResultChainSpecific" data-toggle="modal" data-target="#modalAddResultChainSpecific"
                      >
                        <?php echo e($labels['add'] ?? 'add'); ?><?php echo e(' '.$levelIIName); ?>

                        
                    </a>

                    <?php if(isset($projectSpecificObjective) && $projectSpecificObjective->count() > 0): ?>
                        <table class="table">
                            <thead class=" text-primary">
                            <tr>
                                <th>#</th>
                                <th> <?php echo e($labels['Type'] ?? 'type'); ?></th>
                                <th> <?php echo e($labels['Description'] ?? 'Description'); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $projectSpecificObjective; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$specific): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e($specific->serial); ?></td>
                                    <td><?php echo e($specific->levelsType ? $specific->levelsType->{'levels_type_name_'.lang_character()} : ''); ?></td>
                                    <td><p> <?php echo e($specific->{'specific_objective_name_'.lang_character()}); ?></p></td>
                                    <td width="200">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm ">
                                                <?php echo e($labels['actions']??'actions'); ?>

                                            </button>
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="fa fa-sort-desc" aria-hidden="true" style=" font-size: 10px;top: -1px;"></i>

                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="    width: 200px;">
                                                <li>
                                                    <a href="<?php echo e(route('project.results.chain.editSpecific',[$specific->id])); ?>"
                                                       id="EditResultChainSpecific" data-toggle="modal"
                                                       data-target="#modalEditResultChainSpecific" >
                                                        <?php echo e($labels['edit'] ?? 'edit'); ?><?php echo e(' '.$levelIIName); ?>

                                                     </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(route('project.results.chain.deleteSpecific',[$specific->id])); ?>"
                                                       id="DeletedResultChainSpecific" >
                                                        <?php echo e($labels['delete'] ?? 'delete'); ?><?php echo e(' '.$levelIIName); ?>

                                                        
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(route('project.results.chain.LevelIICreateIndicator',$specific->id)); ?>"
                                                       id="LevelIICreateIndicator"
                                                       data-toggle="modal" data-target="#modalresultCreateIndicator" >
                                                        <?php echo e($labels['addIndicator'] ?? 'addIndicator'); ?>

                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </td>
                                </tr>

                                <?php $indictors = $specific->indicators->where('project_id', $specific->project_id); ?>

                                <?php if($indictors->count()>0): ?>
                                    <tr style=" background-color: #f5f5f5; font-weight: 500; font-size: 13px; ">
                                        <td></td>
                                        
                                        <td> <?php echo e($labels['Indicators'] ?? 'Indicators'); ?></td>
                                        <td><?php echo e($labels['contributed_to_following_strategic_objectives'] ?? 'contributed_to_following_strategic_objectives'); ?></td>
                                        <td></td>
                                    </tr>
                                    <?php $__currentLoopData = $indictors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$indictor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr style=" background-color: #f5f5f5; ">
                                            <td></td>
                                            <td><?php echo e($index+1); ?>

                                                -<?php echo e($indictor->{'level_II_indicator_name_'.lang_character()}); ?></td>
                                            <td>
                                                <?php echo e($indictor->orgIndicator ? $indictor->orgIndicator->{'indic_name_'.lang_character()} : ''); ?>

                                            </td>
                                            <td width="200">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success btn-sm ">
                                                        <?php echo e($labels['actions']??'actions'); ?>

                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <i class="fa fa-sort-desc" aria-hidden="true" style=" font-size: 10px;top: -1px;"></i>

                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" style="    width: 200px;">

                                                        <li>
                                                            <a href="<?php echo e(route('project.results.chain.LevelIIEditIndicator',$indictor->id)); ?>"
                                                               id="LevelIIEditIndicator"
                                                               data-toggle="modal"
                                                               data-target="#modalresultEditIndicator" >
                                                                <?php echo e($labels['editIndicator'] ?? 'editIndicator'); ?>

                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo e(route('project.results.chain.LevelIIDeleteIndicator',$indictor->id)); ?>"
                                                               id="btnDeleteLevel_II_Indicator" >
                                                                <?php echo e($labels['delete'] ?? 'delete'); ?>

                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                </div>
                <div class="tab-pane" id="level3">

                    <a class="btn btn-success btn-sm"
                       href="<?php echo e(route('project.results.chain.createResult',$projectOverallObjective->project_id)); ?>"
                       id="AddResultChainResult"
                       data-toggle="modal" data-target="#modalAddResultChainResult" >
                        <?php echo e($labels['add'] ?? 'add'); ?><?php echo e(' '.$levelIIIName); ?>

                     </a>


                    <?php if(isset($projectResult) && $projectResult->count() > 0): ?>
                        <table class="table">
                            <thead class=" text-primary">
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 10%"> <?php echo e($labels['Type'] ?? 'type'); ?></th>
                                <th style="width: 40%"><?php echo e($labels['Description'] ?? 'Description'); ?></th>
                                <th style="width: 30%"><?php echo e($labels['Relation_Higher_Level'] ?? 'Relation_Higher_Level'); ?>  </th>
                                <th style="width: 10%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $projectResult; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                <tr>
                                    <td><?php echo e($result->serial_public); ?></td>
                                    <td><?php echo e($result->levelsType ? $result->levelsType->{'levels_type_name_'.lang_character()} : ''); ?></td>
                                    <td>  <?php echo e($result->{'results_objective_name_'.lang_character()}); ?> </td>
                                    <td>

                                        <p> <?php echo e($result->parent ? $result->parent->{'specific_objective_name_'.lang_character()} : '--'); ?></p>

                                    </td>
                                    <td width="200">

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm ">
                                                <?php echo e($labels['actions']??'actions'); ?>

                                            </button>
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="fa fa-sort-desc" aria-hidden="true" style=" font-size: 10px;top: -1px;"></i>

                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="    width: 200px;">

                                                <li>

                                                    <a href="<?php echo e(route('project.results.chain.editResult',[$result->id])); ?>"
                                                       id="EditResultChainResult"
                                                       data-toggle="modal" data-target="#modalEditResultChainResult"
                                                     >
                                                        <?php echo e($labels['edit'] ?? 'edit'); ?><?php echo e(' '.$levelIIIName); ?>


                                                        
                                                    </a>
                                                </li>
                                                <li>

                                                    <a href="<?php echo e(route('project.results.chain.deleteResult',[$result->id])); ?>"
                                                       id="btnDeleteResultChainResult" >
                                                        <?php echo e($labels['delete'] ?? 'delete'); ?><?php echo e(' '.$levelIIIName); ?>


                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(route('project.results.chain.resultCreateIndicator',[$result->id])); ?>"
                                                       id="resultCreateIndicator"
                                                       data-toggle="modal" data-target="#modalresultCreateIndicator" >
                                                        <?php echo e($labels['resultCreateIndicator'] ?? 'resultCreateIndicator'); ?>

                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <?php $indictors = $result->indicators->where('project_id', $result->project_id); ?>
                                <?php if($indictors->count()>0): ?>
                                    <tr style=" background-color: #f5f5f5; font-weight: 500; font-size: 13px; ">
                                        <td style="width: 5%;background-color: #fcfcfc; border: 1px solid  #fafafa; "></td>
                                        <td style="width: 50%" colspan="2"> <?php echo e($labels['Indicators'] ?? 'Indicators'); ?></td>
                                         <td style="width: 30%"><?php echo e($labels['contributed_to_following_strategic_objectives'] ?? 'contributed_to_following_strategic_objectives'); ?></td>

                                        <td style="width: 10%"></td>
                                    </tr>

                                    <?php $__currentLoopData = $indictors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$indictor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr style=" background-color: #f5f5f5; ">
                                            <td style=" background-color: #fcfcfc; border: 1px solid  #fafafa; "></td>
                                            <td colspan="2"><?php echo e($index+1); ?>

                                                - <?php echo e($indictor->{'results_indicator_name_'.lang_character()}); ?>

                                            </td>
                                            <td>
                                                <?php echo e($indictor->orgIndicator ? $indictor->orgIndicator->{'indic_name_'.lang_character()} : ''); ?>

                                            </td>
                                            <td width="200">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success btn-sm ">
                                                        <?php echo e($labels['actions']??'actions'); ?>

                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <i class="fa fa-sort-desc" aria-hidden="true" style=" font-size: 10px;top: -1px;"></i>

                                                    </button>
                                                    <ul class="dropdown-menu" role="menu" style="    width: 200px;">

                                                        <li>
                                                            <a href="<?php echo e(route('project.results.chain.resultEditIndicator',[$indictor->id])); ?>"
                                                               id="resultEditIndicator"
                                                               data-toggle="modal"
                                                               data-target="#modalresultEditIndicator" >
                                                                <?php echo e($labels['resultEditIndicator'] ?? 'resultEditIndicator'); ?>

                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo e(route('project.results.chain.LevelIIIDeleteIndicator',$indictor->id)); ?>"
                                                               id="btnDeleteLevel_III_Indicator" >
                                                                <?php echo e($labels['delete'] ?? 'delete'); ?>

                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
                <div class="tab-pane" id="level4">
                    <a class="btn btn-success btn-sm"
                       href="<?php echo e(route('project.results.chain.createActivity',$projectOverallObjective->project_id)); ?>"
                       id="AddResultChainActivity"
                       data-toggle="modal" data-target="#modalAddResultChainActivity" >
                        <?php echo e($labels['project_add_activity'] ?? 'project_add_activity'); ?>

                    </a>

                    <?php if(isset($projectActivity) && $projectActivity->count() > 0): ?>
                        <table class="table">
                            <thead class=" text-primary">
                            <tr>
                                <th> <?php echo e($labels['activity'] ?? 'activity'); ?> </th>
                                <th>  <?php echo e($labels['level_result_chain'] ?? 'level_result_chain'); ?>  </th>
                                <th width="200"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $projectActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><p> <?php echo e($activity->serial_public ." " .$activity->{'activity_name_'.lang_character()}); ?></p></td>
                                    <td><p> <?php echo e($activity->level_name); ?></p></td>
                                    <td width="60px">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm ">
                                                <?php echo e($labels['actions']??'actions'); ?>

                                            </button>
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <i class="fa fa-sort-desc" aria-hidden="true" style=" font-size: 10px;top: -1px;"></i>

                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="    width: 200px;">

                                                <li>
                                                    <a href="<?php echo e(route('project.results.chain.editActivity',$activity->id)); ?>"

                                                       id="resultEditActivity"
                                                       data-toggle="modal" data-target="#modalresultEditActivity" >
                                                        <?php echo e($labels['edit'] ?? 'edit'); ?>

                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo e(route('activity.activity.create',['main',$activity->id])."?". rand()); ?>" >
                                                        <?php echo e($labels['result_chain_activity_description'] ?? 'result_chain_activity_description'); ?>


                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

<?php endif; ?>







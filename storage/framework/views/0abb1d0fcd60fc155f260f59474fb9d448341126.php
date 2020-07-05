
<div>
    <?php echo $create_html; ?>

</div>
<br>
<br>
<hr>

<div id="loaderTableLocation" align="center" class="col-md-12 " style="display: none">
    <div class="loader loader-div"></div>
</div>'

<div id="locationTable">

    <table class="table">
        <thead>
        <tr class="background-color-indicator-activity">
            <th>#</th>
            <th>
                <?php echo e($labels['city_name'] ?? 'city_name'); ?>

            </th>
            <th>
                <?php echo e($labels['destrict_'] ?? 'destrict_'); ?>

            </th>
            <th>
                <?php echo e($labels['location_'.lang_character()] ?? 'location_na'); ?>

            </th>
            <th>
                <?php echo e($labels['team_member'] ?? 'team_member'); ?>

            </th>
            <th>
                <?php echo e($labels['actions'] ?? 'actions'); ?>

            </th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index+1); ?></td>
                <td><?php echo e($location->{'city_name_'.lang_character()}); ?></td>
                <td><?php echo e($location->{'district_name_'.lang_character()}); ?></td>
                <td><?php echo e($location->location_na); ?></td>
                <td><?php echo e($location->{'staff_name_'.lang_character()}); ?></td>
                <td>
                    <a href="<?php echo e(route('activity.location.edit',$location->id)); ?>" rel="tooltip"
                       class="btn btn-sm  btn-round btn-success btn-fab"
                       rel="tooltip" data-original-title="" title="<?php echo e($labels['edit'] ?? 'edit'); ?>"
                       data-placement="top" id="btnEditActivityLocation" >
                        <i class="material-icons">edit</i>
                    </a>
                    <a href="<?php echo e(route('activity.location.destroy',$location->id)); ?>"
                       id="btnDeleteActivityLocation" rel="tooltip" class="btn btn-sm btn-danger btn-fab btn-round"
                       title="<?php echo e($labels['delete'] ?? 'delete'); ?>">
                        <i class="material-icons">delete</i>
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
<div class="col-md-12">

    <a href="#" class="btn btn-previous btn-default btn-sm pull-left" id="previousActivityTab">
        <?php echo e($labels['previous']??'previous'); ?>

    </a>

    <a href="#" class="btn btn-next btn-default  btn-sm pull-right " id="btnNextStaff">
        <?php echo e($labels['next']??'next'); ?>

    </a>

</div>

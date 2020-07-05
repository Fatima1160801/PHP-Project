<div class="col-lg-4 col-md-6 col-sm-6 sort-itm" data-fileid="2" style="cursor: move;">
    <div class="card card-stats">
        <div class="card-header card-header-rose m-auto card-header-icon force-m-t">
            <div class="card-icon">

                <span class="card-category parg-white"><?php echo e($labels_activity['activities']??'activities'); ?> ( <?php echo e($activities ? $activities->count() : 0); ?> )</span>

            </div>


        </div>
        <div class="card-footer">
            <table class="table">
                <tr>
                    <td><?php echo e($labels['Not_started']??'Not_started'); ?></td>
                    <td>
                        <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($activities ? $activities->where('status_id',1)->count() : 0); ?>

                        </b>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e($labels['Pending']??'Pending'); ?></td>
                    <td>
                        <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($activities ?  $activities->where('status_id',2)->count() : 0); ?>

                        </b>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e($labels['ongoing']??'ongoing'); ?></td>
                    <td>
                        <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($activities ?  $activities->where('status_id',3)->count() : 0); ?>

                        </b>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e($labels['Finished']??'Finished'); ?></td>
                    <td>
                        <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($activities ?  $activities->where('status_id',4)->count() : 0); ?></b>
                    </td>
                </tr>

            </table>
            </table>
        </div>
    </div>
</div>
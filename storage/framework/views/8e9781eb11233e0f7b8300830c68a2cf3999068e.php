<div class="col-lg-4 col-md-6 col-sm-6 sort-itm" data-fileid="1" style="cursor: move;">
    <div class="card card-stats">
        <div class="card-header card-header-primary m-auto card-header-icon force-m-b force-m-t">
            <div class="card-icon">

                <span class="card-category parg-white"><?php echo e($labels_project['project']??'project'); ?> ( <?php echo e($projects ? $projects->count() : 0); ?> )</span>

            </div>



        </div>
        <div class="card-footer">
            <table class="table">
                <tr>
                    <td><?php echo e($labels['ongoing']??'ongoing'); ?></td>
                    <td>
                        <b style="font-size: 18px;color:#0da528;font-weight: 500;"><?php echo e($projects ?  $projects->where('is_hidden',0)->count() : 0); ?></b>
                    </td>
                </tr>
                <tr>
                    <td><?php echo e($labels['closed']??'closed'); ?></td>
                    <td>
                        <b style="font-size: 18px;color:#fd2d2d;font-weight: 500;"><?php echo e($projects ? $projects->where('is_hidden',1)->count() : 0); ?></b>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
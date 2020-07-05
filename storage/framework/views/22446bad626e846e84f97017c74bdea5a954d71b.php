<tr data-id="<?php echo e($group->id); ?>">

    <td><?php echo e(isset($loop->iteration) ? $loop->iteration : '{index}'); ?></td>
    <td><?php echo e($group->group_name); ?></td>
    <td><?php echo e($group->user->user_full_name); ?></td>
    <td class="td-actions " >
        <a  href="<?php echo e(route('permission.group.edit',$group->id)); ?>" class=" btnEdit btn btn-primary btn-round"
            rel="tooltip"  data-original-title="top" title="ُEdit Group">
            <i class="material-icons">edit</i>
        </a>

        <a href="<?php echo e(route('permission.permission.index',['group',$group->id])); ?>" rel="tooltip"
           class="btn btn-info btn-round" data-original-title="top" title="ُGrant Permission">
            <i class="material-icons">vpn_key</i>
        </a>

    </td>
</tr>
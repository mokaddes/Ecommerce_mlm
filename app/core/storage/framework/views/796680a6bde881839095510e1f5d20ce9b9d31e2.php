<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td>
        <?php echo e($data->first_name); ?> <?php echo e($data->last_name); ?>

    </td>
    <td>
        <?php echo e($data->email); ?>

    </td>
    <td>
        <?php echo e($data->phone); ?>

    </td>
    <td>
        <?php echo e($data->own_referal); ?>

    </td>
    <td>
        <?php echo e($data->referal_id); ?>

    </td>


    <td>
        
        <div class="dropdown">
            <button class="btn btn-<?php echo e($data->status == 1 ? 'success' : 'danger'); ?> btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo e($data->status == 1 ? __('Enabled') : __('Disabled')); ?>

            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="<?php echo e(route('back.user.active',$data->id)); ?>"><?php echo e(__('Enable')); ?></a>
              <a class="dropdown-item" href="<?php echo e(route('back.user.inactive',$data->id)); ?>"><?php echo e(__('Disable')); ?></a>
            </div>
        </div>
    </td>
    <td>
        <a class="btn btn-secondary btn-sm "
                href="<?php echo e(route('back.user.refer',$data->id)); ?>">
                <i class="fas fa-eye"></i>
            </a>
    </td>

    <td>
        <div class="action-list">

            <a class="btn btn-secondary btn-sm "
                href="<?php echo e(route('back.user.show',$data->id)); ?>">
                <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm " data-toggle="modal"
                data-target="#confirm-delete" href="javascript:;"
                data-href="<?php echo e(route('back.user.destroy',$data->id)); ?>">
                <i class="fas fa-trash-alt"></i>
            </a>
            
        </div>
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/back/user/table.blade.php ENDPATH**/ ?>
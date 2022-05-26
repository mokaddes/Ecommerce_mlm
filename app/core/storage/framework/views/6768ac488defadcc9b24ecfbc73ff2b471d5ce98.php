
<?php $__env->startSection('content'); ?>
    <div class="col-md-8 container-fluid">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h5>Send Referal ID</h5>
                </div>
                <form action="<?php echo e(route('back.user.referal_submit')); ?>" class="d-inline btn-ok" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="col-lg-12 form-group">
                            <label for="transaction">Email</label>
                            <input type="email" class="form-control" name="referal_email" id="" value=" <?php echo e($user->referal_email); ?> " readonly>
                            <?php $__errorArgs = ['referal_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger"><?php echo e($message); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-12 form-group">
                            <label for="transaction">Referal ID</label>
                            <input type="text" class="form-control" name="referal_id" id="" placeholder="Enter referal id" required>
                            <?php $__errorArgs = ['referal_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger"><?php echo e($message); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-2 form-group" style="float: right">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </form>

              </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/back/user/send_referal.blade.php ENDPATH**/ ?>

<?php $__env->startSection('title'); ?>
<?php echo e(__('register')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
.payment-methods .single-payment-method {
margin: 21px auto;
}
.form-control{
    padding: 10px 18px;
}
@media  screen and (max-width: 576px){
    .payment-methods .single-payment-method {
        width: 100%;
    }
}
</style>
<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
                    <li class="separator"></li>
                    <li><?php echo e(__('Register')); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page Content-->
<div class="container padding-bottom-3x mb-1">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-10 col-lg-11">
            <div class="steps flex-sm-nowrap mb-5">
                <a class="step" href="<?php echo e(route('user.register')); ?>">
                    <h4 class="step-title">1. <?php echo e(__('Register')); ?>:</h4>
                </a>
                <a class="step" href="<?php echo e(route('user.choose.product')); ?>">
                    <h4 class="step-title">2. <?php echo e(__('Products choose option')); ?>:</h4>
                </a>
                <a class="step " href="<?php echo e(route('user.shipping.address')); ?>">
                    <h4 class="step-title">3. <?php echo e(__('Shipping Address')); ?>:</h4>
                </a>
                <a class="step" href="<?php echo e(route('user.referal')); ?>">
                    <h4 class="step-title">3. <?php echo e(__('Referal ID')); ?></h4>
                </a>
                <a class="step active" href="<?php echo e(route('user.payment')); ?>">
                    <h4 class="step-title">4. <?php echo e(__('Payment option')); ?></h4>
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6><?php echo e(__('Payment option')); ?></h6>
                    <div class="card register-area">
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-12 mb-3 text-center">
                                        <?php echo e($qrcode); ?>

                                    </div>
                                    <div class="col-sm-7 col-lg-5">
                                        <form action=" <?php echo e(route('user.payment.submit')); ?> " method="POST" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="col-lg-12 form-group">
                                                <label for="transaction">Transaction Number</label>
                                                <input class="form-control" name="txn_id" id="transaction" placeholder="Enter Your Transaction Number" >
                                                <?php $__errorArgs = ['txn_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <p class="text-danger"><?php echo e($message); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-lg-12 form-group">
                                                <label for="transaction">Payment Proof Photo</label>
                                                <input type="file" class="form-control" name="txn_pic" id="" required="">

                                            </div>
                                            <div class="col-12 text-center">
                                                <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary btn-sm" type="submit"><span>Checkout With Bank Transfer</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/user/auth/register/payment.blade.php ENDPATH**/ ?>
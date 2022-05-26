


<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo e(__('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
                    <li class="separator"></li>
                    <li><?php echo e(__('Welcome Back')); ?> </li>
                  </ul>
            </div>
        </div>
    </div>
  </div>

  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
  <div class="row">
         <?php echo $__env->make('includes.user_sitebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
         <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                <div class="row u-d-d">
                        <?php if(Auth::user()->status == 1): ?>
                             <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3"><?php echo e(__('Your Wallet')); ?></p>
                                        <h5><b><?php echo e(Auth::user()->points * 1.00); ?>.00 SGD</b></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3"><?php echo e(__('Your Points')); ?></p>
                                        <h5><b> <?php echo e(Auth::user()->points ?? '0'); ?> </b></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3"><?php echo e(__('All Order')); ?></p>
                                        <h4><b><?php echo e($allorders); ?></b></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3"><?php echo e(__('Completed Order')); ?></p>
                                        <h4><b><?php echo e($delivered); ?></b></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3"><?php echo e(__('Processing Order')); ?></p>
                                        <h4><b><?php echo e($progress); ?></b></h4>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3"><?php echo e(__('Canceled Order')); ?></p>
                                        <h4><b><?php echo e($canceled); ?></b></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3"><?php echo e(__('Pending Order')); ?></p>
                                        <h4><b><?php echo e($pending); ?></b></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card round">
                                    <div class="card-body text-center">
                                        <i class="icon-shopping-bag"></i>
                                        <p class="mt-3"><?php echo e(__('Refer User')); ?></p>
                                        <h4><b><?php echo e($users); ?></b></h4>
                                    </div>
                                </div>
                            </div>
                            <?php elseif(empty(Auth::user()->signup_product)): ?>
                                <div class="alert alert-success">
                                    <p>You are not choose any product.</p>
                                    <strong> Please choose a product to complete your registration.... </strong>
                                    <br>
                                    <br>
                                    <a href="<?php echo e(route('user.choose.product')); ?>" class="btn btn-primay btn-sm">Click here</a>
                                </div>



                            <?php elseif(empty($referal)  && Auth::user()->referal_id == ''): ?>
                                <div class="alert alert-danger">
                                    <p>
                                        No referal id!!! Please mail Admin for Referal Id. A referal id will sent to you as soon as possiable.
                                        <span>Please complete your registration.... </span>
                                    <br>
                                    <br>
                                    <a href="<?php echo e(route('user.referal')); ?>" class="btn btn-primay btn-sm">Click here</a>
                                    </p>
                                    
                                </div>
                            <?php elseif(isset($referal) && $referal->referal_email != '' && $referal->referal_id == '' && Auth::user()->referal_id == ''): ?>
                                <div class="alert alert-primary">
                                    <p>Your Email is sent. Please wait for admin response..</p>
                                </div>
                            <?php elseif(isset($referal) && $referal->referal_id != '' && empty(Auth::user()->referal_id)): ?>
                                <div class="alert alert-success">
                                    <p>A mail is sent to your email: <?php echo e($referal->referal_email); ?></p>
                                    <strong>Your Referal Id: <span class="badge badge-primary"><?php echo e($referal->referal_id); ?></span> </strong>
                                    <span>Please complete your registration.... </span>
                                    <br>
                                    <br>
                                    <a href="<?php echo e(route('user.referal')); ?>" class="btn btn-primay btn-sm">Click here</a>
                                </div>
                            <?php elseif(empty(Auth::user()->txn_id) && Auth::user()->referal_id != ''): ?>
                                <div class="alert alert-success">
                                    <p>You payment is not varified.</p>
                                    <strong> Please provide payment document to complete your registration.... </strong>
                                    <br>
                                    <br>
                                    <a href="<?php echo e(route('user.payment')); ?>" class="btn btn-primay btn-sm">Click here</a>
                                </div>
                            <?php elseif(Auth::user()->referal_id != ''): ?>
                                <div class="alert alert-warning">
                                    <p>
                                        Your account is not active yet. We will make you active as soon as possiable.
                                    </p>
                                </div>
                        <?php endif; ?>
                    </div>
            </div>
        </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/user/dashboard/dashboard.blade.php ENDPATH**/ ?>
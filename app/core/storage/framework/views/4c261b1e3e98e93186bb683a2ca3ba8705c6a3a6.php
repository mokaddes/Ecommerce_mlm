
<?php $__env->startSection('title'); ?>
    <?php echo e(__('register')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
    if (Session::has('register')) {
        $id = Session::get('register');
        $user = DB::table('users')->where('id', $id)->first();
    }
?>

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
            <a class="step active" href="<?php echo e(route('user.referal')); ?>">
              <h4 class="step-title">3. <?php echo e(__('Referal ID')); ?></h4>
            </a>
            <?php if(Session::has('referal')): ?>
                <a class="step" href="<?php echo e(route('user.payment')); ?>">
                    <h4 class="step-title">4. <?php echo e(__('Payment option')); ?></h4>
                </a>
            <?php else: ?>
                <a class="step" href="#">
                    <h4 class="step-title">4. <?php echo e(__('Payment option')); ?></h4>
                </a>
            <?php endif; ?>
        </div>

        <div class="card">
            <div class="card-header">
                <?php if($m = Session::get('warning')): ?>
                    <div class="alert alert-danger">
                        <?php echo e($m); ?>

                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                  <h6><?php echo e(__('Referal ID')); ?></h6>
                  <div class="card register-area">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-sm-7 col-lg-5">
                                    <form id="" action=" <?php echo e(route('user.referal.submit')); ?> " method="POST">
                                          <?php echo csrf_field(); ?>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="reg-fn"><?php echo e(__('Referal ID')); ?></label>
                                                <input class="form-control" type="text" name="referal_id" placeholder="" id=""  >
                                                <?php $__errorArgs = ['referal_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <p class="text-danger"><?php echo e($message); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="mb-3">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#bank">Don't have referal id send mail admin to get ID.</a>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                           <button class="btn btn-primary margin-bottom-none" type="submit"><span><?php echo e(__('Next')); ?></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                      </div>
                  </div>
            </div>
        </div>

        <!-- modal -->
        <div class="modal fade" id="bank" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Request to admin for referal ID</h6>
                        <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form action=" <?php echo e(route('user.referal.mail')); ?> " method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <?php if(Auth::user()): ?>
                                <div class="col-lg-12 form-group">
                                    <label for="transaction">Email</label>
                                    <input type="email" class="form-control" name="referal_email" id="" value=" <?php echo e(Auth::user()->email); ?> " readonly required>
                                    <?php $__errorArgs = ['referal_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger"><?php echo e($message); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php elseif(empty(Auth::user()) && Session::has('register')): ?>
                                <div class="col-lg-12 form-group">
                                    <label for="transaction">Email</label>
                                    <input type="email" class="form-control" name="referal_email" id="" value=" <?php echo e($user->email); ?> " readonly required>
                                    <?php $__errorArgs = ['referal_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger"><?php echo e($message); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="col-lg-12 form-group">
                                    <label for="transaction">Email</label>
                                    <input type="email" class="form-control" name="referal_email" id="" placeholder="Enter your email" required >
                                    <?php $__errorArgs = ['referal_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger"><?php echo e($message); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="col-lg-12 form-group">
                                <label for="transaction">Special Request</label>
                                <textarea name="referal_message" id="" class="form-control" placeholder="Enter your speical request message" required></textarea>
                                <?php $__errorArgs = ['referal_message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-danger"><?php echo e($message); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary btn-sm" type="submit"><span>Send</span></button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

      </div>
    </div>
  </div>
  <!-- Site Footer-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/user/auth/register/referal_id.blade.php ENDPATH**/ ?>
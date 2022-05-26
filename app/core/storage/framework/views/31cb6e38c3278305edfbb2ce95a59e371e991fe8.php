
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Login')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- Page Title-->
<div class="page-title">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumbs">
                <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
                <li class="separator"></li>
                <li><?php echo e(__('Login/Register')); ?></li>
              </ul>
          </div>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
  <div class="row d-flex justify-content-center">
          <div class="col-sm-8 col-md-6 col-lg-5">
            <form class="card" method="post" action="<?php echo e(route('user.login.submit')); ?>">
                <?php echo csrf_field(); ?>
              <div class="card-body ">
                <h4 class="margin-bottom-1x text-center"><?php echo e(__('Login')); ?></h4>

                <div class="form-group input-group">
                  <input class="form-control" type="email" name="login_email" placeholder="<?php echo e(__('Email')); ?>" value="<?php echo e(old('login_email')); ?>"><span class="input-group-addon"><i class="icon-mail"></i></span>
                </div>
                 <?php $__errorArgs = ['login_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                   <p class="text-danger"><?php echo e($message); ?></p>
                 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <div class="form-group input-group">
                  <input class="form-control" type="password" name="login_password" placeholder="<?php echo e(__('Password')); ?>" ><span class="input-group-addon"><i class="icon-lock"></i></span>
                </div>
                <?php $__errorArgs = ['login_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-danger"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="remember_me">
                        <label class="custom-control-label" for="remember_me"><?php echo e(__('Remember me')); ?></label>
                    </div><a class="navi-link" href="<?php echo e(route('user.forgot')); ?>"><?php echo e(__('Forgot password?')); ?></a>
                </div>
                  <div class="text-center">
                      <button class="btn btn-primary margin-bottom-none" type="submit"><span><?php echo e(__('Login')); ?></span></button>
                  </div>
                  <div class="text-center mt-3">
                    <span>Not a member? <a href="<?php echo e(route('user.register')); ?>">Sign Up</a></span>
                </div>
              </div>
            </form>
          </div>
        </div>
  </div>
  <!-- Site Footer-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/user/auth/login.blade.php ENDPATH**/ ?>
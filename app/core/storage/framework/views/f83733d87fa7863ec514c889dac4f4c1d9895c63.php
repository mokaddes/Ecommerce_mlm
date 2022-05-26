

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
<style>
    .card.register_benefit h5 {border-bottom: 1px solid #EEE;padding-bottom: 8px;font-size: 16px;color: #333;font-weight: 500;}
    .card-body ul li {font-size: 14px;color: #555;padding: 6px 0px;}
</style>
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
    <div class="row">
        <div class="col-xl-3 order-xl-2 mb-5">
            <div class="card register_benefit">
                <div class="card-body">
                    <h5>Sign up as new member today for just <strong>SGD17/RM 50</strong> and get the following benefit</h5>
                    <ul>
                        <li>CHOICE ON 1 E-BOOK</li>
                        <li>DIRECT REFERRAL 20% PER ACCTOUNT</li>
                        <li>EARN MONTHLY REWARDS POINTS 15- 50 PTS </li>
                         <li>2ND LEVEL INDIRECT REFERAL 10% PER ACCT</li>
                        <li>DISCOUNTED PRICE ON SELECTED PRODUCTS ONLINE</li>
                        <li>FREE POWER ECHANCMENT CARD VALUE AT SGD 27 PER CARD</li>
                        <li>LUCKY DRAW AWAITS FOR ANYONE WHO SIGN UP IN THE FIRST 2 MONTHS</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-9 order-xl-1">
            <div class="steps flex-sm-nowrap mb-5">
                <a class="step active" href="<?php echo e(route('user.register')); ?>">
                    <h4 class="step-title">1. <?php echo e(__('Register')); ?>:</h4>
                </a>
                <?php if(Session::has('register')): ?>
                <a class="step " href="<?php echo e(route('user.choose.product')); ?>">
                    <h4 class="step-title">2. <?php echo e(__('Products')); ?>:</h4>
                </a>
                <?php else: ?>
                <a class="step " href="#">
                    <h4 class="step-title">2. <?php echo e(__('Products')); ?>:</h4>
                </a>
                <?php endif; ?>
                <?php if(Session::has('choose') && Session::has('register')): ?>
                    <a class="step " href="<?php echo e(route('user.shipping.address')); ?>">
                        <h4 class="step-title">3. <?php echo e(__('Shipping Address')); ?>:</h4>
                    </a>
                <?php else: ?>
                    <a class="step " href="#">
                        <h4 class="step-title">3. <?php echo e(__('Shipping Address')); ?>:</h4>
                    </a>
                <?php endif; ?>
                <?php if(Session::has('shipping_address')): ?>
                    <a class="step" href="<?php echo e(route('user.referal')); ?>">
                        <h4 class="step-title">3. <?php echo e(__('Referal ID')); ?></h4>
                    </a>
                <?php else: ?>
                    <a class="step" href="#">
                        <h4 class="step-title">3. <?php echo e(__('Referal ID')); ?></h4>
                    </a>
                <?php endif; ?>
                <?php if(Session::has('referal') && Session::has('register')): ?>
                <a class="step" href="<?php echo e(route('user.payment')); ?>">
                    <h4 class="step-title">5. <?php echo e(__('Payment')); ?></h4>
                </a>
                <?php else: ?>
                <a class="step" href="#">
                    <h4 class="step-title">5. <?php echo e(__('Payment')); ?></h4>
                </a>
                <?php endif; ?>
            </div>
            <div class="card">
                <div class="card-body">
                    <h6><?php echo e(__('Register')); ?></h6>
                    <div class="card register-area">
                        <div class="card-body">
                            <form id="checkoutBilling" class="row" action="<?php echo e(route('user.register.submit')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="part" value="register">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-fn"><?php echo e(__('First Name')); ?></label>
                                        <input class="form-control" type="text" name="first_name" placeholder="<?php echo e(__('First Name')); ?>" id="reg-fn" value="<?php echo e($user->first_name ?? ''); ?>">
                                        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger"><?php echo e($message); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-ln"><?php echo e(__('Last Name')); ?></label>
                                        <input class="form-control" type="text" name="last_name" placeholder="<?php echo e(__('Last Name')); ?>" id="reg-ln" value="<?php echo e($user->last_name ?? ''); ?>">
                                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger"><?php echo e($message); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-email"><?php echo e(__('E-mail Address')); ?></label>
                                        <input class="form-control" type="email" name="email" placeholder="<?php echo e(__('E-mail Address')); ?>" id="reg-email" value="<?php echo e($user->email ?? ''); ?>">
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger"><?php echo e($message); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-phone"><?php echo e(__('Phone Number')); ?></label>
                                        <input class="form-control" name="phone" type="text" placeholder="<?php echo e(__('Phone Number')); ?>" id="reg-phone" value="<?php echo e($user->phone ?? ''); ?>">
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger"><?php echo e($message); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-pass"><?php echo e(__('Password')); ?></label>
                                        <input class="form-control" type="password" name="password" placeholder="<?php echo e(__('Password')); ?>" id="reg-pass">
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger"><?php echo e($message); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg-pass-confirm"><?php echo e(__('Confirm Password')); ?></label>
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="<?php echo e(__('Confirm Password')); ?>" id="reg-pass-confirm">
                                    </div>
                                </div>
                                <?php if($setting->recaptcha == 1): ?>
                                <div class="col-lg-12 mb-4">
                                    <?php echo NoCaptcha::renderJs(); ?>

                                    <?php echo NoCaptcha::display(); ?>

                                    <?php if($errors->has('g-recaptcha-response')): ?>
                                    <?php
                                    $errmsg = $errors->first('g-recaptcha-response');
                                    ?>
                                    <p class="text-danger mb-0"><?php echo e(__("$errmsg")); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
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
</div>
<!-- Site Footer-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/user/auth/register.blade.php ENDPATH**/ ?>
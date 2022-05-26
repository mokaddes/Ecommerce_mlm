

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
				<?php if(Session::has('register')): ?>
				<a class="step " href="<?php echo e(route('user.choose.product')); ?>">
					<h4 class="step-title">2. <?php echo e(__('Products')); ?>:</h4>
				</a>
				<?php else: ?>
				<a class="step " href="#">
					<h4 class="step-title">2. <?php echo e(__('Products')); ?>:</h4>
				</a>
				<?php endif; ?>
				<a class="step active" href="<?php echo e(route('user.shipping.address')); ?>">
					<h4 class="step-title">3. <?php echo e(__('Shipping Address')); ?>:</h4>
				</a>
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
					<h6><?php echo e(__('Shipping Address')); ?></h6>
					<div class="card">
						<div class="card-body">
							<form id="checkoutShipping" action="<?php echo e(route('user.shipping_submit')); ?>" method="POST">
								<?php echo csrf_field(); ?>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-fn"><?php echo e(__('First Name')); ?></label>
											<input class="form-control" name="first_name" type="text" id="checkout-fn" value="<?php echo e(isset($user) ? $user->first_name : ''); ?>" readonly>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-ln"><?php echo e(__('Last Name')); ?></label>
											<input class="form-control" name="last_name" type="text" id="checkout-ln" value="<?php echo e(isset($user) ? $user->last_name : ''); ?>" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-email"><?php echo e(__('E-mail Address')); ?></label>
											<input class="form-control" name="email" type="email" id="checkout-email" value="<?php echo e(isset($user) ? $user->email : ''); ?>" readonly>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-phone"><?php echo e(__('Phone Number')); ?></label>
											<input class="form-control" name="phone" type="text" id="checkout-phone" value="<?php echo e(isset($user) ? $user->phone : ''); ?>" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="checkout-company"><?php echo e(__('Company')); ?></label>
											<input class="form-control" name="ship_company" type="text" id="checkout-company" value="<?php echo e(isset($user) ? $user->ship_company : ''); ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-address1"><?php echo e(__('Address')); ?> 1</label>
											<input class="form-control" name="ship_address1" required type="text" id="checkout-address1" value="<?php echo e(isset($user) ? $user->ship_address1 : ''); ?>" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-address2"><?php echo e(__('Address')); ?> 2</label>
											<input class="form-control" name="ship_address2" type="text" id="checkout-address2" value="<?php echo e(isset($user) ? $user->ship_address2 : ''); ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-zip"><?php echo e(__('Zip Code')); ?></label>
											<input class="form-control" name="ship_zip" type="text" id="checkout-zip" value="<?php echo e(isset($user) ? $user->ship_zip : ''); ?>" >
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="checkout-city"><?php echo e(__('City')); ?></label>
											<input class="form-control" name="ship_city" required type="text" id="checkout-city" value="<?php echo e(isset($user) ? $user->ship_city : ''); ?>" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="checkout-country"><?php echo e(__('Country')); ?></label>
											<select class="form-control" name="ship_country" required id="billing-country">
												<option selected><?php echo e(__('Choose Country')); ?></option>
												<?php $__currentLoopData = DB::table('countries')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($country->name); ?>" <?php echo e(isset($user) && $user->ship_country == $country->name ? 'selected' :''); ?> ><?php echo e($country->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
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
</div>
<!-- Site Footer-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/user/auth/register/shipping_address.blade.php ENDPATH**/ ?>
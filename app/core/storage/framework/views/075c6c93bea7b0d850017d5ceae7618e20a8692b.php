

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Shipping')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page Title-->
<div class="page-title">
    <div class="container">
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('Home')); ?></a> </li>
          <li class="separator"></li>
          <li><?php echo e(__('Shipping address')); ?></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1  checkut-page">
    <div class="row">
      <!-- Shipping Adress-->
      <div class="col-xl-9 col-lg-8">
        <div class="steps flex-sm-nowrap mb-5">
          <?php if(Auth::user()->status == 1): ?>
            </a><a class="step active" href="<?php echo e(route('front.checkout.shipping')); ?>">
            <h4 class="step-title">2. <?php echo e(__('Shipping Address')); ?>:</h4>
            </a><a class="step" href="<?php echo e(route('front.checkout.payment')); ?>">
            <h4 class="step-title">3. <?php echo e(__('Review and pay')); ?></h4>
            </a>
          <?php else: ?>
            <a class="step" href="<?php echo e(route('front.checkout.billing')); ?>">
            <h4 class="step-title">1. <?php echo e(__('Billing Address')); ?>:</h4>
            </a><a class="step active" href="<?php echo e(route('front.checkout.shipping')); ?>">
            <h4 class="step-title">2. <?php echo e(__('Shipping Address')); ?>:</h4>
            </a><a class="step" href="<?php echo e(route('front.checkout.payment')); ?>">
            <h4 class="step-title">3. <?php echo e(__('Review and pay')); ?></h4>
            </a>
          <?php endif; ?>
        </div>
        <div class="card">
            <div class="card-body">
                <h6><?php echo e(__('Shipping Address')); ?></h6>

          <form id="checkoutShipping" action="<?php echo e(route('front.checkout.shipping.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="checkout-fn"><?php echo e(__('First Name')); ?></label>
              <input class="form-control" name="ship_first_name" type="text" id="checkout-fn" value="<?php echo e(isset($user) ? $user->first_name : ''); ?>" >
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="checkout-ln"><?php echo e(__('Last Name')); ?></label>
              <input class="form-control" name="ship_last_name" type="text" id="checkout-ln" value="<?php echo e(isset($user) ? $user->last_name : ''); ?>" >
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="checkout-email"><?php echo e(__('E-mail Address')); ?></label>
              <input class="form-control" name="ship_email" type="email" id="checkout-email" value="<?php echo e(isset($user) ? $user->email : ''); ?>" >
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="checkout-phone"><?php echo e(__('Phone Number')); ?></label>
              <input class="form-control" name="ship_phone" type="text" id="checkout-phone" value="<?php echo e(isset($user) ? $user->phone : ''); ?>" >
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


        <div class="d-flex justify-content-between paddin-top-1x mt-4">
            <a class="btn btn-primary btn-sm" href="<?php echo e(route('front.cart')); ?>"><span class="hidden-xs-down"><i class="icon-arrow-left"></i> <?php echo e(__('Back To Cart')); ?></span>
            </a><button class="btn btn-primary  btn-sm" type="submit"><span class="hidden-xs-down"><?php echo e(__('Continue')); ?></span><i class="icon-arrow-right"></i></button></div>
        </form>
            </div>
        </div>
      </div>
      <!-- Sidebar          -->
      <?php echo $__env->make('includes.checkout_sitebar',$cart, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/front/checkout/shipping.blade.php ENDPATH**/ ?>
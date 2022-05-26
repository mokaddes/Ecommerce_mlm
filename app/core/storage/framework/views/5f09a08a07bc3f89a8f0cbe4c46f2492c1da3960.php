
<?php $__env->startSection('title'); ?>
<?php echo e(__('register')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
        function renderStarRating($rating,$maxRating=5) {

            $fullStar = "<i class = 'far fa-star filled'></i>";
            $halfStar = "<i class = 'far fa-star-half filled'></i>";
            $emptyStar = "<i class = 'far fa-star'></i>";
            $rating = $rating <= $maxRating?$rating:$maxRating;

            $fullStarCount = (int)$rating;
            $halfStarCount = ceil($rating)-$fullStarCount;
            $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

            $html = str_repeat($fullStar,$fullStarCount);
            $html .= str_repeat($halfStar,$halfStarCount);
            $html .= str_repeat($emptyStar,$emptyStarCount);
            $html = $html;
            return $html;
        }

        // $last_user = DB::table('users')->last();
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
            <a class="step active" href="<?php echo e(route('user.choose.product')); ?>">
                <h4 class="step-title">2. <?php echo e(__('Products choose option')); ?>:</h4>
            </a>
        <?php else: ?>
            <a class="step active" href="">
                <h4 class="step-title">2. <?php echo e(__('Products choose option')); ?>:</h4>
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
          </div>
        <div class="card-body">
          <h6><?php echo e(__('Choose Product')); ?></h6>

          <div class="row g-3" id="main_div">
              <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-xxl-4 col-md-4 col-sm-4 col-xs-12">
                <div class="product-card ">
                  

                  <div class="product-thumb">
                    <img class="lazy" alt="Product" src="<?php echo e(asset('assets/images/'.$item->photo)); ?>">
                    
                  </div>
                  <div class="product-card-body">
                    <div class="product-category">
                            <a href="https://localhost/farahtech/app/catalog?category=men-clothing"><?php echo e($item->category->name); ?></a>

                    </div>
                    <div class="rating-stars mb-4">
                        <h3 class="product-title"><a href="<?php echo e(route('front.product', $item->slug)); ?>">
                            <?php echo e($item->name); ?>

                        </a></h3>
                    </div>
                    
                    
                    <form action="<?php echo e(route('user.product.submit')); ?>" method="post" class="mt-10">
                        <?php echo csrf_field(); ?>
                        <label for="signup_product_<?php echo e($item->id); ?>" style="cursor: pointer"><input type="radio" name="signup_product[]" id="signup_product_<?php echo e($item->id); ?>" value="<?php echo e($item->id); ?>"> Select any one</label>
                        <?php $__errorArgs = ['signup_product'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-danger"><?php echo e($message); ?></p>
                        <?php endif; ?>
                  </div>
                </div>
              </div>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
<!-- Site Footer-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/user/auth/register/choose_product.blade.php ENDPATH**/ ?>
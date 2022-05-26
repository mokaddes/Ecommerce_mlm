

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

	<!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-0 bc-title"><b><?php echo e(__('Gallery Images')); ?></b> </h3>
                <a class="btn btn-primary   btn-sm" href="<?php echo e(url()->previous()); ?>"><i class="fas fa-chevron-left"></i> <?php echo e(__('Back')); ?></a>
                </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">

		<div class="col-xl-12 col-lg-12 col-md-12">

			<div class="card o-hidden border-0 shadow-lg">
				<div class="card-body ">
					<!-- Nested Row within Card Body -->
					<div class="row ">
						<div class="col-lg-12">
                                <form class="admin-form" action="<?php echo e(route('back.item.galleries.update')); ?>" method="POST"
                                    enctype="multipart/form-data">

                                    <?php echo csrf_field(); ?>

                                    <?php echo $__env->make('alerts.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <h5 class="">
                                        <b><?php echo e(__('Multiple Images Uploading Are Allowed')); ?></b>
                                    </h5>

                                    <br>

                                    <div class="d-block">

                                        <?php $__empty_1 = true; $__currentLoopData = $item->galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <div class="single-g-item d-inline-block m-2">
                                                    <span data-toggle="modal"
                                                    data-target="#confirm-delete" href="javascript:;"
                                                    data-href="<?php echo e(route('back.item.gallery.delete',$gallery->id)); ?>" class="remove-gallery-img">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <a class="popup-link" href="<?php echo e($gallery->photo ? asset('assets/images/'.$gallery->photo) : asset('assets/images/placeholder.png')); ?>">
                                                        <img class="admin-gallery-img" src="<?php echo e($gallery->photo ? asset('assets/images/'.$gallery->photo) : asset('assets/images/placeholder.png')); ?>"
                                                            alt="No Image Found">
                                                    </a>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                            <h6><b><?php echo e(__('No Images Added')); ?></b></h6>

                                        <?php endif; ?>

                                    </div>

                                    <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
                                    <div class="form-group position-relative ">
                                        <label class="file">
                                            <input type="file"  accept="image/*"  name="galleries[]" id="file"
                                                aria-label="File browser example" accept="image/*" multiple>
                                            <span class="file-custom text-left"><?php echo e(__('Upload Images...')); ?></span>
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-secondary "><?php echo e(__('Submit')); ?></button>
                                    </div>

                                    <div>
                                </form>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>





<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

		<!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Confirm Delete?')); ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
		</div>

		<!-- Modal Body -->
        <div class="modal-body">
			<?php echo e(__('You are going to delete this image from gallery.')); ?> <?php echo e(__('Do you want to delete it?')); ?>

		</div>

		<!-- Modal footer -->
        <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
			<form action="" class="d-inline btn-ok" method="POST">

                <?php echo csrf_field(); ?>

                <?php echo method_field('DELETE'); ?>

                <button type="submit" class="btn btn-danger"><?php echo e(__('Delete')); ?></button>

			</form>
		</div>

      </div>
    </div>
  </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('master.back', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/back/item/galleries.blade.php ENDPATH**/ ?>
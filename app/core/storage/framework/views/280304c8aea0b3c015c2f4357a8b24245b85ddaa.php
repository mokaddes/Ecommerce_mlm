
<?php $__env->startSection('title'); ?>
Referals
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
<script>new ClipboardJS('.btn');</script>
<style>
.copyboard {
border: none;
background: #0d6efd;
color: #fff;
max-width: 109px;
padding: 4px 7px;
border-radius: 4px;
display: inline-block;
vertical-align: middle;
outline: none !important;
box-shadow: none !important;
cursor: initial;
}
.copyboard_btn {
padding: 4px 16px;
text-transform: uppercase;
}
.refer_table .accordion-button{
    padding: 0;
    display: contents;
}

.refer_table .accordion-button {
    padding: 0;
    display: contents;
}
.refer_table .accordion-button::after {
    display: list-item;
    margin-top: 11px;
    list-style: none;
    margin-right: auto;
}
.refer_table .accordion-button:not(.collapsed) {
    color: #FF6A00;
    background-color: #FF6A00 !important;
}

.refer_table .refer_user_list td:last-child {
    border: none;
}
.table>tbody {
    vertical-align: inherit;
    border: 1px solid #EEE;
}
.table-bordered>:not(caption)>* {
    border-width: 1px 0;
    border: 1px solid #EEE;
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
                    <li><?php echo e(__('Referal Manage')); ?></li>
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
            <div class="card">
                <div class="card-body">
                    <div class="btn btn-primary" style="float: right">
                        <span>Referal ID:
                            <input class="copyboard" id="referalId" readonly value="<?php echo e(Auth::user()->own_referal); ?>">
                        </span>
                        <button class="copyboard_btn btn" data-clipboard-target="#referalId">Copy</button>
                    </div>
                    <div class="btn btn-primary">
                        <span>Refer User</span>
                    </div>
                </div>
                <div class="card-body refer_table">
                    <div class="u-table-res">
                        <table class="table responsive table-bordered" id="admin-table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('No')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Phone')); ?></th>
                                    <th><?php echo e(__('Own Referal')); ?></th>
                                    <th><?php echo e(__('Points')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="flush-headingOne">
                                            <?php if(isset(Auth::user()->own_referal)): ?>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne_<?php echo e($k); ?>" aria-expanded="false" aria-controls="flush-collapseOne_<?php echo e($k); ?>">
                                                        <td><?php echo e($k+1); ?></td>
                                                        <td>
                                                            <?php echo e($data->first_name); ?> <?php echo e($data->last_name); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($data->email); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($data->phone); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($data->own_referal); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($data->points); ?>

                                                        </td>
                                                    </tr>

                                                    <?php
                                                        $refers = DB::table('users')->whereNotNull('referal_id')->where('referal_id', $data->own_referal)->get();
                                                    ?>

                                                    <tr>
                                                        <?php $__currentLoopData = $refers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr id="flush-collapseOne_<?php echo e($k); ?>" class="accordion-collapse refer_user_list collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                                <td>
                                                                    <input type="checkbox" name="" id="" checked readonly>
                                                                </td>
                                                                <td>
                                                                    <?php echo e($item->first_name); ?> <?php echo e($item->last_name); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($item->email); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($item->phone); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($item->own_referal); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($item->points); ?>

                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\farahtech\app\core\resources\views/user/dashboard/referal_manage.blade.php ENDPATH**/ ?>
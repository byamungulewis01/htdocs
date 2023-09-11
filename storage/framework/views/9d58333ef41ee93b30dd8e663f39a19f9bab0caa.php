

<?php $__env->startSection('page_name'); ?>
Legal Education 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-5">
        <span class="text-muted fw-light">Legal Education /</span> Profile
    </h4>


    <?php echo $__env->make('profile.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
       
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-7 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-header">
                    <h5><?php echo e($name); ?>'s Trainings</h5>
                </div>
                <div class="card-body">
                    <div class="card-datatable table-responsive border-top">
                        <table class="datatables table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Trainings</th>
                                    <th>Descriptions</th>
                                </tr>
                            </thead>
                            <?php
                            $count = 1;
                            ?>
                            <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-label-danger me-2"><?php echo e($count); ?></span></td>
                                    <td><strong><?php echo e($booking->trains->title); ?></strong><br>
                                        <span class="badge bg-label-info me-2">Credit</span><?php echo e($booking->trains->credits); ?>

                                        <span class="badge bg-label-info me-2">Price</span><?php echo e($booking->trains->price); ?> Rwf
                                    </td>
                                    <td>
                                        <strong>Venue :</strong> <?php echo e($booking->trains->venue); ?><br>
                                        Start on <u class="text-primary"><?php echo e($booking->trains->starton); ?></u> |
                                        End on <u class="text-primary"><?php echo e($booking->trains->endon); ?></u>
                                    </td>

                                </tr>
                              
                            </tbody>
                            <?php
                            $count++
                            ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td></td>
                                <td>There is no Any Training Available now</td>
                            </tr>
                            <?php endif; ?>

                        </table>
                        <div class="col-lg-12"> 
                            
                            <?php echo e($bookings->links('vendor.pagination.custom')); ?>

                           
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-5 col-md-8 col-12 mb-md-0 mb-4">
            <?php echo $__env->make('profile.training.extra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    </div>

</div>
<!--/ User Profile Content -->

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/css/pages/page-profile.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/tagify/tagify.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.css')); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/vendor/libs/tagify/tagify.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/profile/training/training.blade.php ENDPATH**/ ?>
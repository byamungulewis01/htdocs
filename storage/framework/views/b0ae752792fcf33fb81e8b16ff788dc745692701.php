

<?php $__env->startSection('page_name'); ?>
Trainings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-7 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <div
                        class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">

                        <div>
                            <div class="card-header border-bottom">
                                <h5 class="card-title mb-0">Booked<span class="pull-left float-end"><span
                                            class="badge bg-label-info me-2">Training</span>
                                        <?php echo e($training->title); ?></span>
                                </h5>

                            </div>
                            <div class="row p-4">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 220px">Person</th>
                                                <th>Price</th>
                                                <th>Credit</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $count = 1;
                                        ?>

                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($count); ?></td>
                                                <td><?php echo e($booking->user->name); ?></td>
                                                <td><?php echo e($booking->trains->price); ?></td>
                                                <td><?php echo e($booking->trains->credits); ?></td>
                                                <td> <?php if($booking->booked): ?>
                                                    <span class="badge bg-label-info me-2">Booked</span>
                                                    <?php else: ?>
                                                    <span class="badge bg-label-warning me-2">Not booked</span>
                                                    <?php endif; ?> </td>
                                                <td>
                                                    <?php if (! ($booking->trains->price == 0.00)): ?>
                                                    <?php if(!$booking->confirm): ?>
                                                    <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#payee<?php echo e($booking->id); ?>"
                                                    class="text-info">payee</a>
                                                    <?php endif; ?>
                                                <div class="modal fade" id="payee<?php echo e($booking->id); ?>" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                                        <div class="modal-content p-3 p-md-5">
                                                            <div class="modal-body">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                                <div class="text-center mb-4">
                                                                    <h3 class="mb-2">Pay <span
                                                                            class="text-danger"><?php echo e($booking->trains->price); ?>

                                                                            Rwf </span> To be Enrolled in
                                                                        <span
                                                                            class="text-primary"><?php echo e($booking->trains->title); ?></span>
                                                                    </h3>
                                                                </div>
                                                                <form method="POST" class="row g-3"
                                                                    action="<?php echo e(route('paytraining')); ?>">

                                                                    <?php echo csrf_field(); ?>
                                                                    <?php echo method_field('PUT'); ?>
                                                                    <input type="hidden" name="id"
                                                                        value="<?php echo e($booking->id); ?>">
                                                                    <div
                                                                        class="col-12 d-flex justify-content-center">
                                                                        <button type="submit"
                                                                            class="btn btn-primary waves-effect waves-light">Make
                                                                            payment</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <?php endif; ?>
                                                
                                                </td>

                                            </tr>
                                            <?php
                                            $count++;
                                            ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td></td>
                                                <td colspan="4"><span class="text-warning">No data Found or Not yet
                                                        Book</span></td>

                                            </tr>
                                            <?php endif; ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
                <hr class="my-0" />


            </div>
        </div>
        <div class="col-xl-5 col-md-8 col-12 mb-md-0 mb-4">
            <?php echo $__env->make('training.extra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

</div>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/training/booked.blade.php ENDPATH**/ ?>
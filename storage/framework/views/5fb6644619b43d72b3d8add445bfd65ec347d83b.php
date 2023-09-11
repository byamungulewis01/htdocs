

<?php $__env->startSection('page_name'); ?>
Trainings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-8 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <div
                        class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">

                        <div>
                            <div class="card-header border-bottom">
                                <h5 class="card-title mb-0">Bulk Enrolment Management 
                                    
                                    <a href="<?php echo e(route('trainings.TrainingExport', $training->id)); ?>" class="btn btn-sm btn-primary float-end">Export</a>
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
                                                <th>Action</th>
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
                                                <td><?php echo e($booking->cumulatedCredit); ?></td>
                                                <td>
                                                    <?php switch($booking->status):
                                                        case (1): ?>
                                                             <span class="badge bg-label-primary me-2">Booking</span>
                                                            <?php break; ?>
                                                        <?php case (2): ?>
                                                             <span class="badge bg-label-secondary me-2">Confirm</span>
                                                            <?php break; ?>
                                                        <?php case (3): ?>
                                                             <span class="badge bg-label-warning me-2">Attending</span>
                                                            <?php break; ?>
                                                        <?php case (4): ?>
                                                            <span class="badge bg-label-info me-2">Attended</span>
                                                            <?php break; ?>
                                                        <?php default: ?>
                                                            <span class="badge bg-label-warning me-2">N/A</span>
                                                    <?php endswitch; ?>
                        
                                                </td>
                                                <td>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#edit<?php echo e($booking->id); ?>" class="text-primary"><i
                                                        class="ti ti-edit me-0 me-sm-1 ti-xs"></i></a>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#delete<?php echo e($booking->id); ?>" class="text-danger"><i
                                                        class="ti ti-trash me-0 me-sm-1 ti-xs"></i></a>
                                                    <div class="modal fade" id="edit<?php echo e($booking->id); ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                                            <div class="modal-content p-3 p-md-5">
                                                                <div class="modal-body">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    <div class="text-center mb-4">
                                                                        <h3 class="mb-2">Edit Bulk Enrolment</h3>
                                                                    </div>
                                                                    <form method="POST" class="row g-3" action="<?php echo e(route('trainings.EditBulk')); ?>">
                                                                        <?php echo csrf_field(); ?>
                                                                        <div class="col-12">
                                                                            <input type="hidden" name="id" value="<?php echo e($booking->id); ?>">
                                                                            <label for="users" class="form-label">Choose Participant</label>
                                                                            <select required name="user" class="form-select" id="users">
                                                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option <?php if( $user->id == $booking->advocate): ?> selected <?php endif; ?> value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label for="venue" class="form-label">Price</label>
                                                                            <input required type="number" name="price" id="price" value="<?php echo e($booking->trains->price); ?>" class="form-control">
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <label for="venue" class="form-label">Cumulated Credit</label>
                                                                            <input required type="number" name="credits" id="credit" value="<?php echo e($booking->trains->credits); ?>" class="form-control">
                                                                        </div>
                                                                      
                                                                        <div class="col-12">
                                                                            <label class="form-label">Status</label>
                                                                            <select required name="status" class="form-select">
                                                                                <option <?php if($booking->status == 1): ?> selected <?php endif; ?> value="1">Booked</option>
                                                                                <option <?php if($booking->status == 2): ?> selected <?php endif; ?> value="2">Confirmed</option>
                                                                                <option <?php if($booking->status == 3): ?> selected <?php endif; ?> value="3">Attending</option>
                                                                                <option <?php if($booking->status == 4): ?> selected <?php endif; ?> value="4">Attended</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 d-flex justify-content-center">
                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal modal-top fade" id="delete<?php echo e($booking->id); ?>" tabindex="-1"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-sm" role="document">
                                                            <div class="modal-content">
                                                                <form action="<?php echo e(route('trainings.DeleteBulk')); ?>" method="POST">
                                                                    <?php echo csrf_field(); ?>
                                                                    <?php echo method_field('DELETE'); ?>
                                                                    <input type="hidden" name="id" value="<?php echo e($booking->id); ?>" />
                                                                    <input type="hidden" name="user_id" value="<?php echo e($booking->user->id); ?>" />
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel2">Are you sure you want to
                                                                            delete?</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-label-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                    <div class="col-lg-4">
                                        <?php echo e($bookings->links('vendor.pagination.custom')); ?>

                                       
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
                <hr class="my-0" />

            </div>
        </div>
        <div class="col-xl-4 col-md-8 col-12 mb-md-0 mb-4">
            <?php echo $__env->make('training.extra', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

</div>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/sweetalert2/sweetalert2.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/vendor/libs/moment/moment.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/datatables/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/cleavejs/cleave.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/cleavejs/cleave-phone.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/sweetalert2/sweetalert2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/training/manage.blade.php ENDPATH**/ ?>
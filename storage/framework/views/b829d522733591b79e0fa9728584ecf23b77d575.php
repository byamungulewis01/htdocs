

<?php $__env->startSection('page_name'); ?>
Discipline Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Notify History</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">N<sup>0</sup> </th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Plaintiff</th>
                                <th scope="col">Defendant</th>
                                <th scope="col">Message</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            ?>
                            <?php $__currentLoopData = $notifyRecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notifyRecord): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($i++); ?></th>
                                <td><?php echo e($notifyRecord->created_at->format('d/m/Y')); ?></td>
                                <td><?php echo e($notifyRecord->created_at->format('H:i:s')); ?></td>
                                <td><?php echo e($notifyRecord->plaintiff_name); ?></td>
                                <td><?php echo e($notifyRecord->defandant_name); ?></td>
                                <td> <a data-bs-toggle="modal" data-bs-target="#moreInfo<?php echo e($notifyRecord->id); ?>" href="" class="text-muted">View Message</a>
                                    <div class="modal fade" id="moreInfo<?php echo e($notifyRecord->id); ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered1 modal-lg modal-simple modal-add-new-cc">
                                            <div class="modal-content p-3 p-md-5">
                                                <div class="modal-body">
                                                    <div class="row" style="font-size: 14px; overflow: auto; height: 500px;">
                                                        <div class="col-xl-12">

                                                            <?php echo $notifyRecord->message; ?>

                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>



    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bar\resources\views/cases/notifyHistory.blade.php ENDPATH**/ ?>
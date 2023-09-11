

<?php $__env->startSection('page_name'); ?>
Meeting info
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-2">
        <span class="text-muted fw-light">Meetings /</span> Profile
    </h4>


    <?php echo $__env->make('myprofile.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- User Profile Content -->
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Meeting</th>
                  <th>Date</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Venue</th>
                  <th>Credits</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <?php
                $count = 1;
                ?>
                <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      
                <tr>
                  <td><?php echo e($count); ?></td>
                  <td><?php echo e($meeting->meeting->title); ?>

      
                  </td>
                  <td><?php echo e(\Carbon\Carbon::parse($meeting->date)->locale('fr')->format('F j, Y')); ?></td>
                  <td>
                    <?php echo e($meeting->meeting->start); ?>

                  </td>
                  <td><?php echo e($meeting->meeting->end); ?></td>
                  <td><?php echo e($meeting->meeting->venue); ?></td>
                  <td>
                    <?php echo e($meeting->meeting->credits); ?>

                  </td>
                  <td>
                   <?php if($meeting->status == 1): ?>
                   
                    <?php if(!$meeting->booked): ?>
                      <?php if($meeting->bookDeadline < \Carbon\Carbon::now()->format('Y-m-d')): ?>
                      <span class="badge bg-label-danger me-2">Booking Closed</span>
                      <?php else: ?>
                      <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#book<?php echo e($meeting->id); ?>">Book</button>
                      <?php endif; ?>
                  

                    <div class="modal modal-top fade" id="book<?php echo e($meeting->id); ?>" tabindex="-1" aria-hidden="true">
                     <div class="modal-dialog modal-sm" role="document">
                       <div class="modal-content">
                         <form method="POST" action="<?php echo e(route('meeting_book')); ?>">
                           <?php echo csrf_field(); ?>
                           <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="meeting" value="<?php echo e($meeting->id); ?>" />
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel2">Are you sure to Book This? <span id="username"></span>?</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                             <button type="submit" class="btn btn-danger">Yes, delete</button>
                           </div>
                         </form>
                       </div>
                     </div>
                   </div> 
                    <?php else: ?>
                    <span class="badge bg-label-primary me-2">Booked</span>
                    <?php endif; ?>
                  
                   <?php else: ?>
                 <span class="badge bg-label-success me-2">Attended</span>
                   <?php endif; ?>
                  </td>
      
                </tr>
            
      
                <?php
                $count++
                ?>
      
                <div class="modal modal-top fade" id="delete<?php echo e($meeting->id); ?>" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <form action="<?php echo e(route('marital.delete')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <input type="hidden" name="meeting" value="<?php echo e($meeting->id); ?>" />
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel2">Are you sure to delete? <?php echo e($meeting->id); ?></h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-dark">Yes, Delete</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
      
              </tbody>
            </table>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/myprofile/meeting.blade.php ENDPATH**/ ?>
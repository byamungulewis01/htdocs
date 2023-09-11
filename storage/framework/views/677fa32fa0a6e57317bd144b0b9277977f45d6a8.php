

<?php $__env->startSection('page_name'); ?>
Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <!-- View sales -->
    <div class="col-xl-4 mb-4 col-lg-5 col-12">
      <div class="card h-50">
        <div class="d-flex align-items-end row">
          <div class="col-7">
            <div class="card-body text-nowrap">
              <h5 class="card-title mb-0">Welcome, <?php echo e(auth()->guard('admin')->user()->name); ?>!</h5>
              <p class="mb-2">Todays reminder</p>
              <h4 class="text-primary mb-1">0</h4>
              <a href="javascript:;" class="btn btn-primary">View Profile</a>
            </div>
          </div>
          <div class="col-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- View sales -->

    <!-- Statistics -->
    <div class="col-xl-4 mb-4 col-lg-7 col-12">
      <div class="card h-50">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h4>Total Users</h4>
            <?php
                $total_adv = $active_adv + $inactive_adv + $suspended_adv + $struckOff_adv + $deceased_adv;
                $total_intern = $active_intern + $inactive_intern + $suspended_intern + $struckOff_intern + $deceased_intern;
                $total = $total_adv + $total_intern;
            ?>
            <a href="<?php echo e(route('users.ind')); ?>" class="card-text text-success"><?php echo e($total); ?></a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            
            <div class="col-4">
              <a href="<?php echo e(route('users.advocates')); ?>">
              <div class="d-flex gap-2 align-items-center mb-2">
                <span class="badge bg-label-info p-1 rounded"><i class="ti ti-shopping-cart ti-xs"></i></span>
                <p class="mb-0">Advocates</p>
              </div>
              <h5 class="mb-0 pt-1 text-nowrap"><?php echo e($total_adv); ?></h5>
            </a>
            </div>
          
            <div class="col-4">
              <div class="divider divider-vertical">
                <div class="divider-text">
                  <span class="badge-divider-bg bg-label-secondary">+</span>
                </div>
              </div>
            </div>
            <div class="col-4 text-end">
              <a href="<?php echo e(route('users.interns')); ?>">
              <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                <p class="mb-0">Intern</p>
                <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-xs"></i></span>
              </div>
              <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0"><?php echo e($total_intern); ?></h5>
            </a>
            </div>
          </div>
          <div class="d-flex align-items-center mt-4">
            <div class="progress w-100" style="height: 8px;">
              <?php
                  $progress_adv = ($total_adv * 100) / $total;
                  $progress_intern = ($total_intern * 100) / $total;
              ?>
              <div class="progress-bar bg-info" style="width: <?php echo e($progress_adv); ?>%" role="progressbar" aria-valuenow="<?php echo e($progress_adv); ?>"
                aria-valuemin="0" aria-valuemax="100"></div>
              <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo e($progress_intern); ?>%" aria-valuenow="<?php echo e($progress_intern); ?>"
                aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Statistics -->
    <div class="col-xl-4 mb-4 col-lg-7 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="mb-4">Roll Summary</h5>
            <small class="badge bg-label-success">Advocates </small>
            <small class="badge bg-label-danger">Intern Advocates </small>
          </div>

        </div>
        <div class="card-body">
          <ul class="list-unstyled mb-0">
            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-success p-2 me-3 rounded"><i class="ti ti-user-check ti-sm"></i></div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Active</h6>
                  </div>
                  <div class="d-flex align-items-center">

                    <a href="users/1/2" class="badge bg-label-success"><?php echo e($active_adv); ?></a>
                    <a href="users/2/2" class="ms-3 badge bg-label-danger"><?php echo e($active_intern); ?></a>
                  </div>
                </div>
              </div>
            </li>
            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-primary p-2 me-3 rounded"><i class="ti ti-user-minus ti-sm"></i></div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Inactive</h6>
                  </div>
                  <div class="d-flex align-items-center">

                    <a href="users/1/3" class="badge bg-label-success"><?php echo e($inactive_adv); ?></a>
                    <a href="users/2/3" class="ms-3 badge bg-label-danger"><?php echo e($inactive_intern); ?></a>
                  </div>
                </div>
              </div>
            </li>
            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-warning p-2 me-3 rounded"><i class="ti ti-user-exclamation ti-sm"></i></div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Suspended</h6>
                  </div>
                  <div class="d-flex align-items-center">

                    <a href="users/1/4" class="badge bg-label-success"><?php echo e($suspended_adv); ?></a>
                    <a href="users/2/4" class="ms-3 badge bg-label-danger"><?php echo e($suspended_intern); ?></a>
                  </div>
                </div>
              </div>
            </li>

            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-secondary p-2 me-3 rounded"><i class="ti ti-user-x ti-sm"></i></div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Struck Off</h6>
                  </div>
                  <div class="d-flex align-items-center">

                    <a href="users/1/5" class="badge bg-label-success"><?php echo e($struckOff_adv); ?></a>
                    <a href="users/2/5" class="ms-3 badge bg-label-danger"><?php echo e($struckOff_intern); ?></a>
                  </div>
                </div>
              </div>
            </li>
            <li class="mb-3 pb-1">
              <div class="d-flex align-items-start">
                <div class="badge bg-label-danger p-2 me-3 rounded"><i class="ti ti-cross ti-sm"></i></div>
                <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Deceased</h6>
                  </div>
                  <div class="d-flex align-items-center">

                    <a href="users/1/6" class="badge bg-label-success"><?php echo e($deceased_adv); ?></a>
                    <a href="users/2/6" class="ms-3 badge bg-label-danger"><?php echo e($deceased_intern); ?></a>
                  </div>
                </div>
              </div>
            </li>


          </ul>
        </div>
      </div>
    </div>
    <!-- Statistics -->
  </div>
</div>
<!-- / Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bar\resources\views/dashboards/admin.blade.php ENDPATH**/ ?>
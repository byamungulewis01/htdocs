

<?php $__env->startSection('page_name'); ?>
Probono Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-7 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Probono Case Details
                        <a href="" data-bs-toggle="modal" data-bs-target="#development"
                            class="btn btn-success text-white pull-left float-end"><span
                                class="d-none d-sm-inline-block">Report case development</span></a>
                        <div class="modal fade" id="development" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h3 class="mb-2">New Devolopment</h3>
                                        </div>
                                        <form method="POST" class="row g-3" action="<?php echo e(route('probono.probono_dev')); ?>"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="col-12">
                                                <label class="form-label w-100" for="modalAddCard">New case
                                                    Status</label>
                                                <input type="hidden" name="probono" value="<?php echo e($probono->id); ?>">
                                                <div class="input-group input-group-merge">
                                                    <select required name="status" class="form-select">
                                                        <option <?php if(old('status')=="Pending" ): ?> selected <?php endif; ?> value="Pending"
                                                            selected>Pending</option>
                                                        <option <?php if(old('status')=="Appealed" ): ?> selected <?php endif; ?> value="Appealed">
                                                            Appealed
                                                        </option>
                                                        <option <?php if(old('status')=="Closed" ): ?> selected <?php endif; ?>
                                                            value="Closed">Closed
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="modalAddCardName">Event title</label>
                                                <input required type="text" value="<?php echo e(old('title')); ?>" name="title"
                                                    class="form-control" placeholder="Event title" />

                                            </div>
                                            <div class="col-12">
                                                <label for="exampleFormControlTextarea1" class="form-label">Event
                                                    Narration</label>
                                                <textarea id="basic-default-message" required name="narration"
                                                    class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label w-100" for="title">Attach File </label>
                                                <div class="input-group input-group-merge">
         

                                                    <input accept=".pdf,.doc,.docx,.xls,.xlsx" name="attach_file" class="form-control"
                                                        type="file" />

                                                </div>
                                            </div>

                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Add</button>
                                                <button type="reset" class="btn btn-label-secondary btn-reset"
                                                    data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </h5>
                    <div class="row mt-4">
                        <?php $__empty_1 = true; $__currentLoopData = $probono_devs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $probono_dev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-12 mb-2">
                            <div class="card">
                                <h6 class="card-header">
                                    <span class="badge bg-label-dark">Title:</span>
                                    <?php echo e($probono_dev->title); ?>

                                    <span class="badge bg-label-dark pull-left float-end">date: <span>
                                            <?php echo e(\Carbon\Carbon::parse($probono_dev->created_at )->locale('fr')->format('F j, Y')); ?></span></span>

                                </h6>
                                <div class="card-body bg-light" style="padding: 2%;">
                                    <p>
                                        <?php echo e($probono_dev->narration); ?>

                                    </p>
                                    <?php if (! ($probono_dev->attach_file == NULL)): ?>
                                    <p><strong>Attachement file : <a
                                                href="<?php echo e(route('Download-files',$probono_dev->attach_file)); ?>">Download</a></strong>
                                      

                                        <div class="modal fade" id="reaction" tabindex="-1" aria-hidden="true">
                                            <div
                                                class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                                <div class="modal-content p-3 p-md-5">
                                                    <div class="modal-body">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        <div class="text-center mb-4">
                                                            <h3 class="mb-2">Add Reaction on Report</h3>
                                                        </div>
                                                        <form method="POST" class="row g-3"
                                                            action="<?php echo e(route('probono_dev.reaction')); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <div class="col-12">
                                                                <input type="hidden" name="probono_dev"
                                                                    value="<?php echo e($probono_dev->id); ?>">
                                                                <textarea required name="reaction" class="form-control"
                                                                    id="exampleFormControlTextarea1" rows="3"></textarea>
                                                            </div>


                                                            <div class="col-12 text-center">
                                                                <button type="submit"
                                                                    class="btn btn-primary me-sm-3 me-1">Add</button>
                                                                <button type="reset"
                                                                    class="btn btn-label-secondary btn-reset"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </p>

                                    <?php endif; ?>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#reaction"
                                    class="btn btn-secondary btn-sm text-white pull-left float-end"><i
                                        class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                                        class="d-none d-sm-inline-block">Reaction</span></a>
                                    <p><span class="badge bg-label-light text-dark">Reported by</span>
                                            <?php echo e($probono_dev->reporter_name); ?></p>
                                </div>


                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <h6 class="card-header">
                            <span class="badge bg-label-dark">Message:</span>
                            No Event
                        </h6>

                        <?php endif; ?>
                    </div>

                </div>


            </div>
        </div>
        <div class="col-xl-5 col-lg-7 col-md-7">
            <div class="card mb-2">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Participant
                        <a class="btn btn-primary btn-sm text-white pull-left float-end" data-bs-toggle="modal"
                            data-bs-target="#partipant">
                            <i class="ti ti-plus me-0 me-sm-1 ti-xs"></i>
                            <span class="d-none d-sm-inline-block">New Participant</span></a>
                    </h5>
                    <div class="modal fade" id="partipant" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                            <div class="modal-content p-3 p-md-5">
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <div class="text-center mb-4">
                                        <h3 class="mb-2">Add Participant</h3>
                                        <p class="text-muted">Add new Probono Case Member for followup Every Days</p>
                                    </div>
                                    <form method="POST" class="row g-3" action="<?php echo e(route('probono.addmember')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="col-12">
                                            <label class="form-label w-100" for="modalAddCard">Name</label>

                                            <input type="hidden" name="probono_id" value="<?php echo e($probono->id); ?>">
                                            <select name="user_id" class="select2 form-select" data-allow-clear="true"
                                                required>
                                                <option value="" selected> - Select - </option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(old('user_id')==$user->id): ?> selected <?php endif; ?>
                                                    value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </select>

                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                            <button type="reset" class="btn btn-label-secondary btn-reset"
                                                data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Advocate</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">

                                <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($member->user->name); ?></td>
                                    <td>
                                      <?php if($key != 0): ?>
                                      <a href="javascript:" data-bs-toggle="modal"
                                      data-bs-target="#deleteStatus<?php echo e($member->id); ?>" class="text-danger"><i
                                          class="ti ti-trash"></i></a>

                                  <div class="modal modal-top fade" id="deleteStatus<?php echo e($member->id); ?>"
                                      tabindex="-1" aria-hidden="true">
                                      <div class="modal-dialog modal-md" role="document">
                                          <div class="modal-content">
                                              <form action="<?php echo e(route('probono.removemember')); ?>" method="POST">
                                                  <?php echo csrf_field(); ?>
                                                  <?php echo method_field('DELETE'); ?>
                                                  <input type="hidden" name="id" value="<?php echo e($member->id); ?>" />
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                  aria-label="Close"></button>
                                                  <div class="alert alert-warning">
                                                    <h5 class="alert-heading mb-2">Are you sure want to delete a member?</h5>
                                                    <span>Ensure that if you delete member also you will lose his/her Reports </span>
                                                    <br>
                                                    <button type="submit" class="btn btn-sm btn-danger">Yes,
                                                        Delete</button>
                                                  </div>
                                                    
                
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                                      <?php endif; ?>

                                    </td>

                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--/ Teams -->
            </div>
            <div class="card">
                <div class="card-body">
                    <h5>Probono Case Information

                    </h5>
                    
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>Case Number</td>
                                    <td><?php echo e($probono->referral_case_no); ?></td>
                                </tr>

                                <tr>
                                    <td>Created On</td>
                                    <td><?php echo e($probono->created_at); ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td> <?php switch($probono->status):
                                        case ('OPEN'): ?>
                                        <span class="badge bg-label-primary me-2"><?php echo e($probono->status); ?></span>
                                        <?php break; ?>
                                        <?php case ('WON'): ?>
                                        <span class="badge bg-label-success me-2"><?php echo e($probono->status); ?></span>
                                        <?php break; ?>
                                        <?php case ('LOST'): ?>
                                        <span class="badge bg-label-warning me-2"><?php echo e($probono->status); ?></span>
                                        <?php break; ?>
                                        <?php default: ?>
                                        <span class="badge bg-label-danger me-2"><?php echo e($probono->status); ?></span>
                                        <?php endswitch; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hearing day </td>
                                    <td><?php echo e($probono->hearing_date); ?></td>
                                </tr>
                                <tr>
                                    <td>Case Nature</td>
                                    <td><?php echo e($probono->case_nature); ?></td>
                                </tr>
                                <tr>
                                    <td>Jurisdiction</td>
                                    <td><?php echo e($probono->jurisdiction); ?></td>
                                </tr>
                                <tr>
                                    <td>Court</td>
                                    <td><?php echo e($probono->court); ?> </td>
                                </tr>
                                <tr>
                                    <td>LEGAL AIDS SEEKER</td>
                                    <td><strong><?php echo e($probono->fname); ?> <?php echo e($probono->lname); ?> </strong><br>
                                        <span class="badge bg-label-info me-2">Phone</span><?php echo e($probono->phone); ?></td>
                                </tr>
                                <tr>
                                    <td>REFERRER</td>
                                    <td><?php echo e($probono->referrel); ?></td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>


            </div>


        </div>
    </div>

</div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/select2/select2.css')); ?>" />

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- Vendors JS -->

<script src="<?php echo e(asset('assets/vendor/libs/select2/select2.js')); ?>"></script>
<!-- Page JS -->
<script src="<?php echo e(asset('assets/js/form-wizard-numbered.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/probono/devs.blade.php ENDPATH**/ ?>
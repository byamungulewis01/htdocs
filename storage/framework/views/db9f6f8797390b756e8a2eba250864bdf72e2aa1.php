

<?php $__env->startSection('page_name'); ?>
Disciplene info
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-2">
        <span class="text-muted fw-light">Probono case /</span> Profile
    </h4>


    <?php echo $__env->make('myprofile.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-7 col-lg-5 col-md-5">
            <div class="alert alert-info">
                <h5>Case : <?php echo e($probono->referral_case_no); ?> Status : <?php switch($probono->status):
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
                    <a href="" data-bs-toggle="modal" data-bs-target="#development"
                        class="btn btn-success text-white pull-left float-end"><span
                            class="d-none d-sm-inline-block">Report case development</span></a>
                </h5>
                <div class="modal fade" id="development" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                        <div class="modal-content p-3 p-md-5">
                            <div class="modal-body">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <div class="text-center mb-4">
                                    <h3 class="mb-2">New Devolopment</h3>
                                </div>
                                <form method="POST" class="row g-3" action="<?php echo e(route('probono_dev')); ?>"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="col-12">
                                        <label class="form-label w-100" for="modalAddCard">New case Status</label>
                                        <input type="hidden" name="probono" value="<?php echo e($probono->id); ?>">
                                        <div class="input-group input-group-merge">
                                            <select required name="status" class="form-select">
                                                <option <?php if(old('status')=="OPEN" ): ?> selected <?php endif; ?> value="OPEN"
                                                    selected>OPEN</option>
                                                <option <?php if(old('status')=="WON" ): ?> selected <?php endif; ?> value="WON">WON
                                                </option>
                                                <option <?php if(old('status')=="LOST" ): ?> selected <?php endif; ?> value="LOST">LOST
                                                </option>
                                                <option <?php if(old('status')=="TRANSACTED" ): ?> selected <?php endif; ?>
                                                    value="TRANSACTED">TRANSACTED</option>
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
                                        <textarea required name="narration" class="form-control"
                                            id="exampleFormControlTextarea1" rows="5"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label w-100" for="title">Attach File </label>
                                        <div class="input-group input-group-merge">
                                            <input accept=".pdf,.doc,.docx,.xls,.xlsx" name="attach_file" class="form-control" type="file" />

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
            </div>
            <div class="row">
                <?php $__currentLoopData = $probono_devs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $probono_dev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12 mb-2">
                    <div class="card">
                        <h6 class="card-header">
                            <span class="badge bg-label-dark">Title:</span>
                            <?php echo e($probono_dev->title); ?>

                            <span class="badge bg-label-dark pull-left float-end">date: <span>
                                    <?php echo e(\Carbon\Carbon::parse($probono_dev->created_at )->locale('fr')->format('F j, Y')); ?></span></span>

                        </h6>
                        <div class="card-body bg-light" style="padding: 2%">
                            <p>
                                <?php echo e($probono_dev->narration); ?>

                            </p>
                            <?php if (! ($probono_dev->attach_file == NULL)): ?>
                            <p><strong>Attachement file : <a
                                        href="<?php echo e(route('userDownload-files',$probono_dev->attach_file)); ?>">Download</a></strong>

            
                            </p>
                            <?php endif; ?>
                            <a href="" type="button" data-bs-toggle="modal" data-bs-target="#reaction"
                            class="btn btn-sm btn-label-secondary text-nowrap d-inline-block pull-left float-end">
                            Reaction
                            <span class="badge bg-danger text-white badge-notifications">
                                <?php if($probono_dev->reaction == NULL): ?>
                                    0
                                <?php else: ?>
                                    New
                                <?php endif; ?>
                            </span>
                          </a>
                          <div class="modal fade" id="reaction" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h3 class="mb-2">Reaction on Report</h3>
                                        </div>
                                     
                                            <div class="col-12">
                                                <p>
                                                    <?php echo e($probono_dev->reaction); ?> 
                                                </p>
                                            </div>
                                       
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p><span class="badge bg-label-light text-dark">Reported by</span>
                            <?php echo e($probono_dev->reporter_name); ?></p>
                        </div>


                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>

        </div>
        <div class="col-xl-5 col-lg-5 col-md-5">
            <div class="card card-action mb-4">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Probono Case Files</h5>

                </div>
                <div class="card-body">

                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                $count = 1;
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($count); ?></td>
                                    <td><?php echo e($file->case_title); ?></td>
                                    <td><?php echo e($file->case_type); ?></td>
                                    <td><a href="<?php echo e(route('userDownload-files',$file->case_file)); ?>">Download</a></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td>No file uploaded</td>
                                </tr>
                                <?php
                                $count++
                                ?>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!--/ Teams -->
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/myprofile/probono_delails.blade.php ENDPATH**/ ?>
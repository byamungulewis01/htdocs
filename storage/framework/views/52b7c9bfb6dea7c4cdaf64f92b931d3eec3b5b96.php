<div class="card invoice-preview-card mb-2">
    <div class="card-body">
        <h5>Trainings Archives </h5>
        <div class="card-datatable table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 3px;">#</th>
                        <th>Training</th>
                        <th>Attandance day</th>
                    </tr>
                </thead>
                <?php
                $count = 1;
                ?>
                <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tbody>
                    <tr>
                        <td><?php echo e($count); ?></td>
                        <td>
                            <?php
                        $title = Str::words($attendance->trains->title, 2, ' ...');
                        ?>
                            
                            <strong><?php echo e($title); ?></strong>
                        </td>
                        <td>
                            <?php echo e(\Carbon\Carbon::parse($attendance->attendanceDay)->locale('fr')->format('F j, Y')); ?>

                        </td>

                    </tr>

                </tbody>
                <?php
                $count++
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tbody>
                    <tr>
                        <td>

                        </td>
                        <td>
                            There is no Attandance list
                        </td>
                    </tr>
                </tbody>
                <?php endif; ?>

            </table>
            <div class="col-lg-4">
                <div class="demo-inline-spacing mr-2">
                    <a href="<?php echo e(route('user.training-archive',$user_id)); ?>" class="text-decoration-underline text-muted">View more</a>                   
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-2">
    <div class="card-body">
        <h5>Extra CLE
            <a class="btn btn-sm btn-dark text-white pull-left float-end" data-bs-toggle="modal"
                data-bs-target="#newExtra"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                    class="d-none d-sm-inline-block">New Extra CLE</span></a>

            <div class="modal fade" id="newExtra" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">New Extra CLE </h3>
                            </div>
                            <form method="POST" class="row g-3" action="<?php echo e(route('add.extraCle')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="user" value="<?php echo e($user_id); ?>">
                                <div class="col-12">
                                    <label class="form-label">Training Title</label>
                                    <input required type="text" name="title" class="form-control" placeholder="Title" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Training closing date</label>
                                    <input required type="date" name="closing_date" class="form-control" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Category</label>
                                    <select required name="category" class="form-select" id="">
                                        <option value="CLE">CLE</option>
                                        <option value="Publication">Publication</option>
                                        <option value="Legal Workshop">Legal Workshop</option>
                                        <option value="Meeting (Credit)">Meeting (Credit)</option>
                                        <option value="Lecture">Lecture</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Approved Hours</label>
                                    <input required type="number" min="0" name="hours" class="form-control"
                                        placeholder="Approved Hours" />
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </h5>
        <div class="card-datatable table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 3px;">#</th>
                        <th>Title (Category)</th>
                        <th>Hours</th>
                        <th>Credits</th>
                        <th></th>
                    </tr>
                </thead>
                <?php
                $count = 1;
                $hours = 0;
                $credits = 0;
                ?>
                <?php $__empty_1 = true; $__currentLoopData = $extraCles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extraCle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tbody>
                    <tr>
                        <td><?php echo e($count); ?></td>
                        <td><?php echo e($extraCle->title); ?>

                        <span class="text-muted">(<?php echo e($extraCle->category); ?>)</span>
                        
                        </td>
                        <td><?php echo e($extraCle->hours); ?></td>
                        <td><?php echo e($extraCle->credits); ?></td>
                        <td> <a href="" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#delete<?php echo e($extraCle->id); ?>"><i class='ti-xs ti ti-trash me-1'></i></a>
                            <div class="modal modal-top fade" id="delete<?php echo e($extraCle->id); ?>" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <form action="<?php echo e(route('remove.extraCle')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <input type="hidden" name="yearInBar" value="<?php echo e($extraCle->yearInBar); ?>">
                                            <input type="hidden" name="credits" value="<?php echo e($extraCle->credits); ?>">
                                            <input type="hidden" name="user" value="<?php echo e($user_id); ?>">
                                            <input type="hidden" name="id" value="<?php echo e($extraCle->id); ?>" />
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

                </tbody>

                <?php
                $hours += $extraCle->hours;
                $credits += $extraCle->credits;
                $count++
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td></td>
                    <td colspan="4">No Extra Continues Legal Education</td>
                </tr>
                <?php endif; ?>
                <tfoot>
                    <th colspan="2">Total</th>
                    <th><?php echo e($hours); ?></th>
                    <th><?php echo e($credits); ?></th>
                </tfoot>


            </table>
            
        </div>
        <div class="col-lg-4">
            <div class="demo-inline-spacing mr-2">
                <a href="<?php echo e(route('user.training-extra',$user_id)); ?>" class="text-decoration-underline text-muted">View more</a>                   
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\resources\views/profile/training/extra.blade.php ENDPATH**/ ?>
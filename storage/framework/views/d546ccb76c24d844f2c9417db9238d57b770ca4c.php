

<?php $__env->startSection('page_name'); ?>
CLE Complainces
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

  <div class="card">
    <div class="card-header">

      <table>
        <tr>
          <td>
            <form action="<?php echo e(route('Compliances')); ?>">
              <div class="input-group">
                <input name="year" type="text" required class="form-control" id="year" value="<?php echo e(date('Y-m-d')); ?>"
                  aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-primary waves-effect" type="submit" id="button-addon2">Update CLE
                  Compliances for the selected YEAR
                </button></div>
            </form>
          </td>
          <td>
            <button data-bs-toggle="modal" data-bs-target="#notify" class="btn btn-outline-dark waves-effect"
              type="button" id="button-addon2">Notify</button>
            <div class="modal fade" id="notify" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content p-3 p-md-5">
                  <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                      <h3 class="mb-2">Send Notification Messages</h3>
                      <?php if($errors->any()): ?>
                      <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                        <ul>
                          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li>* <?php echo e($error); ?></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                      </div>
                      <?php endif; ?>
                    </div>
                    <form method="POST" class="row g-3" action="<?php echo e(route('Compliances-notify')); ?>"
                      enctype="multipart/form-data">
                      <?php echo csrf_field(); ?>
                      <div class="col-5">
                        <label class="switch">
                          <span class="switch-label">Compliance year:</span>
                        </label>
                        <input required type="text" name="date" class="form-control" id="date"
                          value="<?php echo e(date('Y-m-d')); ?>">
                      </div>
                      <div class="col-7">
                        <label class="switch">
                          <span class="switch-label">Credits (as selection criteria):</span>
                        </label>
                        <div class="input-group input-daterange" id="bs-datepicker-daterange">
                          <input required name="from" min="1" type="number" id="dateRangePicker" placeholder="From"
                            class="form-control">
                          <span class="input-group-text">to</span>
                          <input required name="to" type="number" placeholder="To" class="form-control">
                        </div>

                      </div>
                      <div class="col-12">
                        <label class="switch">
                          <span class="switch-label">Recepients:</span>
                        </label>
                      </div>
                      <div class="col-md mb-md-0 mb-2">
                        <div class="form-check custom-option custom-option-basic checked">
                          <label class="form-check-label custom-option-content" for="published3">
                            <input name="recipients[]" class="form-check-input" type="checkbox" checked="" value="1"
                              id="published3">
                            <span class="custom-option-header" id="published3">
                              <span class="h6 mb-0">Advocates</span>
                              <span class="text-muted"></span>
                            </span>

                          </label>
                        </div>
                      </div>
                      <div class="col-md">
                        <div class="form-check custom-option custom-option-basic">
                          <label class="form-check-label custom-option-content" for="published4">
                            <input name="recipients[]" class="form-check-input" type="checkbox" value="2"
                              id="published4">
                            <span class="custom-option-header" id="published4">
                              <span class="h6 mb-0">Inter Advocates</span>
                              <span class="text-muted"></span>
                            </span>

                          </label>
                        </div>
                      </div>

                      <div class="col-12">
                        <label class="switch">
                          <span class="switch-label">Subject <span class="text-danger">include in Email
                              only</span></span>
                        </label>
                        <input required type="text" name="subject" class="form-control" id="subject" value="">

                      </div>
                      <div class="col-12">
                        <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                        <textarea required name="message" class="form-control" id="exampleFormControlTextarea1"
                          rows="3">
                              </textarea>
                      </div>

                      <div class="col-12">
                        <label class="switch mb-2">
                          <span class="switch-label text-warning">Attache files (5 Max):</span>
                        </label>

                        <input type="file" name="attachments[]" class="form-control" placeholder="Files" multiple
                          max="5">
                      </div>


                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" name="sent[]" type="checkbox" value="SMS"
                            id="defaultCheck3" />
                          <label class="form-check-label" for="defaultCheck3">SMS (Uncheck if "NO")
                          </label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" checked name="sent[]" type="checkbox" value="EMAIL"
                            id="defaultCheck4" />
                          <label class="form-check-label" for="defaultCheck4">EMAIL (Uncheck if "NO")
                          </label>
                        </div>
                      </div>

                      <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                          aria-label="Close">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
      </table>
    </div>
    <div class="card-datatable table-responsive">
      <table class="table border-top" id="datatables-users">
        <thead>
          <tr>
            <th>Names</th>
            <th>Admission Date</th>
            <th>Roll Number</th>
            <th>Admission Status</th>
            <th>Roll Status</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Cle Credits</th>
            <th>Meeting Credits</th>
            <th>Extra Credits</th>
            <th>Total Credits</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>


</div>
<!-- / Content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/select2/select2.css')); ?>" />
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
<script src="<?php echo e(asset('assets/vendor/libs/select2/select2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/cleavejs/cleave.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/cleavejs/cleave-phone.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/sweetalert2/sweetalert2.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/libs/flatpickr/flatpickr.js')); ?>"></script>
<script>
  $(document).ready(function () {
    var dtt = document.querySelector("#year");
    dtt && dtt.flatpickr({
      altInput: !0,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d"
    });
    var dte = document.querySelector("#date");
    dte && dte.flatpickr({
      altInput: !0,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d"
    });

    $('#datatables-users').DataTable({

      ajax: "<?php echo e(env('APP_URL')); ?>/api/users/compliances?year=<?php echo e($currentDate); ?>",
      columns: [
        {  data: 'name' },{  data: 'date' },{  data: 'regNumber' },{  data: 'status' },{  data: 'practicing' },{  data: 'email' },{  data: 'phone' },{  data: 'bookings_credit' },{  data: 'invitation_credit' },{  data: 'extra_cles_credit' },{  data: 'total_credits' },
      ],  
      order: [],
    
      dom: '<"row me-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      language: {
        sLengthMenu: "_MENU_",
        search: "",
        searchPlaceholder: "Search.."
      },
      buttons: [{
          extend: "collection",
          className: "btn btn-label-secondary dropdown-toggle mx-3",
          text: '<i class="ti ti-screen-share me-1 ti-xs"></i>Export',
          buttons: [{
              extend: "print",
              text: '<i class="ti ti-printer me-2" ></i>Print',
              className: "dropdown-item",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9 , 10],
                format: {
                  body: function (e, t, a) {
                    var s;
                    return e.length <= 0 ? e : (e = $.parseHTML(e), s =
                      "", $.each(e, function (e, t) {
                        void 0 !== t.classList && t
                          .classList.contains(
                            "user-name") ? s += t.lastChild
                          .firstChild.textContent :
                          void 0 === t.innerText ? s += t
                          .textContent : s += t.innerText
                      }), s)
                  }
                }
              },
              customize: function (e) {
                $(e.document.body).css("color", s)
                  .css("border-color", t)
                  .css("background-color", a),
                  $(e.document.body).find("table").addClass("compact")
                  .css("color", "inherit")
                  .css("border-color", "inherit")
                  .css("background-color", "inherit")
              }
            },
            {
              extend: "csv",
              text: '<i class="ti ti-file-text me-2" ></i>Csv',
              className: "dropdown-item",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ,10],
                format: {
                  body: function (e, t, a) {
                    var s;
                    return e.length <= 0 ? e : (e = $.parseHTML(e), s =
                      "",
                      $.each(e, function (e, t) {
                        void 0 !== t.classList && t
                          .classList.contains(
                            "user-name") ? s += t.lastChild
                          .firstChild.textContent :
                          void 0 === t.innerText ? s += t
                          .textContent : s += t.innerText
                      }), s)
                  }
                }
              }
            },
            {
              extend: "excel",
              text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
              className: "dropdown-item",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ,10],
                format: {
                  body: function (e, t, a) {
                    var s;
                    return e.length <= 0 ? e : (e = $.parseHTML(e),
                      s = "",
                      $.each(e, function (e, t) {
                        void 0 !== t.classList && t
                          .classList.contains(
                            "user-name") ? s += t.lastChild
                          .firstChild.textContent :
                          void 0 === t.innerText ? s += t
                          .textContent : s += t.innerText
                      }), s)
                  }
                }
              }
            },
            {
              extend: "pdf",
              text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
              className: "dropdown-item",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ,10],
                format: {
                  body: function (e, t, a) {
                    var s;
                    return e.length <= 0 ? e : (e = $.parseHTML(e),
                      s = "",
                      $.each(e, function (e, t) {
                        void 0 !== t.classList && t
                          .classList.contains(
                            "user-name") ? s += t.lastChild
                          .firstChild.textContent :
                          void 0 === t.innerText ? s += t
                          .textContent : s += t.innerText
                      }), s)
                  }
                }
              }
            },
            {
              extend: "copy",
              text: '<i class="ti ti-copy me-2" ></i>Copy',
              className: "dropdown-item",
              exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ,10],
                format: {
                  body: function (e, t, a) {
                    var s;
                    return e.length <= 0 ? e : (e = $.parseHTML(e),
                      s = "",
                      $.each(e, function (e, t) {
                        void 0 !== t.classList && t.classList.contains(
                            "user-name") ? s += t.lastChild
                          .firstChild.textContent :
                          void 0 === t.innerText ? s += t
                          .textContent : s += t.innerText
                      }), s)
                  }
                }
              }
            }
          ]
        },

      ],

    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/users/compliance.blade.php ENDPATH**/ ?>
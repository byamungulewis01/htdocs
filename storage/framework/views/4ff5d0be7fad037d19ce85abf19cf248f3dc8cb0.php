

<?php $__env->startSection('page_name'); ?>
Export Ceses
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
<!-- Content -->
        
<div class="container-xxl flex-grow-1 container-p-y">
        
            <div class="card">
                <div class="card-header">
                    <h4 class="card-header-title">Export Cases 
                        <span class="float-end">
                            <form action="<?php echo e(route('probono.report')); ?>">
                            <div class="input-group input-daterange" id="bs-datepicker-daterange">
                                <input required name="from" id="startdate" type="text" value="<?php echo e($from); ?>" class="form-control">
                                <span class="input-group-text">to</span>
                                <input required name="to" id="enddate" type="text" value="<?php echo e($to); ?>"  class="form-control">
                            <button class="btn btn-outline-primary waves-effect" type="submit" id="button-addon2">Search    
                            </button></div>
                            </form>
                        </span>
                    </h4>
                </div>
             
              <div class="card-datatable table-responsive">
                <table class="table border-top" id="datatables">
                  <thead>
                    <tr>
                      <th>Referral Names</th>
                      <th>Referral Gender</th>
                      <th>Age</th>
                      <th>Referral Phone</th>
                      <th>Jurisdiction</th>
                      <th>Court</th>
                      <th>Case Number</th>
                      <th>Case Nature</th>
                      <th>Hearing Day</th>
                      <th>Referrer</th>
                      <th>Category</th>
                      <th>Advocate</th>
                      <th>Decision</th>
                      <th>Comments</th>
                      <th>Created On</th>
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
        var dtt=document.querySelector("#startdate");
    dtt&&dtt.flatpickr({altInput:!0,altFormat:"F j, Y",dateFormat:"Y-m-d"});
        var dte=document.querySelector("#enddate");
    dte&&dte.flatpickr({altInput:!0,altFormat:"F j, Y",dateFormat:"Y-m-d"});
  
        $('#datatables').DataTable({
            
            ajax: '/api/probono?from=<?php echo e($from); ?>&to=<?php echo e($to); ?>',
            columns: [
                { data: '' },
                { data: 'gender' },
                { data: 'age' },
                { data: 'phone' },
                { data: 'jurisdiction' },
                { data: 'court' },
                { data: 'referral_case_no' },
                { data: 'case_nature' },
                { data: 'hearing_date' },
                { data: 'referrel' },
                { data: 'category' },
                { data: 'reporter_name' },
                { data: 'status' },
                { data: 'narration' },
                { data: 'created_at' },
            ],
            columnDefs:[      
                {
                    target:0,
                    render:function(_,_,a,i){
                        return a.fname+' '+a.lname;
                    },
                },
                
                {
                    target:12,
                    render:function(_,_,a,i){
                        if(a.status=='OPEN'){
                            return 'PENDING';
                        }else if(a.status=='LOST'){
                            return 'CLOSED';
                        }else if(a.status=='WON'){
                            return 'WON';
                        }else if(a.status=='TRANSACTED'){
                            return 'CLOSED';
                        }else{
                            return 'APPEALED';
                        }
                        
                    },
                },
                
                     
            ],
            order:[
                [2,"desc"]
            ],
            dom:'<"row me-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language:{
                sLengthMenu:"_MENU_",
                search:"",
                searchPlaceholder:"Search.."
            },
            buttons:[
                {
                    extend:"collection",
                    className:"btn btn-label-secondary dropdown-toggle mx-3",
                    text:'<i class="ti ti-screen-share me-1 ti-xs"></i>Export',
                    buttons:[
                        {
                            extend:"print",
                            text:'<i class="ti ti-printer me-2" ></i>Print',
                            className:"dropdown-item",
                            exportOptions:{
                                columns:[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],
                                format:{
                                    body:function(e,t,a){
                                        var s;
                                        return e.length<=0?e:(e=$.parseHTML(e),s="",$.each(e,function(e,t){
                                            void 0!==t.classList&&t.classList.contains("user-name")?s+=t.lastChild.firstChild.textContent:void 0===t.innerText?s+=t.textContent:s+=t.innerText
                                        }),s)
                                    }
                                }
                            },
                            customize:function(e){
                                $(e.document.body).css("color",s)
                                .css("border-color",t)
                                .css("background-color",a),
                                $(e.document.body).find("table").addClass("compact")
                                .css("color","inherit")
                                .css("border-color","inherit")
                                .css("background-color","inherit")
                            }
                        },
                        {
                            extend:"csv",
                            text:'<i class="ti ti-file-text me-2" ></i>Csv',
                            className:"dropdown-item",
                            exportOptions:{
                                columns:[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],
                                format:{
                                    body:function(e,t,a){
                                        var s;
                                        return e.length<=0?e:(e=$.parseHTML(e),s="",
                                        $.each(e,function(e,t){
                                            void 0!==t.classList&&t.classList.contains("user-name")?s+=t.lastChild.firstChild.textContent:void 0===t.innerText?s+=t.textContent:s+=t.innerText
                                        }),s)
                                    }
                                }
                            }
                        },
                        {
                            extend:"excel",
                            text:'<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                            className:"dropdown-item",
                            exportOptions:{
                                columns:[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],
                                format:{
                                    body:function(e,t,a){
                                        var s;
                                        return e.length<=0?e:(e=$.parseHTML(e),
                                        s="",
                                        $.each(e,function(e,t){
                                            void 0!==t.classList&&t.classList.contains("user-name")?s+=t.lastChild.firstChild.textContent:void 0===t.innerText?s+=t.textContent:s+=t.innerText
                                        }),s)
                                    }
                                }
                            }
                        },
                        {
                            extend:"pdf",
                            text:'<i class="ti ti-file-code-2 me-2"></i>Pdf',
                            className:"dropdown-item",
                            exportOptions:{
                                columns:[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],

                                format:{
                                    body:function(e,t,a){
                                        var s;
                                        return e.length<=0?e:(e=$.parseHTML(e),
                                        s="",
                                        $.each(e,function(e,t){
                                            void 0!==t.classList&&t.classList.contains("user-name")?s+=t.lastChild.firstChild.textContent:void 0===t.innerText?s+=t.textContent:s+=t.innerText}),s)
                                        }
                                    }
                                }
                            },
                            {
                                extend:"copy",
                                text:'<i class="ti ti-copy me-2" ></i>Copy',
                                className:"dropdown-item",
                                exportOptions:{
                                    columns:[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14],
                                    format:{
                                        body:function(e,t,a){
                                            var s;
                                            return e.length<=0?e:(e=$.parseHTML(e),
                                            s="",
                                            $.each(e,function(e,t){
                                                void 0!==t.classList&&t.classList.contains("user-name")?s+=t.lastChild.firstChild.textContent:void 0===t.innerText?s+=t.textContent:s+=t.innerText
                                            }),s)
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/probono/export-data.blade.php ENDPATH**/ ?>
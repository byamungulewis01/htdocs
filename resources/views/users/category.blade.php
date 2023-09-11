@extends('layouts.app')

@section('page_name')
User Category
@endsection

@section('contents')
<!-- Content -->
        
<div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
              <div class="card-header border-bottom">
                <h5 class="card-title mb-0">
                  @if ($status_adv == 1)
                  @switch($practicing_adv)
                  @case(2)
                      ACTIVE ADCVATES
                      @break
                  @case(3)
                      INACTIVE ADVOCATES
                      @break
                  @case(4)
                      SUSPENDED ADVOCATES
                      @break
                  @case(5)
                      STRUCK OFF ADVOCATES
                      @break
                  @case(6)
                      DECEASED ADVOCATES
                      @break
                  @default
                      
              @endswitch
                  @else
                  @switch($practicing_adv)
                  @case(2)
                      ACTIVE INTERNS
                      @break
                  @case(3)
                      INACTIVE INTERNS
                      @break
                  @case(4)
                      SUSPENDED INTERNS
                      @break
                  @case(5)
                      STRUCK OFF INTERNS
                      @break
                  @case(6)
                      DECEASED INTERNS
                      @break
                  @default
                      
              @endswitch
                  @endif
                </h5>
                
              </div>
              <div class="card-datatable table-responsive">
                <table class="datatables-users table border-top">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Roll Number</th>
                      <th>Phone</th>
                      <th>District</th>
                      <th>Gender</th>
                      <th>Status</th>
                      <th>Admission Date</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <!-- Edit User Modal -->
            <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                  <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                      <h3 class="mb-2">Update User Information</h3>
                      @if($errors->any())
                      <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                        <ul>
                        @foreach ($errors->all() as $error)
                          <li>* {{ $error }}</li>
                        @endforeach
                        </ul>
                      </div>
                        @endif
                    </div>
                    <form id="editUserForm" class="row g-3 needs-validation @if($errors->any()) validated @endif" novalidate="" method="post"  enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <input type="hidden" id="is" name="express" value="{{ old('express') }}"/>
                      <div class="col-12 col-md-6">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img src="{{ asset('assets/img/avatars/placeholder.jpg') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="updatedAvatar" />
                          <div class="button-wrapper">
                            <label for="updateAvatar" class="btn btn-sm btn-primary me-2 mb-3" tabindex="0">
                              <i class="ti ti-upload"></i>
                              <input type="file" id="updateAvatar" name="profile" class="user-avatar-updated" hidden accept="image/png, image/jpeg" />
                            </label>
                            <button type="button" class="btn btn-sm btn-label-secondary updated-avatar-reset mb-3 waves-effect">
                              <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Reset</span>
                            </button>
                            <div class="text-muted">Profile Picture</div>
                            <div class="text-muted d-none">Allowed JPG, GIF or PNG. Max size of 800K</div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img src="{{ asset('assets/img/avatars/diploma.jpg') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="updatedDiploma" />
                          <div class="button-wrapper">
                            <label for="updateDiploma" class="btn btn-sm  btn-primary me-2 mb-3" tabindex="0">
                              <i class="ti ti-upload"></i>
                              <input type="file" id="updateDiploma" name="diploma" class="user-diploma-updated" hidden accept="image/png, image/jpeg" />
                            </label>
                            <button type="button" class="btn btn-sm btn-label-secondary updated-diploma-reset mb-3 waves-effect">
                              <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Reset</span>
                            </button>
                            <div class="text-muted">Diploma</div>
                            <div class="text-muted d-none">Allowed JPG, GIF or PNG. Max size of 800K</div>
                          </div>
                        </div> 
                      </div>

                      <div class="col-12 col-md-6">
                        <label class="form-label" for="updateName">Full Name</label>
                        <input type="text" id="updateName" name="name" class="form-control" placeholder="John" value="{{ old('name') }}"/>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="updateEmail">Email</label>
                        <input type="text" id="updateEmail" name="email" class="form-control" placeholder="example@domain.com"  value="{{ old('email') }}"/>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="updatePhone">Phone Number</label>
                        <div class="input-group">
                          <span class="input-group-text">RW (+250)</span>
                          <input type="text" id="updatePhone" name="phone" class="form-control phone-number-mask" maxLength="10" placeholder="xxx xxx xxxx"  value="{{ old('phone') }}"/>
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="updateGender">Gender</label>
                        <select id="updateGender" name="gender" class="form-select">
                          <option value="" selected> - Select - </option>
                          <option @if(old('gender')=="Male") selected @endif value="Male">Male</option>
                          <option @if(old('gender')=="Male") selected @endif value="Female">Female</option>
                        </select>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="updateMarital">Martial Status</label>
                        <select id="updateMarital" name="marital" class="form-select">
                          <option value="">Select</option>
                          @foreach($marital as $status)
                          <option @if(old('marital')==$status->id) selected @endif value="{{ $status->id }}">{{ $status->title }}</option>
                          @endforeach
                        </select>
                     
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="updateDistrict">District</label>
                        <select id="updateDistrict" name="district" class="select2 form-select" data-allow-clear="true">
                          <option value="">Select</option>
                          <option value="Bugesera" @if(old('district')=="Bugesera") selected @endif>Bugesera</option>
                          <option value="Burera" @if(old('district')=="Burera") selected @endif>Burera</option>
                          <option value="Gakenke" @if(old('district')=="Gakenke") selected @endif>Gakenke</option>
                          <option value="Gasabo" @if(old('district')=="Gasabo") selected @endif>Gasabo</option>
                          <option value="Gatsibo" @if(old('district')=="Gatsibo") selected @endif>Gatsibo</option>
                          <option value="Gicumbi" @if(old('district')=="Gicumbi") selected @endif>Gicumbi</option>
                          <option value="Gisagara" @if(old('district')=="Gisagara") selected @endif>Gisagara</option>
                          <option value="Huye" @if(old('district')=="Huye") selected @endif>Huye</option>
                          <option value="Kamonyi" @if(old('district')=="Kamonyi") selected @endif>Kamonyi</option>
                          <option value="Karongi" @if(old('district')=="Karongi") selected @endif>Karongi</option>
                          <option value="Kayonza" @if(old('district')=="Kayonza") selected @endif>Kayonza</option>
                          <option value="Kicukiro" @if(old('district')=="Kicukiro") selected @endif>Kicukiro</option>
                          <option value="Kirehe" @if(old('district')=="Kirehe") selected @endif>Kirehe</option>
                          <option value="Muhanga" @if(old('district')=="Muhanga") selected @endif>Muhanga</option>
                          <option value="Musanze" @if(old('district')=="Musanze") selected @endif>Musanze</option>
                          <option value="Ngoma" @if(old('district')=="Ngoma") selected @endif>Ngoma</option>
                          <option value="Ngororero" @if(old('district')=="Ngororero") selected @endif>Ngororero</option>
                          <option value="Nyabihu" @if(old('district')=="Nyabihu") selected @endif>Nyabihu</option>
                          <option value="Nyagatare" @if(old('district')=="Nyagatare") selected @endif>Nyagatare</option>
                          <option value="Nyamagabe" @if(old('district')=="Nyamagabe") selected @endif>Nyamagabe</option>
                          <option value="Nyamasheke" @if(old('district')=="Nyamasheke") selected @endif>Nyamasheke</option>
                          <option value="Nyanza" @if(old('district')=="Nyanza") selected @endif>Nyanza</option>
                          <option value="Nyarugenge" @if(old('district')=="Nyarugenge") selected @endif>Nyarugenge</option>
                          <option value="Nyaruguru" @if(old('district')=="Nyaruguru") selected @endif>Nyaruguru</option>
                          <option value="Rubavu" @if(old('district')=="Rubavu") selected @endif>Rubavu</option>
                          <option value="Ruhango" @if(old('district')=="Ruhango") selected @endif>Ruhango</option>
                          <option value="Rulindo" @if(old('district')=="Rulindo") selected @endif>Rulindo</option>
                          <option value="Rusizi" @if(old('district')=="Rusizi") selected @endif>Rusizi</option>
                          <option value="Rutsiro" @if(old('district')=="Rutsiro") selected @endif>Rutsiro</option>
                          <option value="Rwamagana" @if(old('district')=="Rwamagana") selected @endif>Rwamagana</option>
                        </select>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="updateStatus">Administration Status</label>
                        <select id="updateStatus" name="category" class="form-select">
                          <option value="" selected> - Select - </option>
                          <option @if(old('category')=="Advocate") selected @endif value="Advocate">Advocate</option>
                          <option @if(old('category')=="Staff") selected @endif value="Staff">Staff</option>
                        </select>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="flatpickr-date-up">Admission Date</label>
                        <input type="text" id="flatpickr-date-up" name="date" value="{{ old('date') }}" placeholder="Month DD, YYYY" class="form-control" />
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="updateCategory">Admission Status</label>
                        <select id="updateCategory" name="status" class="form-select">
                          <option value="" selected> - Select - </option>
                          <option @if(old('status')=="1") selected @endif value="1">Advocate</option>
                          <option @if(old('status')=="2") selected @endif value="2">Intern Advocate</option>
                          <option @if(old('status')=="3") selected @endif value="3">Support Staff</option>
                          <option @if(old('status')=="4") selected @endif value="4">Technical Staff</option>
                        </select>
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label" for="updatePracticing">Practicing</label>
                        <select id="updatePracticing" name="practicing" class="form-select">
                          <option value="" selected> - Select - </option>
                          <option @if(old('practicing')=="2") selected @endif value="2">Active</option>
                          <option @if(old('practicing')=="3") selected @endif value="3">Inactive</option>
                          <option @if(old('practicing')=="4") selected @endif value="4">Suspended</option>
                          <option @if(old('practicing')=="5") selected @endif value="5">Struck Off</option>
                        </select>
                      </div>
                      <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Edit User Modal -->

 </div>
                      <!-- / Content -->
            
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('js')
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

<script>

"use strict";

$(function(){
    var dtt=document.querySelector("#flatpickr-date"),dtu=document.querySelector("#flatpickr-date-up");
    dtt&&dtt.flatpickr({altInput:!0,altFormat:"F j, Y",dateFormat:"Y-m-d", maxDate: 'today'}),
    dtu&dtu.flatpickr({altInput:!0,altFormat:"F j, Y",dateFormat:"Y-m-d", maxDate: 'today'})
    let t,a,s;
    s=(isDarkStyle?(t=config.colors_dark.borderColor,a=config.colors_dark.bodyBg,config.colors_dark):(t=config.colors.borderColor,a=config.colors.bodyBg,config.colors)).headingColor;
    var e,n=$(".datatables-users"),i=$(".select3"),r="/profile/",o={
        1:{
            title:"n/a",
            class:"bg-label-info"
        },
        2:{
            title:"Active",
            class:"bg-label-success"
        },
        3:{
            title:"Inactive",
            class:"bg-label-primary"
        },
        4:{
            title:"Suspended",
            class:"bg-label-warning"
        },
        5:{
            title:"Struck Off",
            class:"bg-label-danger"
        },
        6:{
            title:"Deceased",
            class:"bg-label-secondary"
        }
    };
    i.length&&(i=i).wrap('<div class="position-relative"></div>').select2({
        placeholder:"Select District",
        dropdownParent:i.parent()
    }),
    n.length&&(e=n.DataTable({
        ajax:"{{ env('APP_URL') }}/api/users/categoryApi?status={{ $status_adv }}&practicing={{ $practicing_adv }}",
        columns:[
            {data:"name"},
            {data:"email"},
            {data:"regNumber"},
            {data:"phone"},
            {data:"district"},
            {data:"gender"},
            {data:"practicing"},
            {data:"date"}
        ],
        columnDefs:[
          
      
          {
              targets:3,
              render:function(e,t,a,s){
                  a=a.phone;
                  return'<span class="fw-semibold">'+a[0].phone+"</span>"
                  }
              },
              {
                  targets:4,
                  render:function(e,t,a,s){
                      return'<span class="fw-semibold">'+a.district+"</span>"
                  }
              },
              {
                  targets:6,
                  render:function(e,t,a,s){
                      a=a.practicing;
                      return'<span class="badge '+o[a].class+'" text-capitalized>'+o[a].title+"</span>"
                  }
              },
              {
                  targets:7,
                  render:function(e,t,a,s){
                    var d = new Date(a.date);
                    var date = d.toLocaleDateString();
                      return'<span class="fw-semibold">'+date+"</span>"
                  }
              }
               
          ],
        order:[],
            dom:'<"row me-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',

            buttons:[
                {
                    extend:"collection",
                    className:"btn btn-outline-secondary dropdown-toggle me-2",
                    text:'<i class="fas fa-download"></i> Export',
                    buttons:[
                        {
                            extend:"print",
                            className:"dropdown-item",
                            text:'<i class="fas fa-print"></i> Print',
                            exportOptions:{
                                columns:[0,1,2,3,4,5,6,7]
                            }
                        },
                        {
                            extend:"csv",
                            className:"dropdown-item",
                            text:'<i class="fas fa-file-csv"></i> CSV',
                            exportOptions:{
                                columns:[0,1,2,3,4,5,6,7]
                            }
                        },
                        {
                            extend:"excel",
                            className:"dropdown-item",
                            text:'<i class="fas fa-file-excel"></i> Excel',
                            exportOptions:{
                                columns:[0,1,2,3,4,5,6,7]
                            }
                        },
                        {
                            extend:"pdf",
                            className:"dropdown-item",
                            text:'<i class="fas fa-file-pdf"></i> PDF',
                            exportOptions:{
                                columns:[0,1,2,3,4,5,6,7]
                            }
                        },
                        {
                            extend:"copy",
                            className:"dropdown-item",
                            text:'<i class="fas fa-copy"></i> Copy',
                            exportOptions:{
                                columns:[0,1,2,3,4,5,6,7]
                            }
                        }
                    ],
                    init:function(e,t,a){
                        $(t).removeClass("btn-secondary"),
                        $(t).parent().removeClass("btn-group"),
                        setTimeout(function(){
                            $(t).closest(".dt-buttons").removeClass("btn-group").addClass("d-inline-flex")
                        },50)
                    }
                },
               
            ],
            
        })),
       
        setTimeout(()=>{
            $(".dataTables_filter .form-control").removeClass("form-control-sm"),
            $(".dataTables_length .form-select").removeClass("form-select-sm")
        },300)
    }),

    document.addEventListener("DOMContentLoaded",function(e){
    {
        const o=document.querySelector("#newUserForm"),
        p=document.querySelector("#editUserForm"),
        t=document.querySelector("#phone");
        t&&new Cleave(t,{
            phone:!0,
            phoneRegionCode:"RW"
        });
     
      }
      @if($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('editUser'), {
          keyboard: false
        })
        myModal.show()
      @endif
    })
   
    
    

</script>

@endsection
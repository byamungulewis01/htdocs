@extends('layouts.app')

@section('page_name')
  Settings
@endsection

@section('contents')
  <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row mb-4">
        <!-- Source Visit -->
        <div class="col-xl-4 col-md-6 order-2 order-lg-1">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="card-title mb-0">
                <h5 class="mb-0">Martial Status</h5>
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" data-bs-toggle="modal" data-bs-target="#addNewStatus">
                  <i class="ti ti-plus ti-sm text-muted"></i> New
                </button>
              </div>
            </div>
            <div class="card-body">
              <ul class="p-0 m-0">
                @foreach($marital as $status)
                <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                  <div class="badge bg-label-success rounded p-2"><i class="ti ti ti-star ti-sm"></i></div>
                  <div class="d-flex justify-content-between w-100 flex-wrap">
                    <h6 class="mb-0 ms-3">{{ $status->title }}</h6>

                    <div class="modal fade" id="updateStatus{{ $status->id }}" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <form action="{{ route('marital.update') }}" class="needs-validation" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="token" value="{{ $status->id }}"/>
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel2">Update Status</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col">
                                  <label for="nameSmall" class="form-label">Title</label>
                                  <input type="text" id="nameSmall" name="title" class="form-control" value="{{ $status->title }}" placeholder="Enter status" required="">
                                  <div class="invalid-feedback"> Please enter status. </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-dark">Save changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="modal modal-top fade" id="deleteStatus{{ $status->id }}" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <form action="{{ route('marital.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="token" value="{{ $status->id }}"/>
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel2">Are you sure to delete?</h5>
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

                    <div class="d-flex">
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                            class="ti ti-dots-vertical"></i></button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#updateStatus{{ $status->id }}"><i class="ti ti-pencil me-1"></i> Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteStatus{{ $status->id }}"><i class="ti ti-trash me-1"></i> Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <!--/ Source Visit -->

        <!-- Laws Category table -->
        <div class="col-12 col-xl-8 col-sm-12 order-1 order-lg-2 mb-4 mb-lg-0">
          <div class="card">
          
          <div class="card-datatable table-responsive pt-0">
            <table class="datatables-laws table">
              <thead>
              <tr>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
          </div>
        </div>
        <!--/ Projects table -->
      </div>
      <div class="row">
        <!-- Source Visit -->
        <div class="col-xl-5 col-md-6 order-2 order-lg-1">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="card-title mb-0">
                <h5 class="mb-0">Case category</h5>
              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" data-bs-toggle="modal" data-bs-target="#casecategory">
                  <i class="ti ti-plus ti-sm text-muted"></i> New
                </button>
                <div class="modal fade" id="casecategory" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <form action="{{ route('probonoCategory.new') }}" class="needs-validation" method="POST">
                        @csrf
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel2">New Probono Case Category</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col">
                              <label for="nameSmall" class="form-label">Category name</label>
                              <input type="text" id="nameSmall" name="name" class="form-control" placeholder="Enter status" required="">
                              <div class="invalid-feedback"> Please enter category name. </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-dark">Save changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="p-0 m-0">
                @foreach($categories as $category)
                <li class="mb-4 pb-1 d-flex justify-content-between align-items-center">
                  <div class="badge bg-label-success rounded p-2"><i class="ti ti ti-star ti-sm"></i></div>
                  <div class="d-flex justify-content-between w-100 flex-wrap">
                    <h6 class="mb-0 ms-3">{{ $category->name }}</h6>

                    <div class="modal fade" id="updateCategory{{ $category->id }}" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <form action="{{ route('probonoCategory.edit') }}" class="needs-validation" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="token" value="{{ $category->id }}"/>
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel2">Update Category</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col">
                                  <label for="nameSmall" class="form-label">Category Name</label>
                                  <input type="text" id="nameSmall" name="name" class="form-control" value="{{ $category->name }}" placeholder="Enter status" required="">
                                  <div class="invalid-feedback"> Please enter Category Name. </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-dark">Save changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <div class="modal modal-top fade" id="deleteCategory{{ $category->id }}" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                          <form action="{{ route('probonoCategory.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="token" value="{{ $category->id }}"/>
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel2">Are you sure to delete?</h5>
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

                    <div class="d-flex">
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i
                            class="ti ti-dots-vertical"></i></button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#updateCategory{{ $category->id }}"><i class="ti ti-pencil me-1"></i> Edit</a>
                          <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteCategory{{ $category->id }}"><i class="ti ti-trash me-1"></i> Delete</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
        <!--/ Source Visit -->
      </div>
    </div>
  <!-- / Content -->

    <div class="modal fade" id="addNewStatus" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <form action="{{ route('marital.new') }}" class="needs-validation" method="POST">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">Add New Status</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col">
                  <label for="nameSmall" class="form-label">Title</label>
                  <input type="text" id="nameSmall" name="title" class="form-control" placeholder="Enter status" required="">
                  <div class="invalid-feedback"> Please enter status. </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-dark">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Small Modal -->
    <div class="modal fade" id="newCategory" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <form action="{{ route('lawcat.new') }}" class="needs-validation" method="POST">
              @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel2">New Law Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nameSmall" class="form-label">Title</label>
                  <input type="text" id="nameSmall" name="title" class="form-control" placeholder="Enter here" required="">
                  <div class="invalid-feedback"> Please enter title. </div>
                </div>
              </div>
              <div class="row">
                <div class="col mb-0">
                  <label class="form-label" for="descr">Description</label>
                  <textarea name="description" class="form-control" id="descr" placeholder="description (optional)"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-dark">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection

@section('js')
<script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
<script>

"use strict";
$(function(){
    var e=$(".datatables-laws");
    e.length&&(e.DataTable({
        ajax:"api/lawcat",
        columns:[
            {data:"title"},
            {data:"description"},
            {data:""}
        ],
        columnDefs:[
            {
                className:"d-flex justify-content-end",
                targets:-1,
                searchable:!1,
                title:"&nbsp;",
                orderable:!1,
                render:function(e,a,t,r){
                    return'<div class="d-inline-block"><a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Edit</a><div class="dropdown-divider"></div><a href="javascript:;" class="dropdown-item text-danger delete-record">Delete</a></div></div>'
                }
            }
        ],
        order:[[2,"desc"]],
        dom:'<"card-header pb-0 pt-sm-0"<"head-label text-center"><"d-flex justify-content-center justify-content-md-end"f>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',displayLength:7,
        lengthMenu:[7,10,25,50,75,100],
        responsive:{
            details:{
                display:$.fn.dataTable.Responsive.display.modal({
                    header:function(e){
                        return'Details of "'+e.data().title+'"'
                    }
                }),
                type:"column",
                renderer:function(e,a,t){
                    t=$.map(t,function(e,a){
                        return""!==e.title?'<tr data-dt-row="'+e.rowIndex+'" data-dt-column="'+e.columnIndex+'"><td>'+e.title+":</td> <td>"+e.data+"</td></tr>":""
                    }).join("");
                    return!!t&&$('<table class="table"/><tbody />').append(t)
                }
            }
        }
    }),
    $("div.head-label").html('<h5 class="card-title mb-0">Laws Category <button type="button" onclick="openCanva()" class="btn btn-icon btn-sm btn-label-github waves-effect ml-2"><i class="tf-icons ti ti-plus"></i></button></h5>')),
    setTimeout(()=>{
        $(".dataTables_filter .form-control").removeClass("form-control-sm"),
        $(".dataTables_length .form-select").removeClass("form-select-sm")
    },300)
});

function openCanva(){
  var myModal = new bootstrap.Modal(document.getElementById('newCategory'), {
    keyboard: false
  });
  myModal.show()

}

</script>
@endsection
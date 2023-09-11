@extends('layouts.app')

@section('page_name')
Contribution
@endsection

@section('contents')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">



    <!-- Users List Table -->
    <div class="card h-100">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">Contributions <a href="" data-bs-toggle="modal" data-bs-target="#contribution"
                    class="btn btn-dark text-white pull-left float-end"><i
                        class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">New
                        Contribution</span></a></h5>

        </div>
        <div class="modal fade" id="contribution" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Define New Contribution</h3>
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
                        <form method="POST" class="row g-3" action="{{ route('contribution.store') }}">
                            @csrf
                            <div class="col-12">
                                <label for="title" class="form-label">Name</label>
                                <input required type="text" name="name" class="form-control">
                            </div>
                            <div class="col-md-6">

                                <label for="date" class="form-label">Period Start</label>
                                <input required type="text" class="form-control start_period" name="start_period"
                                    placeholder="Month DD, YYYY">
                            </div>
                            <div class="col-md-6">
                                <label for="end" class="form-label">Period End</label>
                                <input required type="text" class="form-control end_period" name="end_period"
                                    placeholder="Month DD, YYYY">
                            </div>
                            <div class="col-4">
                                <label for="venue" class="form-label">Deadline</label>
                                <input required type="text" name="deadline" class="form-control deadline"
                                    placeholder="Month DD, YYYY">
                            </div>
                            <div class="col-4">
                                <label for="venue" class="form-label">Amount</label>
                                {{-- <input required type="text" name="amount" id="amount" class="form-control"> --}}
                            <input type="number" min="1" name="amount" class="form-control"
                                    placeholder="Enter Amount" />
                            </div>
                            <div class="col-4">
                                <label for="venue" class="form-label">Fine Percentage</label>
                                <input required type="text" name="percentage" id="percentage" class="form-control">
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="concern[]" type="checkbox" value="1"
                                        id="Advocate" />
                                    <label class="form-check-label" for="Advocate">
                                        Concerns Advocate
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="concern[]" type="checkbox" value="3"
                                        id="Support" />
                                    <label class="form-check-label" for="Support">
                                        Concerns Support Staff
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="concern[]" type="checkbox" value="2"
                                        id="interns" />
                                    <label class="form-check-label" for="interns">
                                        Concerns interns
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="concern[]" type="checkbox" value="4"
                                        id="Technical" />
                                    <label class="form-check-label" for="Technical">
                                        Technical Staff
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive" style="min-height: 500px;">
            <table class="datatables-users table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Contribution type</th>
                        <th>Period</th>
                        <th>Dealine</th>
                        <th>Amount</th>
                        <th>Fine Parcentage</th>
                        <th>Concerned Users</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                   @forelse ($contributions as $key => $contribution)
                       <tr>
                        <td>{{ $key+1 }}</td>
                        <td> {{ $contribution->name }} </td>
                        <td> {{ $contribution->start_period }} <span class="text-danger">to</span> {{ $contribution->end_period }}</td>
                        <td>{{ $contribution->deadline }}</td>
                        <td>{{ $contribution->amount }}</td>
                        <td>{{ $contribution->percentage }}</td>
                        <td>
                                @php
                                    $values = explode(',', $contribution->concern);
                                @endphp
                                @foreach($values as $key => $value)
                                @php
                                    switch ($value) {
                                        case 1:
                                            $concern = 'Concerns Advocate';
                                            break;
                                        case 2:
                                            $concern = 'Concerns interns';
                                            break;
                                        case 3:
                                            $concern = 'Concerns Support Staff';
                                            break;
                                        case 4:
                                            $concern = 'Technical Staff';
                                            break;
                                        
                                        default:
                                             $concern = '';
                                            break;
                                    }
                                @endphp
                                  <li>{{ $concern }}</li>
                                @endforeach
                        </td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#edit{{ $contribution->id}}" class="text-primary"><i
                                class="ti ti-edit me-0 me-sm-1 ti-xs"></i></a>
                                <div class="modal fade" id="edit{{ $contribution->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                        <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h3 class="mb-2">Update Contribution</h3>
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
                                                <form method="POST" class="row g-3" action="{{ route('contribution.update',$contribution->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-12">
                                                        <label for="title" class="form-label">Name</label>
                                                        <input required type="text" name="name" class="form-control" value="{{ $contribution->name }}">
                                                    </div>
                                                    <div class="col-md-6">
                        
                                                        <label for="date" class="form-label">Period Start</label>
                                                        <input required type="text" class="form-control start_period" name="start_period" value="{{ $contribution->start_period }}"
                                                           >
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="end" class="form-label">Period End</label>
                                                        <input required type="text" class="form-control end_period" name="end_period" value="{{ $contribution->end_period }}"
                                                           >
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="venue" class="form-label">Deadline</label>
                                                        <input required type="text" name="deadline" class="form-control deadline" value="{{ $contribution->deadline }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="venue" class="form-label">Amount</label>
                                                        {{-- <input required type="text" name="amount" id="amount" class="form-control"> --}}
                                                        <input type="number" min="1" name="amount" class="form-control" value="{{ $contribution->amount }}" />
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="venue" class="form-label">Fine Percentage</label>
                                                        <input required type="text" name="percentage" id="percentage" class="form-control" value="{{ $contribution->percentage }}">
                                                    </div>
                                                    @php
                                                    $values = explode(',', $contribution->concern);
                                               @endphp
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="concern[]" type="checkbox" @foreach($values as $key => $value) @if($value == 1) checked @endif  @endforeach value="1"
                                                                id="Advocate{{ $contribution->id }}" />
                                                            <label class="form-check-label" for="Advocate{{ $contribution->id }}">
                                                                Concerns Advocate
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="concern[]" type="checkbox" value="3" @foreach($values as $key => $value) @if($value == 3) checked @endif  @endforeach
                                                                id="Support{{ $contribution->id }}" />
                                                            <label class="form-check-label" for="Support{{ $contribution->id }}">
                                                                Concerns Support Staff
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="concern[]" type="checkbox" value="2" @foreach($values as $key => $value) @if($value == 2) checked @endif  @endforeach
                                                                id="interns{{ $contribution->id }}" />
                                                            <label class="form-check-label" for="interns{{ $contribution->id }}">
                                                                Concerns interns
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="concern[]" type="checkbox" value="4" @foreach($values as $key => $value) @if($value == 4) checked @endif  @endforeach
                                                                id="Technical{{ $contribution->id }}" />
                                                            <label class="form-check-label" for="Technical{{ $contribution->id }}">
                                                                Technical Staff
                                                            </label>
                                                        </div>
                                                    </div>
                        
                                                    <div class="col-12 d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <a href="" data-bs-toggle="modal" data-bs-target="#delete{{$contribution->id }}" class="text-danger"><i
                                class="ti ti-trash me-0 me-sm-1 ti-xs"></i></a>
                                <div class="modal modal-top fade" id="delete{{ $contribution->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-sm" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('contribution.delete',$contribution->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

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
                   @empty
                   <tbody>
                    <tr>
                        <td>
                            <i class="fas fa-bullhorn"></i>
                        </td>
                        <td colspan="4">
                            <h6><span class="badge bg-label-warning me-2">Comminique </span> No record found
                            </h6>

                        </td>


                    </tr>
                </tbody>
                   @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

</div>


<!-- / Content -->

@endsection



@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
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
<script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/js/forms-file-upload.js') }}"></script>
<script src="{{ asset('assets/js/forms-extras.js') }}"></script>

<script>
    "use strict";
    $(function () {
        var start_period = document.querySelectorAll(".start_period"),
            end_period = document.querySelectorAll(".end_period"),
            deadline = document.querySelectorAll(".deadline");

        start_period.flatpickr({
            autoclose:!0,
            enableTime: !0,
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            autoclose:!0,
        });
        end_period.flatpickr({
            autoclose:!0,
            enableTime: !0,
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            autoclose:!0,
        });
        deadline.flatpickr({
            autoclose:!0,
            enableTime: !0,
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",     
        });
    })


    $(document).ready(function () {
        $("#amount").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9.]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
        $("#percentage").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9.]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
    });


    @if($errors->any())
    @foreach($errors->all() as $error)

    @endforeach
    @php
    $data = 'Error Accurs';
    @endphp
    $(document).ready(function () {
        $.toast({
            heading: 'Error',
            text: '{{ $error }}',
            showHideTransition: 'fade',
            icon: 'error',
            position: 'top-right',
            hideAfter: 5000,
        });
    });
    @endif
</script>
@endsection
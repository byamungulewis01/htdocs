@extends('layouts.app')

@section('page_name')
Legal Edication
@endsection

@section('contents')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <div class="row">
            <h5 class="card-title mb-0">Legal Edication

                <a class="btn btn-dark text-white pull-left float-end" data-bs-toggle="modal"
                    data-bs-target="#training"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                        class="d-none d-sm-inline-block">New Training</span></a>
                        <a class="btn btn-dark text-white pull-left float-end" href="{{ route('training.export') }}"><i class="ti ti-file me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Export</span></a>
            </h5>
        </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Search by title"
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="training" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">New Training</h3>
                            </div>
                            <form method="POST" class="row g-3" action="{{ route('trainings.store') }}">
                                @csrf
                                <div class="col-12">
                                    <label for="title" class="form-label">Title</label>
                                    <input required type="text" name="title" class="form-control" placeholder="Title">
                                </div>
                                <div class="col-12">
                                    <label for="category" class="form-label">Training Category</label>
                                    <select required id="category" name="category" class="form-select">
                                        <option value="" selected>Choose one </option>
                                        <option @if(old('category')=="CLE" ) selected @endif value="CLE">CLE</option>
                                        <option @if(old('category')=="Publication" ) selected @endif
                                            value="Publication">Publication</option>
                                        <option @if(old('category')=="Legal Workshop" ) selected @endif
                                            value="Legal Workshop">Legal Workshop</option>
                                        <option @if(old('category')=="Meeting (Credit)" ) selected @endif
                                            value="Meeting (Credit)">Meeting (Credit)</option>
                                        <option @if(old('category')=="Lecture" ) selected @endif value="Lecture">Lecture
                                        </option>
                                        <option @if(old('category')=="Others" ) selected @endif value="Others">Others
                                        </option>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="venue" class="form-label">Venue</label>
                                    <input required type="text" name="venue" class="form-control" id="venue">
                                </div>
                                <div class="col-3">
                                    <label for="venue" class="form-label">Credit</label>
                                    <input required type="text" name="credits" id="credit" class="form-control">
                                </div>
                                <div class="col-3">
                                    <label for="venue" class="form-label">Price</label>
                                    <input required type="text" name="price" id="price" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="starton" class="form-label">Start on</label>
                                    <input required type="text" class="form-control" id="starton" name="starton"
                                        placeholder="Month DD, YYYY">
                                </div>
                                <div class="col-md-6">
                                    <label for="endon" class="form-label">End on</label>
                                    <input required type="text" class="form-control" id="endon" name="endon"
                                        placeholder="Month DD, YYYY">
                                </div>

                                <div class="col-md-6">
                                    <label for="early_deadline" class="form-label">Early Registration Deadline</label>
                                    <input required type="text" class="form-control" id="early_deadline"
                                        name="early_deadline" placeholder="Month DD, YYYY">
                                </div>
                                <div class="col-md-6">
                                    <label for="late_deadline" class="form-label">Late Registration Deadline</label>
                                    <input required type="text" class="form-control" id="late_deadline"
                                        name="late_deadline" placeholder="Month DD, YYYY H:i">
                                </div>
                                <div class="col-md-6">
                                    <label for="rate" class="form-label">Late Registration Rate</label>
                                    <input required type="text" class="form-control" id="rate" name="rate"
                                        placeholder="10">
                                </div>

                                <div class="col-md-6">
                                    <label for="seats" class="form-label">Number Of Seats</label>
                                    <input required type="text" class="form-control" id="seats" name="seats"
                                        placeholder="50">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="publish" type="checkbox" value="1"
                                            id="defaultCheck2" />
                                        <label class="form-check-label" for="defaultCheck2">
                                            Published ? (Uncheck if "NO")
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                        Training</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables table border-top">
                <thead>
                    <tr>
                        <th style="width: 5px">#</th>
                        <th style="width: 25%">Training title</th>
                        <th>Start on</th>
                        <th>End on</th>
                        <th>Venue</th>
                        <th>Booked</th>
                        <th>Confirmed</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                @php
                $count = 1;
                @endphp

                @forelse ($trainings as $training)
                <tbody>
                    <tr>
                        <td><span class="badge bg-label-danger me-2">{{ $count }}</span></td>
                        <td><strong>{{ $training->title }}</strong><br>
                            <span class="badge bg-label-info me-2">Credit</span>{{ $training->credits }}
                            <span class="badge bg-label-info me-2">Price</span>{{ $training->price }} Rwf
                        </td>
                        <td>{{ $training->starton }}</td>
                        <td>{{ $training->endon }}</td>
                        <td>{{ $training->venue }}</td>
                        <td>{{ $training->booking }} <a href="{{ route('trainings.booked' , $training->id) }}"><i
                                    class="ti ti-eye ti-sm mx-2"></i></a></td>
                        <td>{{ $training->confirm }} / {{ $training->seats }} <a
                                href="{{ route('trainings.confirmed' , $training->id) }}"><i
                                    class="ti ti-eye ti-sm mx-2"></i></td>
                        <td>
                            <a href="{{ route('trainings.details' , $training->id) }}"
                                class="btn btn-primary btn-sm text-white float-end"><i
                                    class="ti ti-pencil me-0 me-sm-1 ti-xs"></i><span
                                    class="d-none d-sm-inline-block">Details</span></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fas fa-bullhorn"></i>
                        </td>
                        <td colspan="7">
                            <h6><span class="badge bg-label-warning me-2">Warning </span>
                                Early Registration Deadline <u class="text-danger">{{ $training->early_deadline }}</u>
                                And Late Registration Deadline
                                ( <span class="text-warning">with {{ $training->rate }}% increase </span> )
                                <u class="text-danger">{{ $training->late_deadline }}</u>
                                <a href="" data-bs-toggle="modal" data-bs-target="#delete{{ $training->id }}"
                                    class="btn btn-sm btn-danger pull-left float-end"><i class="ti ti-trash"></i><span
                                        class="d-none d-sm-inline-block"></span></a>
                                @if ($training->publish == 1)
                                <a href="" data-bs-toggle="modal" data-bs-target="#notify{{ $training->id }}"
                                    class="btn btn-sm btn-dark float-end"><i class="ti ti-mail"></i><span
                                        class="d-none d-sm-inline-block"></span></a>
                                <div class="modal fade" id="notify{{ $training->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                        <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h3 class="mb-2">Send Notification Messages</h3>
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
                                                <form method="POST" class="row g-3"
                                                    action="{{ route('trainings.notify') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $training->id }}">

                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked name="recipients[]"
                                                                type="checkbox" value="1" id="BookedID" />
                                                            <label class="form-check-label" for="BookedID">Booked
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="recipients[]"
                                                                type="checkbox" value="2" id="ConfirmID" />
                                                            <label class="form-check-label" for="ConfirmID">Confirm
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="recipients[]"
                                                                type="checkbox" value="3" id="AttendingID" />
                                                            <label class="form-check-label" for="AttendingID">Attending
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="recipients[]"
                                                                type="checkbox" value="4" id="AttendedID" />
                                                            <label class="form-check-label" for="AttendedID">Attended
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="switch">
                                                            <span class="switch-label">Subject <span
                                                                    class="text-danger">include in Email
                                                                    only</span></span>
                                                        </label>
                                                        <input required type="text" name="subject" class="form-control"
                                                            id="subject" value="{{ $training->title }}">

                                                    </div>
                                                    <div class="col-12">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Message</label>
                                                        <textarea required name="message" class="form-control"
                                                            id="exampleFormControlTextarea1" rows="4"></textarea>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" name="sent[]"
                                                                type="checkbox" value="SMS" id="defaultCheck3" />
                                                            <label class="form-check-label" for="defaultCheck3">SMS
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" checked name="sent[]"
                                                                type="checkbox" value="EMAIL" id="defaultCheck4" />
                                                            <label class="form-check-label" for="defaultCheck4">EMAIL
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 text-center">
                                                        <button type="submit"
                                                            class="btn btn-primary me-sm-3 me-1">Submit</button>
                                                        <button type="reset" class="btn btn-label-secondary btn-reset"
                                                            data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </h6>

                            <div class="modal modal-top fade" id="delete{{ $training->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('trainings.delete') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $training->id }}" />
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
                @php
                $count++
                @endphp
                @empty
                <tbody>
                    <tr>
                        <td>
                            <i class="fas fa-bullhorn"></i>
                        </td>
                        <td colspan="7">
                            <h6><span class="badge bg-label-warning me-2">Comminique </span> No Training record found
                            </h6>

                        </td>


                    </tr>
                </tbody>
                @endforelse

            </table>
            <div class="col-lg-12">
                {{ $trainings->links('vendor.pagination.custom') }}
               
            </div>
        </div>
    </div>
</div>

<!--/ New User Modal -->
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
<script>
    "use strict";
    $(function () {
        var dtt = document.querySelector("#starton");
        dtt && dtt.flatpickr({
            enableTime: false,
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        })
    });
    $(function () {
        var dtt = document.querySelector("#endon");
        dtt && dtt.flatpickr({
            enableTime: false,
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        })
    });
    $(function () {
        var dtt = document.querySelector("#early_deadline");
        dtt && dtt.flatpickr({
            enableTime: false,
            altInput: !0,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        })
    });
    $(function () {
        var dtt = document.querySelector("#late_deadline");
        dtt && dtt.flatpickr({
            enableTime: !0,
            altInput: !0,
            altFormat: "F j, Y H:i",
            dateFormat: "Y-m-d H:i",
        })
    });


    $(document).ready(function () {
        $("#credit").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
        $("#price").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
        $("#price").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
        $("#seats").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
        $("#rate").on("input", function () {
            var value = $(this).val();
            var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
            if (!decimalRegex.test(value)) {
                $(this).val(value.substring(0, value.length - 1));
            }
        });
    });
</script>

@endsection
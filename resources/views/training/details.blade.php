@extends('layouts.app')

@section('page_name')
Trainings
@endsection

@section('contents')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-7 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <div
                        class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">

                        <div>
                            <h4 class="fw-semibold mb-2">{{ $training->title }} <a href="" data-bs-toggle="modal"
                                    data-bs-target="#training"><i class="ti ti-edit ti-sm me-2"></i></a></h4>
                            <div class="modal fade" id="training" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                    <div class="modal-content p-3 p-md-5">
                                        <div class="modal-body">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            <div class="text-center mb-4">
                                                <h3 class="mb-2">Edit Training</h3>
                                            </div>
                                            <form method="POST" class="row g-3"
                                                action="{{ route('trainings.update') }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="col-12">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="hidden" name="id" value="{{ $training->id }}">
                                                    <input required type="text" name="title" class="form-control"
                                                        value="{{ $training->title }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="category" class="form-label">Training Category</label>
                                                    <select required id="category" name="category" class="form-select">
                                                        <option @if($training->category == "CLE" ) selected @endif
                                                            value="CLE">CLE</option>
                                                        <option @if($training->category == "Publication" ) selected
                                                            @endif
                                                            value="Publication">Publication</option>
                                                        <option @if($training->category == "Legal Workshop" ) selected
                                                            @endif
                                                            value="Legal Workshop">Legal Workshop</option>
                                                        <option @if($training->category == "Meeting (Credit)" ) selected
                                                            @endif
                                                            value="Meeting (Credit)">Meeting (Credit)</option>
                                                        <option @if($training->category == "Lecture" ) selected @endif
                                                            value="Lecture">Lecture
                                                        </option>
                                                        <option @if($training->category == "Others" ) selected @endif
                                                            value="Others">Others
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-6">
                                                    <label for="venue" class="form-label">Venue</label>
                                                    <input required type="text" name="venue" class="form-control"
                                                        id="venue" value="{{ $training->venue }}">
                                                </div>
                                                <div class="col-3">
                                                    <label for="venue" class="form-label">Credit</label>
                                                    <input required type="text" name="credits" id="credit"
                                                        class="form-control" value="{{ $training->credits }}">
                                                </div>
                                                <div class="col-3">
                                                    <label for="venue" class="form-label">Price</label>
                                                    <input required type="text" name="price" id="price"
                                                        class="form-control" value="{{ $training->price }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="starton" class="form-label">Start on</label>
                                                    <input required type="text" class="form-control" id="starton"
                                                        name="starton" value="{{ $training->starton }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="endon" class="form-label">End on</label>
                                                    <input required type="text" class="form-control" id="endon"
                                                        name="endon" value="{{ $training->endon }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="early_deadline" class="form-label">Early Registration
                                                        Deadline</label>
                                                    <input required type="text" class="form-control" id="early_deadline"
                                                        name="early_deadline" value="{{ $training->early_deadline }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="late_deadline" class="form-label">Late Registration
                                                        Deadline</label>
                                                    <input required type="text" class="form-control" id="late_deadline"
                                                        name="late_deadline" value="{{ $training->late_deadline }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="rate" class="form-label">Late Registration Rate</label>
                                                    <input required type="text" class="form-control" id="rate"
                                                        name="rate" value="{{ $training->rate }}">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="seats" class="form-label">Number Of Seats</label>
                                                    <input required type="text" class="form-control" id="seats"
                                                        name="seats" value="{{ $training->seats }}">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="publish" type="checkbox"
                                                            value="1" id="defaultCheck2" @if ($training->publish == 1)
                                                        checked
                                                        @endif/>
                                                        <label class="form-check-label" for="defaultCheck2">
                                                            Published ? (Uncheck if "NO")
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center">
                                                    <button type="submit"
                                                        class="btn btn-primary waves-effect waves-light">Edit
                                                        Training</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p>It has Credit: {{ $training->credits }}. Venue: <strong>{{ $training->venue }}</strong>,
                                Starting on <u class="text-danger">{{ $training->starton }} </u> to End on <u
                                    class="text-danger">{{ $training->endon }} </u></p>
                            <hr>

                            <div class="demo-inline-spacing mt-3">
                                <div class="list-group list-group-horizontal-md text-md-center">
                                    <a class="list-group-item list-group-item-action active" id="home-list-item"
                                        data-bs-toggle="list" href="#horizontal-home">Training Topic</a>
                                    <a class="list-group-item list-group-item-action" id="profile-list-item"
                                        data-bs-toggle="list" href="#horizontal-profile">Training Materials</a>
                                </div>
                                <div class="tab-content px-0 mt-0">
                                    <div class="tab-pane fade show active" id="horizontal-home">
                                        <div class="card-header border-bottom">
                                            <h5 class="card-title mb-0">Training Topic <a href="" data-bs-toggle="modal"
                                                    data-bs-target="#topic"
                                                    class="btn btn-dark text-white pull-left float-end"><i
                                                        class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                                                        class="d-none d-sm-inline-block">training
                                                        topic</span></a>
                                                <div class="modal fade" id="topic" tabindex="-1" aria-hidden="true">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                                        <div class="modal-content p-3 p-md-5">
                                                            <div class="modal-body">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                                <div class="text-center mb-4">
                                                                    <h3 class="mb-2">Add Training Topic</h3>
                                                                </div>
                                                                <form method="POST" class="row g-3"
                                                                    action="{{ route('trainings.addTopic') }}">
                                                                    @csrf
                                                                    <div class="col-12">
                                                                        <label for="title"
                                                                            class="form-label">Topic</label>
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $training->id }}">
                                                                        <input required type="text" name="topic"
                                                                            class="form-control"
                                                                            placeholder="Topic to cover">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="starton" class="form-label">Start
                                                                            At</label>
                                                                        <input required type="text" class="form-control"
                                                                            id="startAt" name="startAt"
                                                                            placeholder="H:i">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="endon" class="form-label">End
                                                                            At</label>
                                                                        <input required type="text" class="form-control"
                                                                            id="endAt" name="endAt" placeholder="H:i">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="title"
                                                                            class="form-label">Trainer</label>
                                                                        <input required type="text" name="trainer"
                                                                            class="form-control"
                                                                            placeholder="Trainer Name">
                                                                    </div>



                                                                    <div class="col-12 d-flex justify-content-center">
                                                                        <button type="submit"
                                                                            class="btn btn-primary waves-effect waves-light">Add
                                                                            topic
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </h5>

                                        </div>
                                        <div class="row p-4">
                                            <div class="table-responsive">
                                                <table class="table m-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Topic</th>
                                                            <th style="width: 150px">Start At</th>
                                                            <th style="width: 110px">End At</th>
                                                            <th style="width: 200px">Trainer</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    @php
                                                    $count = 1;
                                                    @endphp

                                                    <tbody>
                                                        @forelse ($topics as $topic)
                                                        <tr>
                                                            <td>{{ $count }}</td>
                                                            <td>{{ $topic->topic }}</td>
                                                            <td>{{ $topic->startAt }}</td>
                                                            <td>{{ $topic->endAt }}</td>
                                                            <td>{{ $topic->trainer }}</td>
                                                            <td>
                                                                <a href="" data-bs-toggle="modal"
                                                                    data-bs-target="#delete{{ $topic->id }}"
                                                                    class="text-danger"><i
                                                                        class="ti ti-trash me-0 me-sm-1 ti-xs"></i></a>
                                                                <div class="modal modal-top fade"
                                                                    id="delete{{ $topic->id }}" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-sm" role="document">
                                                                        <div class="modal-content">
                                                                            <form method="POST"
                                                                                action="{{ route('topicDelete') }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="hidden" name="topic_id"
                                                                                    value="{{ $topic->id }}" />
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel2">Are you
                                                                                        sure yiu want Delete ?</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-label-secondary"
                                                                                        data-bs-dismiss="modal">no</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                        $count++;
                                                        @endphp
                                                        @empty
                                                        <tr>
                                                            <td></td>
                                                            <td colspan="4"><span class="text-warning">No Topic
                                                                    Specified</span></td>

                                                        </tr>
                                                        @endforelse


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="horizontal-profile">
                                        <div class="card-header border-bottom">
                                            <h5 class="card-title mb-0">Training Materials <a href=""
                                                    data-bs-toggle="modal" data-bs-target="#material"
                                                    class="btn btn-dark text-white pull-left float-end"><i
                                                        class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                                                        class="d-none d-sm-inline-block">Materials</span></a>
                                                <div class="modal fade" id="material" tabindex="-1" aria-hidden="true">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                                        <div class="modal-content p-3 p-md-5">
                                                            <div class="modal-body">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                                <div class="text-center mb-4">
                                                                    <h3 class="mb-2">Add Training Material</h3>
                                                                </div>
                                                                <form method="POST" class="row g-3"
                                                                    enctype="multipart/form-data"
                                                                    action="{{ route('addMaterial') }}">
                                                                    @csrf
                                                                    <div class="col-12">
                                                                        <label for="title"
                                                                            class="form-label">Title</label>
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $training->id }}">
                                                                        <input required type="text" name="title"
                                                                            class="form-control"
                                                                            placeholder="Matelial Title">
                                                                    </div>

                                                                    <div class="col-12">
                                                                        <label for="title"
                                                                            class="form-label">File  <span class="text-warning">Allowable file is only Word, PPT and PDF</span> </label>
                                                                        <input required type="file" name="file_name" class="form-control" accept=".doc, .docx, .ppt, .pptx, .pdf">
                                                                    </div>
                                                                    <div class="col-12 d-flex justify-content-center">
                                                                        <button type="submit"
                                                                            class="btn btn-primary waves-effect waves-light">Add
                                                                            Material
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </h5>

                                        </div>
                                        <div class="row p-4">
                                            <div class="table-responsive">
                                                <table class="table m-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Title</th>
                                                            <th>Files</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    @php
                                                    $count = 1;
                                                    @endphp
                                                    <tbody>
                                                        @forelse ($materials as $material)
                                                        <tr>
                                                            <td>{{ $count }}</td>
                                                            <td>{{ $material->title }}</td>
                                                            <td><a
                                                                    href="{{ route('download',$material->file ) }}">Download</a>
                                                            </td>
                                                            <td>
                                                                <a href="" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteMaterial{{ $material->id }}"
                                                                    class="text-danger"><i
                                                                        class="ti ti-trash me-0 me-sm-1 ti-xs"></i></a>
                                                                <div class="modal modal-top fade"
                                                                    id="deleteMaterial{{ $material->id }}" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-sm" role="document">
                                                                        <div class="modal-content">
                                                                            <form method="POST"
                                                                                action="{{ route('materialDelete') }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $material->id }}" />
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel2">Are you
                                                                                        sure you want Delete ?</h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-label-secondary"
                                                                                        data-bs-dismiss="modal">no</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                        $count++;
                                                        @endphp
                                                        @empty
                                                        <tr>
                                                            <td></td>
                                                            <td colspan="4"><span class="text-warning">No Material
                                                                    Specified</span></td>

                                                        </tr>
                                                        @endforelse


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>


                </div>
                <hr class="my-0" />


            </div>
        </div>
        <div class="col-xl-5 col-md-8 col-12 mb-md-0 mb-4">
          @include('training.extra')
        </div>
    </div>

</div>

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


@endsection
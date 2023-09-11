@extends('layouts.app')

@section('page_name')
Disciplene info
@endsection

@section('contents')

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-2">
        <span class="text-muted fw-light">Disciplinary case /</span> Profile
    </h4>


    @include('myprofile.navigation')

    @php
    use App\Models\DisciplineReport;
    @endphp
    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-6 col-lg-5 col-md-5">

            <div class="card mb-4">
                <div class="card-body">
                    <h5>Case Information</h5>
                    @foreach ($sittings as $sitting)

                    @endforeach

                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>Disciplinary Case Number</td>
                                    <td>{{ $case->case_number }}</td>
                                </tr>
                                <tr>
                                    <td>Created By</td>
                                    <td>{{ $case->admin->name }}</td>
                                </tr>
                                <tr>
                                    <td>Created On</td>
                                    <td>{{ $case->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>@if ($case->case_status =='OPEN')
                                        <span class="badge bg-label-info">{{ $case->case_status }}</span>
                                        @else
                                        <span class="badge bg-label-danger">{{ $case->case_status }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Authority</td>
                                    <td>{{ $case->authority }}</td>
                                </tr>
                                <tr>
                                    <td>Complaint</td>
                                    <td>{{ $case->complaint }}</td>
                                </tr>
                                <tr>
                                    <td>Next Sitting Day</td>
                                    <td>{{ $sitting->sittingDay }}</td>
                                </tr>
                                <tr>
                                    <td>Next Sitting Time</td>
                                    <td>{{ $sitting->sittingTime }}</td>
                                </tr>

                                <tr>
                                    <td>Plaintiff</td>
                                    <td>{{ $case->p_name }}

                                        @if ($case->case_type == 1)

                                        @elseif ($case->case_type == 2)
                                        <span class="badge bg-label-warning me-2">Advocate</span>
                                        @else
                                        <span class="badge bg-label-warning me-2">Advocate</span>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td>Defendant</td>
                                    <td>{{ $case->d_name }}
                                        @if ($case->case_type == 1)
                                        <span class="badge bg-label-warning me-2">Advocate</span>
                                        @elseif ($case->case_type == 2)

                                        @else
                                        <span class="badge bg-label-warning me-2">Advocate</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>
        <div class="col-xl-6 col-lg-7 col-md-7">
            <div class="card mb-4">
                <h5 class="card-header">Case Sammry</h5>
                <div class="cord-body bg-light" style="padding: 2%">
                    <p>
                        {{ $case->sammary }}
                    </p>
                </div>

            </div>


            <div class="card card-action mb-4">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Participant</h5>

                </div>
                <div class="card-body">

                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Advocate</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @php
                                $count = 1;
                                @endphp
                                @foreach ($members as $member)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $member->user->name }}</td>
                                    <td>{{ $member->role }}</td>


                                </tr>
                                @php
                                $count++
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--/ Teams -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">

                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Schedules</th>
                                    <th style="width: 700px;">Conclusions</th>
                                    <th style="width: 10px;"></th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @php
                                $count = 1;
                                @endphp
                                @foreach ($sittings as $sitting)
                                @if ($sitting->sittingDay == 'NONE')
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                @else
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>

                                        <li class="d-flex align-items-center"><span class="fw-bold mx-2"><span
                                                    class="badge bg-primary">{{  $sitting['category'] }}</span>
                                        </li>
                                        <li class="d-flex align-items-center"><span class="fw-bold mx-2">Sitting
                                                Day:</span>{{  $sitting['sittingDay'] }}</span></li>
                                        <li class="d-flex align-items-center"><span class="fw-bold mx-2">Sitting
                                                Time:</span>{{  $sitting['sittingTime'] }}</span></li>
                                        <li class="d-flex align-items-center"></i><span class="fw-bold mx-2">Sitting
                                                Time:</span>{{  $sitting['sittingVenue'] }}</span></li>
                                        <li class="d-flex align-items-center"><span class="fw-bold mx-2">Scheduled
                                                by:</span>{{  $sitting->admin->name }}</span></li>

                                    </td>

                                    <td>
                                        <li class="d-flex align-items-center mb-2"><span class="fw-bold mx-2"><span
                                                    class="badge bg-danger">{{  $sitting['decisionCategory'] }}</span>
                                        </li>
                                        <li class="d-flex align-items-center"><span class="fw-bold mx-2">
                                                <span class="badge bg-primary">Targeting:</span>
                                            </span> @if ($sitting->targetedAdvocate == 'N/A' || $sitting->targetedAdvocate == NULL)
                                            No One
                                            @else
                                            {{ $sitting->user->name }}
                                            @endif
                                            </span></li>

                                        <u>Comment</u> <br>
                                            <textarea disabled cols="50" rows="5">{{ $sitting['comment'] }}</textarea>
                                        <br>
                                        @php
                                             $attachements = explode(',', $sitting->attach_file);
                                        @endphp
                                        @if ($attachements[0] != '')
                                        @foreach ($attachements as $key => $attachement)
                                        <a href="{{ route('userDownload-files',$attachement) }}">Download file {{ $key+1 }}</a> &nbsp;&nbsp;
                                        @endforeach
                                        @endif
                                       

                                    </td>

                                    <td>
                                        @if ($case->case_status =='OPEN')
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#decision{{ $sitting->sitting_id }}"
                                            class="btn btn-primary btn-sm"> <i class="ti ti-plus">Report</i>
                                        </a>
                                        <div class="modal fade" id="decision{{ $sitting->sitting_id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div
                                                class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                                <div class="modal-content p-3 p-md-5">
                                                    <div class="modal-body">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        <div class="text-center mb-4">
                                                            <h3 class="mb-2">User Disciplinary case Report</h3>
                                                        </div>
                                                        <form method="POST" class="row g-3"
                                                            action="{{ route('user.disciplinaryReport') }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="discipline_id"
                                                                value="{{ $case->id }}">
                                                            <input type="hidden" name="sitting_id"
                                                                value="{{ $sitting->sitting_id }}">
                                                            <div class="col-12">
                                                                <label for="exampleFormControlTextarea1"
                                                                    class="form-label">Comments</label>
                                                                <textarea required name="comments" class="form-control"
                                                                    id="exampleFormControlTextarea1" rows="6"></textarea>
                                                            </div>
                                                            <div class="col-12">
                                                                <label class="form-label w-100" for="title">Attach File
                                                                    (Maximum Files 5)</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input accept=".doc,.docx,.ppt,.pptx,.pdf"
                                                                        name="attachements[]" class="form-control"
                                                                        type="file" multiple max="5" />

                                                                </div>
                                                            </div>

                                                            <div class="col-12 text-center">
                                                                <button type="submit"
                                                                    class="btn btn-primary me-sm-3 me-1">Submit</button>
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
                                        <br><br><br>
                                        @php
                                        $reports = DisciplineReport::where('discipline_id',$case->id)->where('sitting_id',$sitting->sitting_id)->get();
                                        $id = $reports->pluck('id');
                                        @endphp
                                        <p>
                                           <a data-bs-toggle="modal" data-bs-target="#reports{{ $sitting->sitting_id }}"
                                            class="btn btn-sm btn-label-secondary text-nowrap d-inline-block">
                                            Reported Events
                                            <span
                                                class="badge bg-danger text-white badge-notifications">{{ $reports->count() }}</span>
                                        </a> 
                                        </p>
                                        
                                        <div class="modal fade" id="reports{{ $sitting->sitting_id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                                <div class="modal-content p-3 p-md-5">
                                                    <div class="modal-body">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                           
                                                        <div class="text-center mb-4">
                                                            <h5 class="mb-2">Reported Events</h5>    
                                                        </div>
                                                        @forelse ($reports as $report)
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h6>Reports Details
                                                                 <span class="badge bg-secondary pull-left float-end">{{ $report->user->name }}</span>
                                                                </h6>
                                                                <textarea disabled name="comments" class="form-control"
                                                                    id="exampleFormControlTextarea1" rows="6">{{ $report->comments }}</textarea>
                                                                <p>
                                                                    <h6>Attachments:</h6>
                                                                    @php
                                                                    $attachements = explode(',', $report->attachements);
                                                                  @endphp
                                                                    @foreach ($attachements as $key => $attachement)
                                                                    <a href="{{ route('userDownload-files',$attachement) }}">Download file {{ $key+1 }}</a> &nbsp;&nbsp;
                                                                    @endforeach
                                                                </p>
                                                            </div>
                                                        </div>
                                                       
                                                        @empty
                                                            
                                                        @endforelse
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
           
                    @endif
                    </td>

                    </tr>
                    @endif

                    @php
                    $count++;
                    @endphp
                    @endforeach

                    </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
    <!--/ About User -->

    <!--/ Profile Overview -->
</div>

</div>
<!--/ User Profile Content -->

</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('js')
<script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

@endsection
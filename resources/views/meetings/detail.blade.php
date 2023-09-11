@extends('layouts.app')

@section('page_name')
Check in
@endsection

@section('contents')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-12 col-md-8 col-12 mb-md-0">
            <div class="card invoice-preview-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">

                        <div>
                            <h4 class="fw-semibold mb-2">{{ $meeting->title }}</h4>
                            <p>It has Credit: {{ $meeting->credits }}. Date:
                                {{ \Carbon\Carbon::parse($meeting->date)->locale('fr')->format('F j, Y') }}, Venue:
                                <strong>{{ $meeting->venue }}</strong>, Starting at {{ $meeting->start }} to End at
                                {{ $meeting->end }}
                            
                            </p>
                            <span>
                                <strong>TOTAL INVITED</strong> <span class="badge bg-label-secondary me-2">{{ $attending }}</span>
                              </span>

                            <span>
                                <strong>BOOKED</strong> <span class="badge bg-label-secondary me-2">{{ $booked }}</span>
                              </span>

                            <span>
                                <strong>ATTENDED</strong> <span class="badge bg-label-secondary me-2">{{ $attended }}</span>
                              </span>
                         
                        </div>


                        <div>
                         <form action="{{ route('meeting.checkin') }}" method="post">
                            @csrf
                            <div class="input-group input-group-merge">
                                
                                <span class="input-group-text" id="basic-addon-search31"><i
                                        class="ti ti-search"></i></span>
                                <input type="hidden" name="meeting" value="{{ $meeting->id }}">
                                <input type="text" name="regNumber" class="form-control" placeholder="Attendance checkin"/> 
                                    
                            </div>
                        </form>
                            <br>
                            {{-- <div id="results" style="overflow: hidden; height:70px;"></div> --}}
                        </div>


                    </div>


                </div>
                <hr class="my-0" />
                
                <div class="row p-4">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Names</th>
                                    <th>Reg No</th>
                                    <th>Status</th>
                                    <th style="width: 40ch">checkin Date</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($invitations as $key => $invitation)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $invitation->name }}</td>
                                    <td>{{ $invitation->regNumber }}</td>
                                    <td>
                                       Attended
                                    </td>
                                    <td>
                                   {{ $invitation->updated_at }}
                                    </td>
                                </tr>
                               
                                @empty
                                <tr>
                                    <td></td>
                                    <td>
                                        <h6>No invitation</h6>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                @endforelse
                            </tbody>
                          
                        </table>
                        <div class="col-lg-4">
                            {{ $invitations->links('vendor.pagination.custom') }}
                           
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /Invoice -->
    <div class="modal fade" id="invite" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Invite Advocate to Meeting</h3>
                    </div>
                    <form method="POST" class="row g-3" action="{{ route('meetings.invite') }}">
                        @csrf
                        <div class="col-12">
                            <input type="hidden" name="meeting" value="{{ $meeting->id }}">
                            <select required name="user[]" multiple class="form-select" id="exampleFormControlSelect2"
                                aria-label="Multiple select example">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>


                        </div>

                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Invite</button>
                        </div>
                    </form>
                </div>
            </div>
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
<script>
let searchInput = document.querySelector('#search');
let resultsDiv = document.querySelector('#results');

searchInput.addEventListener('input', function() {
    let query = searchInput.value;
    let meeting = '{{ $meeting->id }}'; 
    if (query.length >= 2) {
        fetch('{{ route('users.search') }}?query=' + query)
            .then(response => response.json())
            .then(users => {
                resultsDiv.innerHTML = '';
                for (let user of users) {
                    let userDiv = document.createElement('div');
                    userDiv.innerHTML = user.name + ' (' + user.regNumber + ') <a href="attends/'+ meeting +'/'+ user.id + '" class="btn btn-sm btn-success text-white"><i class="ti ti-check me-0 me-sm-1 ti-xs"></i></a>';
                    resultsDiv.appendChild(userDiv);
                }
            });
    } else {
        resultsDiv.innerHTML = '';
    }
});
</script>

@endsection
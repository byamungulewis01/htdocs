@extends('layouts.app')

@section('page_name')
Compliance info
@endsection

@section('contents')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-2">
        <span class="text-muted fw-light">Compliance case /</span> Profile
    </h4>


    @include('myprofile.navigation')

    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-2">
                <div class="card-body">
                   <form action="" method="get">
                    <div class="input-group">
                        <input name="year" type="text" required class="form-control" id="year" value="{{ date('Y-m-d') }}"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                       <button class="btn btn-outline-primary waves-effect" type="submit" id="button-addon2">Compliances for selected YEAR</button>
                  </div>
                   </form>
                </div>
            </div>
            <!--/ About User -->
            <div class="card mb-2">
                @if ($contribution != null)
                <div class="modal fade" id="contribution" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                        <div class="modal-content p-3 p-md-5">
                            <div class="modal-body">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <div class="text-center mb-4">
                                    <h3 class="mb-2">Contribution</h3>
                                </div>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <tbody class="table-border-bottom-0">
                                            <tr>
                                                <td>Contribution type</td>
                                                <td> {{ $contribution->name }} </td>
                                            </tr>
                                            <tr>
                                                <td>Period</td>
                                                <td>{{ $contribution->start_period }} <span
                                                        class="text-danger">to</span> {{ $contribution->end_period }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Deadline</td>
                                                <td> {{ $contribution->deadline }} </td>
                                            </tr>
                                            <tr>
                                                <td>Defined Amount</td>
                                                <td>{{ $contribution->amount }} Rwf</td>
                                            </tr>
                                            <tr>
                                                <td>Fine Amount</td>
                                                <td>
                                                    @php
                                                    $a = App\Models\ContributeAdvocate::count();
                                                    if ($a == 0) {
                                                    $paid = 0;
                                                    } else {
                                                    $b = App\Models\ContributeAdvocate::where('advocate'
                                                    ,auth()->user()->id)->count();
                                                    if ($b == 0) {
                                                    $paid = 0;
                                                    } else {
                                                    $contibu = App\Models\ContributeAdvocate::where('advocate'
                                                    ,auth()->user()->id)
                                                    ->where('contribution' ,$contribution->id)
                                                    ->first();
                                                    $paid = $contibu->amount;
                                                    }

                                                    }
                                                    @endphp
                                                    {{ $paid }} Rwf
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Paid Amount</td>
                                                <td>{{ $paid }} Rwf</td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td> @if ($paid == 0)
                                                    <span class="badge bg-label-danger me-2">Unpaid</span>
                                                    @else
                                                    <span class="badge bg-label-info me-2">Paid</span>
                                                    @endif</td>
                                            </tr>



                                        </tbody>
                                    </table>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <h6 class="text-uppercase">Contribution</h6>
                    <hr>
                    <table>
                        <tr>
                            <td width="150">Score
                                @if ($paid == 0)
                                <span class="badge bg-label-danger me-2">Unpaid</span>
                                @else
                                <span class="badge bg-label-info me-2">Paid</span>
                                @endif
                            </td>
                            <td width="200"> Compliance
                                @if ($paid == 0)
                                <span class="badge bg-label-danger"><i class="ti ti-check"></i></span>
                                @else
                                <span class="badge bg-label-info"><i class="ti ti-check"></i></span>
                                @endif
                            </td>
                            <td><a href="" data-bs-toggle="modal" data-bs-target="#contribution">Details</a>
                            </td>
                        </tr>
                    </table>
                </div>
                @endif
            </div>
            <!--/ About User -->
            <!-- About User -->
            {{-- <div class="card mb-2">
                <div class="card-body">
                    <small class="card-text text-uppercase">Office</small> <br><br>
                    <span class="badge bg-label-info me-2">Score</span>23
                    <span class="badge bg-label-info me-2">Compliance</span> Rwf
                </div>
            </div> --}}
            <!--/ About User -->
            <!-- About User -->
            <div class="card mb-2">
                <div class="card-body">
                    <h6 class="text-uppercase">Practicing Status
                        <span class="pull-left float-end"> <span class="badge bg-label-{{ badge($user->practicing) }}">{{ userStatus($user->practicing) }}</span>
                        </span>
                    </h6>
               
                </div>
            </div>
            <!--/ About User -->

        </div>
        <div class="col-xl-7 col-lg-7 col-md-7">
            <div class="card mb-4">
                <h5 class="card-header">Continuous Legal Education</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-truncate">Item</th>
                                    <th class="text-truncate">Units</th>
                                    <th class="text-truncate"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-truncate">C.L.E</td>
                                    <td class="text-truncate">
                                         @php
                                             $cle = \App\Models\Booking::where('advocate',auth()->user()->id)->sum('cumulatedCredit');
                                             $extra = \App\Models\ExtraCle::where('advocate',auth()->user()->id)->sum('credits');
                                             $meeting = \App\Models\Invitations::where('user_id',auth()->user()->id)->sum('credit');
                                         @endphp
                                        {{ $cle }}

                                    </td>
                                    <td class="text-truncate"></td>
                                </tr>
                                <tr>
                                    <td class="text-truncate">Extra C.L.E</td>
                                    <td class="text-truncate">
                                     {{ $extra }}
                                    </td>
                                    <td class="text-truncate"></td>
                                </tr>
                              
                                <tr>
                                    <td class="text-truncate">Meetings</td>
                                    <td class="text-truncate">
                                       {{ $meeting }}
                                    </td>
                                    <td class="text-truncate"></td>
                                </tr>
                                <tr>
                                    <td class="text-truncate"><strong>Total</strong></td>
                                    <td class="text-truncate">
                                        <strong>
                                         {{ $cle + $extra + $meeting }}
                                        </strong>
                                      

                                    </td>
                                    <td class="text-truncate"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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

<script>
        $(function () {
        var dtt=document.querySelector("#year");
    dtt&&dtt.flatpickr({altInput:!0,altFormat:"F j, Y",dateFormat:"Y-m-d"});
        
    });

</script>
@endsection
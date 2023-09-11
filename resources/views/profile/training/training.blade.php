@extends('layouts.app')

@section('page_name')
Legal Education 
@endsection

@section('contents')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-5">
        <span class="text-muted fw-light">Legal Education /</span> Profile
    </h4>


    @include('profile.navigation')

    <div class="row">
       
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-7 col-md-8 col-12 mb-md-0 mb-4">
            <div class="card invoice-preview-card">
                <div class="card-header">
                    <h5>{{ $name }}'s Trainings</h5>
                </div>
                <div class="card-body">
                    <div class="card-datatable table-responsive border-top">
                        <table class="datatables table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Trainings</th>
                                    <th>Descriptions</th>
                                </tr>
                            </thead>
                            @php
                            $count = 1;
                            @endphp
                            @forelse ($bookings as $booking)
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-label-danger me-2">{{ $count }}</span></td>
                                    <td><strong>{{ $booking->trains->title }}</strong><br>
                                        <span class="badge bg-label-info me-2">Credit</span>{{ $booking->trains->credits }}
                                        <span class="badge bg-label-info me-2">Price</span>{{ $booking->trains->price }} Rwf
                                    </td>
                                    <td>
                                        <strong>Venue :</strong> {{ $booking->trains->venue }}<br>
                                        Start on <u class="text-primary">{{ $booking->trains->starton }}</u> |
                                        End on <u class="text-primary">{{ $booking->trains->endon }}</u>
                                    </td>

                                </tr>
                              
                            </tbody>
                            @php
                            $count++
                            @endphp
                            @empty
                            <tr>
                                <td></td>
                                <td>There is no Any Training Available now</td>
                            </tr>
                            @endforelse

                        </table>
                        <div class="col-lg-12"> 
                            
                            {{ $bookings->links('vendor.pagination.custom') }}
                           
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-5 col-md-8 col-12 mb-md-0 mb-4">
            @include('profile.training.extra')
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

@endsection
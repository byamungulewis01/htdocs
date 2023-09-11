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
                            <div class="card-header border-bottom">
                                <h5 class="card-title mb-0">Booked<span class="pull-left float-end"><span
                                            class="badge bg-label-info me-2">Training</span>
                                        {{ $training->title }}</span>
                                </h5>

                            </div>
                            <div class="row p-4">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="width: 220px">Person</th>
                                                <th>Price</th>
                                                <th>Credit</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        @php
                                        $count = 1;
                                        @endphp

                                        <tbody>
                                            @forelse ($bookings as $booking)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $booking->user->name}}</td>
                                                <td>{{ $booking->trains->price }}</td>
                                                <td>{{ $booking->trains->credits }}</td>
                                                <td> @if ($booking->booked)
                                                    <span class="badge bg-label-info me-2">Booked</span>
                                                    @else
                                                    <span class="badge bg-label-warning me-2">Not booked</span>
                                                    @endif </td>
                                                <td>
                                                    @unless ($booking->trains->price == 0.00)
                                                    @if (!$booking->confirm)
                                                    <a href="" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#payee{{ $booking->id }}"
                                                    class="text-info">payee</a>
                                                    @endif
                                                <div class="modal fade" id="payee{{ $booking->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                                        <div class="modal-content p-3 p-md-5">
                                                            <div class="modal-body">
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                                <div class="text-center mb-4">
                                                                    <h3 class="mb-2">Pay <span
                                                                            class="text-danger">{{ $booking->trains->price }}
                                                                            Rwf </span> To be Enrolled in
                                                                        <span
                                                                            class="text-primary">{{ $booking->trains->title }}</span>
                                                                    </h3>
                                                                </div>
                                                                <form method="POST" class="row g-3"
                                                                    action="{{ route('paytraining') }}">

                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $booking->id }}">
                                                                    <div
                                                                        class="col-12 d-flex justify-content-center">
                                                                        <button type="submit"
                                                                            class="btn btn-primary waves-effect waves-light">Make
                                                                            payment</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    @endunless
                                                
                                                </td>

                                            </tr>
                                            @php
                                            $count++;
                                            @endphp
                                            @empty
                                            <tr>
                                                <td></td>
                                                <td colspan="4"><span class="text-warning">No data Found or Not yet
                                                        Book</span></td>

                                            </tr>
                                            @endforelse


                                        </tbody>
                                    </table>
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


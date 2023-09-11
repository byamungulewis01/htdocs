@extends('layouts.app')

@section('page_name')
Discipline Details
@endsection

@section('contents')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Notify History</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">N<sup>0</sup> </th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Plaintiff</th>
                                <th scope="col">Defendant</th>
                                <th scope="col">Message</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($notifyRecords as $notifyRecord)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $notifyRecord->created_at->format('d/m/Y') }}</td>
                                <td>{{ $notifyRecord->created_at->format('H:i:s') }}</td>
                                <td>{{ $notifyRecord->plaintiff_name }}</td>
                                <td>{{ $notifyRecord->defandant_name }}</td>
                                <td> <a data-bs-toggle="modal" data-bs-target="#moreInfo{{ $notifyRecord->id }}" href="" class="text-muted">View Message</a>
                                    <div class="modal fade" id="moreInfo{{ $notifyRecord->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered1 modal-lg modal-simple modal-add-new-cc">
                                            <div class="modal-content p-3 p-md-5">
                                                <div class="modal-body">
                                                    <div class="row" style="font-size: 14px; overflow: auto; height: 500px;">
                                                        <div class="col-xl-12">

                                                            {!! $notifyRecord->message !!}
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>



    </div>

</div>

@endsection

@section('css')

@endsection

@section('js')

@endsection
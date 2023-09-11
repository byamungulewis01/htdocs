@extends('layouts.app')

@section('page_name')
Meeting info
@endsection

@section('contents')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-2">
        <span class="text-muted fw-light">Meetings /</span> Profile
    </h4>


    @include('myprofile.navigation')

    <!-- User Profile Content -->
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Meeting</th>
                  <th>Date</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Venue</th>
                  <th>Credits</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @php
                $count = 1;
                @endphp
                @foreach ($meetings as $meeting)
      
                <tr>
                  <td>{{ $count }}</td>
                  <td>{{ $meeting->meeting->title }}
      
                  </td>
                  <td>{{ \Carbon\Carbon::parse($meeting->date)->locale('fr')->format('F j, Y') }}</td>
                  <td>
                    {{ $meeting->meeting->start }}
                  </td>
                  <td>{{ $meeting->meeting->end }}</td>
                  <td>{{ $meeting->meeting->venue }}</td>
                  <td>
                    {{ $meeting->meeting->credits }}
                  </td>
                  <td>
                   @if ($meeting->status == 1)
                   
                    @if (!$meeting->booked)
                      @if ($meeting->bookDeadline < \Carbon\Carbon::now()->format('Y-m-d'))
                      <span class="badge bg-label-danger me-2">Booking Closed</span>
                      @else
                      <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#book{{ $meeting->id }}">Book</button>
                      @endif
                  

                    <div class="modal modal-top fade" id="book{{ $meeting->id }}" tabindex="-1" aria-hidden="true">
                     <div class="modal-dialog modal-sm" role="document">
                       <div class="modal-content">
                         <form method="POST" action="{{ route('meeting_book') }}">
                           @csrf
                           @method('PUT')
                            <input type="hidden" name="meeting" value="{{ $meeting->id }}" />
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel2">Are you sure to Book This? <span id="username"></span>?</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                             <button type="submit" class="btn btn-danger">Yes, delete</button>
                           </div>
                         </form>
                       </div>
                     </div>
                   </div> 
                    @else
                    <span class="badge bg-label-primary me-2">Booked</span>
                    @endif
                  
                   @else
                 <span class="badge bg-label-success me-2">Attended</span>
                   @endif
                  </td>
      
                </tr>
            
      
                @php
                $count++
                @endphp
      
                <div class="modal modal-top fade" id="delete{{ $meeting->id }}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                      <form action="{{ route('marital.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="meeting" value="{{ $meeting->id }}" />
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel2">Are you sure to delete? {{ $meeting->id }}</h5>
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
                
                @endforeach
      
      
              </tbody>
            </table>
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
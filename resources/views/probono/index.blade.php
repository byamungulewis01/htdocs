@extends('layouts.app')

@section('page_name')
Pro Bono Cases
@endsection
@php
    use App\Models\ProbonoParticipant;
@endphp

@section('contents')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

  <!-- Users List Table -->
  <div class="card">
    <div class="card-header border-bottom">
      <h5 class="card-title mb-0">Pro Bono Cases
       

        <a class="btn btn-dark text-white pull-left float-end" href="{{ route('probono.report') }}"><span
            class="d-none d-sm-inline-block">Data</span></a>

        <a class="btn btn-dark text-white pull-left float-end" data-bs-toggle="modal" data-bs-target="#newCase"><i
            class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">New case</span></a><a
          class="d-none" id="edit" data-bs-toggle="modal" data-bs-target="#editmeetings"></a>
      </h5>

    </div>

    <div class="card-datatable table-responsive">
      <table class="datatables-probono table border-top">
        <thead>
          <tr>
            <th>#</th>
            <th style="width: 20%">Legal Aids Seeker</th>
            <th>Referrer</th>
            <th>Case Number</th>
            <th>Case Nature</th>
            <th>Case Status</th>
            <th>Hearing Day</th>
            <th>Manage</th>
          </tr>
        </thead>
        @php
        $count = 1;
        @endphp
        @forelse ($probonos as $probono)

        <tbody>
          <tr>
            <td><span class="badge bg-label-danger me-2">{{ $count }}</span></td>
            <td>{{ $probono->fname }} {{ $probono->lname }} <br>
              <span class="badge bg-label-info me-2">Phone</span>
              @if ($probono->phone == null)
                  <em>No Phone</em>
              @else
              {{ $probono->phone }}
              @endif
            </td>
            <td>{{ $probono->referrel }} <br>
              <span class="badge bg-label-primary me-2">Category</span>{{ $probono->category }}
            </td>
            <td>{{ $probono->referral_case_no }}</td>
            <td>{{ $probono->case_nature }}</td>
            <td>
              @switch($probono->status)
              @case('OPEN')
              <span class="badge bg-label-primary me-2">{{ $probono->status }}</span>
              @break
              @case('WON')
              <span class="badge bg-label-success me-2">{{ $probono->status }}</span>
              @break
              @case('LOST')
              <span class="badge bg-label-warning me-2">{{ $probono->status }}</span>
              @break
              @default
              <span class="badge bg-label-danger me-2">{{ $probono->status }}</span>
              @endswitch

            </td>
            <td>
              {{ \Carbon\Carbon::parse($probono->hearing_date)->locale('fr')->format('F j, Y') }}
            </td>
            <td>
              <a href="javascript:" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                data-bs-target="#addNewAddress{{ $probono->id }}">Edit </a>
              <a href="javascript:" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                data-bs-target="#delete{{ $probono->id }}">Delete</a>
              <div class="modal modal-top fade" id="delete{{ $probono->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <form action="{{ route('probono.delete') }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="probono" value="{{ $probono->id }}" />
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Are you sure to delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Add New Address Modal -->
              <div class="modal fade" id="addNewAddress{{ $probono->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                  <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-4">
                        <h3 class="address-title mb-2">Edit Probono Case</h3>
                        <p class="text-muted address-subtitle">change New Probono case Desciption in case you make
                          mistakes </p>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                        @endif

                      </div>
                      <form action="{{ route('probono.update') }}" class="row g-3" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $probono->id }}">
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="name">First Name</label>
                          <input required type="text" name="fname" class="form-control" value="{{ $probono->fname }}" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="email">Last name</label>
                          <input required type="text" name="lname" class="form-control" value="{{ $probono->lname }}" />
                        </div>

                        <div class="col-12 col-md-6">
                          <label class="form-label" for="gender">Gender</label>
                          <select required id="gender" name="gender" class="form-select">
                            <option value="{{ $probono->gender }}" selected>{{ $probono->gender }}</option>
                            <option @if(old('gender')=="Male" ) selected @endif value="Male">Male</option>
                            <option @if(old('gender')=="Male" ) selected @endif value="Female">Female</option>
                          </select>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="email">Age</label>
                          <input required type="number" min="1" max="170" name="age" class="form-control"
                            value="{{ $probono->age }}" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="phone">Phone Number</label>
                          <div class="input-group">
                            <span class="input-group-text">RW (+25)</span>
                            <input type="text" 
                              name="phone" class="form-control edit_phone" minlength="10" maxLength="10"
                              value="{{ $probono->phone }}" />
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="email">Referral Case No</label>
                          <input required type="text" name="referral_case_no" class="form-control"
                            value="{{ $probono->referral_case_no }}" />
                        </div>

                        <div class="col-12 col-md-6">
                          <label class="form-label" for="email">Jurisdiction</label>
                          <input required type="text" name="jurisdiction" class="form-control"
                            value="{{ $probono->jurisdiction }}" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="phone">Court</label>
                          <div class="input-group">
                            <input required type="text" id="phone" name="court" class="form-control phone-number-mask"
                              value="{{ $probono->court }}" />
                          </div>
                        </div>

                        <div class="col-12 col-md-6">
                          <label class="form-label" for="category">Case nature</label>
                          <select required name="case_nature" class="form-select">
                            <option value="{{ $probono->case_nature }}" selected>{{ $probono->case_nature }}</option>
                            <option @if(old('nature')=="Criminal" ) selected @endif value="Criminal">Criminal</option>
                            <option @if(old('nature')=="Civil" ) selected @endif value="Civil">Civil</option>
                            <option @if(old('nature')=="Social" ) selected @endif value="Social">Social</option>
                            <option @if(old('nature')=="Commercial" ) selected @endif value="Commercial">Commercial
                            </option>
                          </select>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="flatpickr-date">Hearing Day</label>
                          <input required type="text" class="form-control date1" name="hearing_date"
                            class="form-control" value="{{ $probono->hearing_date }}" />
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="status">Category</label>
                          <select required id="status" name="category" class="form-select">
                            <option value="{{ $probono->category }}" selected> {{ $probono->category }} </option>
                            <option @if(old('category')=="Case Agaist RBA" ) selected @endif value="Case Agaist RBA">
                              Case Agaist RBA
                            </option>
                            <option @if(old('category')=="Legal Aid to General Public" ) selected @endif
                              value="Legal Aid to General Public">Legal Aid to General Public</option>
                            <option @if(old('category')=="Minors" ) selected @endif value="Minors">Minors</option>
                            <option @if(old('category')=="Supreme count" ) selected @endif value="Supreme count">Supreme
                              count
                            </option>
                            <option @if(old('category')=="Count" ) selected @endif value="count">Count</option>
                            <option @if(old('category')=="Prosecutor" ) selected @endif value="Prosecutor">Prosecutor
                            </option>
                            <option @if(old('category')=="Police" ) selected @endif value="Police">Police</option>
                            <option @if(old('category')=="Prison" ) selected @endif value="Prison">Prison</option>
                            <option @if(old('category')=="Other" ) selected @endif value="Other">Other</option>
                          </select>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="practicing">Referrel Name</label>
                          <input required type="text" name="referrel" class="form-control"
                            value="{{ $probono->referrel }}" />
                        </div>
                        <div class="col-6 col-md-12">
                          <label class="form-label" for="collapsible-state">Advocate</label>
                          <select name="advocate" class="select2 form-select" data-allow-clear="true">
                            <option value="">No Advocate Assigned</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if ($user->id == $probono->advocate) selected @endif>
                              {{ $user->name }} </option>
                            @endforeach

                          </select>
                        </div>
                      </div>
                       

                        <div class="col-12 text-center">
                          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Add New Address Modal -->
            </td>
          </tr>
          <tr>
            <td>
              <i class="menu-icon tf-icons ti ti-gavel"></i>
            </td>
            <td colspan="3">
              <h6 class="text-warning">
                You can upload defferent documents regarding this case for advocate

              </h6>

            </td>
            <td colspan="3">
              <a href="{{ route('probono.show' , $probono->id) }}" type="button"
                class="btn btn-sm btn-label-secondary text-nowrap d-inline-block">
                Upload files
                <span class="badge bg-danger text-white badge-notifications">{{ $probono->probono_files }}</span>
              </a>
            </td>
            <td>
              <a href="javascript:" data-bs-toggle="modal" data-bs-target="#addNewCCModal{{ $probono->id }}"
                class="btn btn-info btn-sm">Upload </a>
              <!-- Add New Credit Card Modal -->
              <div class="modal fade" id="addNewCCModal{{ $probono->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-md modal-simple modal-add-new-cc">
                  <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-4">
                        <h3 class="mb-2">Upload Document Related to RC</h3>
                        <p class="text-muted">{{ $probono->referral_case_no }}</p>

                      </div>
                      <form class="row g-3" method="POST" action="{{ route('probono.file_store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="probono_id" value="{{ $probono->id }}">
                        <div class="col-12">
                          <label class="form-label w-100" for="title">File title</label>
                          <div class="input-group input-group-merge">
                            <input id="title" name="case_title" class="form-control" type="text"
                              placeholder="File title" value="{{ old('case_title') }}" />
                            @error('case_title')<span class="text-danger">
                              {{ $message }}
                            </span>@enderror
                          </div>
                        </div>
                        <div class="col-12">
                          <label class="form-label w-100" for="type">File Type</label>
                          <div class="input-group input-group-merge">
                            <select required name="case_type" class="form-select">
                              <option value="" selected> - Select - </option>
                              <option @if(old('case_type')=="Letter" ) selected @endif value="Letter">Letter</option>
                              <option @if(old('case_type')=="Assignation" ) selected @endif value="Assignation">
                                Assignation</option>
                              <option @if(old('case_type')=="Imyanzuro" ) selected @endif value="Imyanzuro">Imyanzuro
                              </option>
                              <option @if(old('case_type')=="Icyemezo" ) selected @endif value="Icyemezo">Icyemezo
                              </option>
                              <option @if(old('case_type')=="Evidances" ) selected @endif value="Evidances">Evidances
                              </option>
                              <option @if(old('case_type')=="Other" ) selected @endif value="Other">Other</option>
                            </select>
                            @error('case_type')<span class="text-danger">
                              {{ $message }}
                            </span>@enderror
                          </div>
                        </div>
                        <div class="col-12">
                          <label class="form-label w-100" for="title">Case File <span class="text-danger">
                              Upload Only PDF File </span></label>
                          <div class="input-group input-group-merge">
                            <input accept=".pdf" name="case_file" class="form-control" type="file" />
                            @error('case_file')<span class="text-danger">
                              {{ $message }}
                            </span>@enderror
                          </div>
                        </div>

                        <div class="col-12 text-center">
                          <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                          <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Add New Credit Card Modal -->
            </td>
          </tr>
          <tr>
            <td>
              <i class="menu-icon tf-icons ti ti-gavel"></i>
            </td>
            <td colspan="6">
              @php
                  $participants = ProbonoParticipant::where('probono_id',$probono->id)->count();
              @endphp
              @if ($participants == 0)
           
              <h6 class="text-danger">
                Please assign this case to an advocate via Edit 
              </h6>
              @else
              @php
                  $user = ProbonoParticipant::where('probono_id',$probono->id)->first();
              @endphp
              <h6 class="text-primary">
                 Case Assigned to  
                 <a href="{{ route('profile', $user->user_id) }}"
                  class="text-dark">{{ $user->user->name }}</a>
                <a href="javascript:" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                  data-bs-target="#notify{{ $probono->id }}"> Notify </a>

                  <div class="modal fade" id="notify{{ $probono->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                      <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                          <form method="POST" class="row g-3" action="{{ route('probono.followup_notify') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="phone" value="{{ $probono->phone }}">
                            <input type="hidden" name="advocate" value="{{ $probono->advocate }}">

                            <div class="col-12">
                              <div class="form-check">
                                <input class="form-check-input" name="refferal" type="checkbox" value="1"
                                  id="defaultChe" />
                                <label class="form-check-label" for="defaultChe">Include Refferal (Only for SMS)
                                </label>
                              </div>
                            </div>
    
                            <div class="col-12">
                              <label class="switch">
                                <span class="switch-label">Subject <span class="text-danger">include in Email
                                    only</span></span>
                              </label>
                              <input required type="text" name="subject" class="form-control" id="subject"
                                value="">
    
                            </div>
                            <div class="col-12">
                              <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                              <textarea required name="message" class="form-control" id="exampleFormControlTextarea1"
                                rows="3">
                              </textarea>
                            </div>
                            <div class="col-6">
                              <div class="form-check">
                                <input class="form-check-input" name="sent[]" type="checkbox" value="SMS"
                                  id="defaultCheck3" />
                                <label class="form-check-label" for="defaultCheck3">SMS (Uncheck if "NO")
                                </label>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-check">
                                <input class="form-check-input" checked name="sent[]" type="checkbox" value="EMAIL"
                                  id="defaultCheck4" />
                                <label class="form-check-label" for="defaultCheck4">EMAIL (Uncheck if "NO")
                                </label>
                              </div>
                            </div>
                            <div class="col-12">
                              <label class="switch mb-2">
                                <span class="switch-label text-warning">Attache files (5 Max):</span>
                              </label>
    
                              <input type="file" name="attachments[]" class="form-control" placeholder="Files" multiple
                                max="5">
                            </div>
                            <div class="col-12 text-center">
                              <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                              <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
            
              </h6>
              @endif

            </td>
            <td>
              @unless ($participants == 0)
                <a href="{{ route('probono.show_devs' , $probono->id) }}" type="button"
                class="btn btn-sm btn-label-secondary text-nowrap d-inline-block">
                Reported Events
                <span class="badge bg-danger text-white badge-notifications">{{ $probono->probono_devs }}</span>
              </a>
              @endunless
             
              
            
            </td>

          </tr>

        </tbody>

        @php
        $count++
        @endphp
        @empty
        <tbody>
          <tr>

            <td colspan="3">
              <h6 class="text-warning">
                Empy No Probono Founds Case

              </h6>

            </td>

          </tr>

        </tbody>
        @endforelse

      </table>
    </div>
  </div>

</div>



<!-- New User Modal -->
<div class="modal fade" id="newCase" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2">New Probono Case</h3>

        </div>
        <form accept="{{ route('probono.store') }}" class="row g-3" method="post" enctype="multipart/form-data">
          @csrf

          <div class="col-12 col-md-6">
            <label class="form-label" for="name">First Name</label>
            <input required type="text" name="fname" class="form-control" placeholder="John"
              value="{{ old('fname') }}" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="email">Last name</label>
            <input required type="text" name="lname" class="form-control" placeholder="doe"
              value="{{ old('lname') }}" />
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label" for="gender">Gender</label>
            <select required id="gender" name="gender" class="form-select">
              <option value="" selected> - Select - </option>
              <option @if(old('gender')=="Male" ) selected @endif value="Male">Male</option>
              <option @if(old('gender')=="Male" ) selected @endif value="Female">Female</option>
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="email">Age</label>
            <input required type="number" min="1" max="170" name="age" class="form-control" placeholder="Age"
              value="{{ old('age') }}" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="phone">Phone Number</label>
            <div class="input-group">
              <span class="input-group-text">RW (+25)</span>
              <input type="text" name="phone" id="add_phone"
                class="form-control phone-number-mask" minlength="10" maxLength="10" placeholder="xxx xxx xxxx"
                value="{{ old('phone') }}" />
            </div>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="email">Referral Case No</label>
            <input required type="text" name="referral_case_no" class="form-control"
              placeholder="RC 0004B77/2022/TB/009" value="{{ old('referralcaseno') }}" />
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label" for="email">Jurisdiction</label>
            <input required type="text" name="jurisdiction" class="form-control" placeholder="Jurisdiction"
              value="{{ old('referralcaseno') }}" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="phone">Court</label>
            <div class="input-group">
              <input required type="text" id="phone" name="court" class="form-control"
                placeholder="Court Name" value="{{ old('court') }}" />
            </div>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label" for="category">Case nature</label>
            <select required name="case_nature" class="form-select">
              <option value="" selected> - Select - </option>
              <option @if(old('nature')=="Criminal" ) selected @endif value="Criminal">Criminal</option>
              <option @if(old('nature')=="Civil" ) selected @endif value="Civil">Civil</option>
              <option @if(old('nature')=="Social" ) selected @endif value="Social">Social</option>
              <option @if(old('nature')=="Commercial" ) selected @endif value="Commercial">Commercial</option>
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="flatpickr-date">Hearing Day</label>
            <input required type="text" class="form-control" id="date" name="hearing_date" placeholder="Month DD, YYYY"
              class="form-control" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="status">Category</label>
            <select required id="status" name="category" class="form-select">
              <option value="" selected> - Select - </option>
              @foreach ($categories as $category)
                <option @if(old('category')== $category->name ) selected @endif value="{{ $category->name }}">{{ $category->name }}
              </option>  
              @endforeach
            </select>
            
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="practicing">Referrel Name</label>
            <input required type="text" name="referrel" class="form-control" placeholder="Referrel Name"
              value="{{ old('referrel') }}" />
          </div>
          {{-- <div class="col-12 col-md-12">
            <div class="form-check">
              <input class="form-check-input" name="status" type="checkbox" value="1" id="defaultCheck2" />
              <label class="form-check-label" for="defaultCheck2">
                Auto Assign to Advocate ? (Uncheck if "NO")
              </label>
            </div>
          </div> --}}

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
              aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ New User Modal -->
<!-- / Content -->

@endsection


@section('css')

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />

@endsection

@section('js')

<!-- Vendors JS -->

<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<!-- Page JS -->
<script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script>
  "use strict";
  $(function () {
    var dtt = document.querySelector("#date"),
      dte = document.querySelector("#end");
    dtt && dtt.flatpickr({
      enableTime: false,
      altInput: !0,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
    })
    dte && dte.flatpickr({
      enableTime: !0,
      noCalendar: !0
    })
  })
  $(function () {
    var dtt1 = document.querySelectorAll(".date1"),
      dte1 = document.querySelectorAll(".end1");
    dtt1 && dtt1.flatpickr({
      enableTime: false,
      altInput: !0,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
    })
    dte1 && dte1.flatpickr({
      enableTime: !0,
      noCalendar: !0
    })
  })

  $(document).ready(function () {
    $("#add_phone").on("input", function () {
      var value = $(this).val();
      var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
      if (!decimalRegex.test(value)) {
        $(this).val(value.substring(0, value.length - 1));
      }
    });
    $(".edit_phone").on("input", function () {
      var value = $(this).val();
      var decimalRegex = /^[0-9]+(\.[0-9]{1,2})?$/;
      if (!decimalRegex.test(value)) {
        $(this).val(value.substring(0, value.length - 1));
      }
    });
  });

</script>

@endsection
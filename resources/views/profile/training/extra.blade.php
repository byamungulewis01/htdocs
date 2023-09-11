<div class="card invoice-preview-card mb-2">
    <div class="card-body">
        <h5>Trainings Archives </h5>
        <div class="card-datatable table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 3px;">#</th>
                        <th>Training</th>
                        <th>Attandance day</th>
                    </tr>
                </thead>
                @php
                $count = 1;
                @endphp
                @forelse ($attendances as $attendance)
                <tbody>
                    <tr>
                        <td>{{ $count }}</td>
                        <td>
                            @php
                        $title = Str::words($attendance->trains->title, 2, ' ...');
                        @endphp
                            
                            <strong>{{ $title }}</strong>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($attendance->attendanceDay)->locale('fr')->format('F j, Y') }}
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

                        </td>
                        <td>
                            There is no Attandance list
                        </td>
                    </tr>
                </tbody>
                @endforelse

            </table>
            <div class="col-lg-4">
                <div class="demo-inline-spacing mr-2">
                    <a href="{{ route('user.training-archive',$user_id) }}" class="text-decoration-underline text-muted">View more</a>                   
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-2">
    <div class="card-body">
        <h5>Extra CLE
            <a class="btn btn-sm btn-dark text-white pull-left float-end" data-bs-toggle="modal"
                data-bs-target="#newExtra"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                    class="d-none d-sm-inline-block">New Extra CLE</span></a>

            <div class="modal fade" id="newExtra" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="mb-2">New Extra CLE </h3>
                            </div>
                            <form method="POST" class="row g-3" action="{{ route('add.extraCle') }}">
                                @csrf
                                <input type="hidden" name="user" value="{{ $user_id }}">
                                <div class="col-12">
                                    <label class="form-label">Training Title</label>
                                    <input required type="text" name="title" class="form-control" placeholder="Title" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Training closing date</label>
                                    <input required type="date" name="closing_date" class="form-control" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Category</label>
                                    <select required name="category" class="form-select" id="">
                                        <option value="CLE">CLE</option>
                                        <option value="Publication">Publication</option>
                                        <option value="Legal Workshop">Legal Workshop</option>
                                        <option value="Meeting (Credit)">Meeting (Credit)</option>
                                        <option value="Lecture">Lecture</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Approved Hours</label>
                                    <input required type="number" min="0" name="hours" class="form-control"
                                        placeholder="Approved Hours" />
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </h5>
        <div class="card-datatable table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 3px;">#</th>
                        <th>Title (Category)</th>
                        <th>Hours</th>
                        <th>Credits</th>
                        <th></th>
                    </tr>
                </thead>
                @php
                $count = 1;
                $hours = 0;
                $credits = 0;
                @endphp
                @forelse ($extraCles as $extraCle)
                <tbody>
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $extraCle->title }}
                        <span class="text-muted">({{ $extraCle->category }})</span>
                        
                        </td>
                        <td>{{ $extraCle->hours }}</td>
                        <td>{{ $extraCle->credits }}</td>
                        <td> <a href="" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#delete{{ $extraCle->id }}"><i class='ti-xs ti ti-trash me-1'></i></a>
                            <div class="modal modal-top fade" id="delete{{ $extraCle->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('remove.extraCle') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="yearInBar" value="{{ $extraCle->yearInBar }}">
                                            <input type="hidden" name="credits" value="{{ $extraCle->credits }}">
                                            <input type="hidden" name="user" value="{{ $user_id }}">
                                            <input type="hidden" name="id" value="{{ $extraCle->id }}" />
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
                $hours += $extraCle->hours;
                $credits += $extraCle->credits;
                $count++
                @endphp
                @empty
                <tr>
                    <td></td>
                    <td colspan="4">No Extra Continues Legal Education</td>
                </tr>
                @endforelse
                <tfoot>
                    <th colspan="2">Total</th>
                    <th>{{ $hours }}</th>
                    <th>{{ $credits }}</th>
                </tfoot>


            </table>
            
        </div>
        <div class="col-lg-4">
            <div class="demo-inline-spacing mr-2">
                <a href="{{ route('user.training-extra',$user_id) }}" class="text-decoration-underline text-muted">View more</a>                   
            </div>
        </div>
    </div>
</div>
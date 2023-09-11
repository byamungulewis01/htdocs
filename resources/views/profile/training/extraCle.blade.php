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
                    <h5>{{ $name }}'s Extra Cles </h5>
                </div>
                <div class="card-body">
                    <div class="card-datatable table-responsive border-top">
                        <table class="datatables table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Hours</th>
                                    <th>Credits</th>
                                    <th>Closing Date</th>
                                </tr>
                            </thead>                          
                        </table>
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
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('js')
<script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

<script>
    $(document).ready(function () {

$('.datatables').DataTable({
    
    ajax: "{{ env('APP_URL') }}/api/trainings_extra/{{ $user_id }}",
    columns: [
        { data: '' },
        { data: 'title' },
        { data: 'category' },
        { data: 'hours' },
        { data: 'credits' },
        { data: 'closing_date' },
    ],

    columnDefs: [{targets: 0,
            render: function (data, type, row, meta) {
             return meta.row + meta.settings._iDisplayStart + 1;
            }
            },],
        order:[],});
});
</script>

@endsection
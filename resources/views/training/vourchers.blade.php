<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
        integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- Core CSS -->
    <style>
        @page { size: portrait; }
    </style>

</head>

<body>
    <div class="row">
        @forelse ($vouchers as $voucher)
        <div class="col-md-4 p-2 m-2 border w-50">
            <h6 class="fw-semibold">RWANDA BAR ASSOCIATION (R.B.A)</h6>
            <span class="fw-semibold"><u>ATTENDANCE VOUCHER</u></span>
            <div class="pt-1">
                <span>Date:</span>
                <span class="fw-semibold">{{ $voucher->attendanceDay }}</span>
            </div>
            <div class="pt-1">
                <span>Vouncher Number:</span>
                <span class="fw-semibold">{{ $voucher->voucherNumber }}</span>
            </div>
            <div class="pt-1">
                <span>Trainee:</span>
                <span class="fw-semibold">{{ $voucher->user->name }}</span>
            </div>
        </div>
        @empty
        <h6>Empty </h6>
        @endforelse

    </div>
</body>

</html>
@component('mail::message')
# Welcome to {{ config('app.name') }}

Your new RBA MIS account have been created, credential are:

Email: {{ $email }} <br>
Password: {{ $password }}

{{ config('app.name') }}
@endcomponent

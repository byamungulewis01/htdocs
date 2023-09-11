@component('mail::message')
# Welcome to {{ config('app.name') }}

This is to inform you that an account have been created in RBA MIS under your  organization's name and email.

Credential to be used while accessing your account are:

Email: {{ $email }}
Password: {{ $password }}

<br>
{{ config('app.name') }}
@endcomponent

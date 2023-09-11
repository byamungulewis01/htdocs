@component('mail::message')
# Hello,

We are glad to let you know that your email in RBA MIS account have been changed.
From now, you shall use this new email to log in but the password remain the same, no changes.

Your New credentials are:
Email: {{ $email }}
Password: your previous password
<br>
{{ config('app.name') }}
@endcomponent

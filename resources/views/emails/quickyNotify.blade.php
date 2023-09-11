@component('mail::message')
Dear Adv. <b>{{ $name }}</b>

This message serves to inform you that the link
to access RBA MIS have been changed, you will be 
accessing the system using the new link through 
http://rbamis.rwandabar.rw/

Your user name is <b>{{ $email }}</b> <br>
Password: {{ $password }}

Kind regards<br>

@endcomponent

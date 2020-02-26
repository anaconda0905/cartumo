@component('mail::message')
# Thank you for your Register
Hi, {{ $content['name'] }}
<p>Please login through below link.</p>
<p><a href="https://cartumo.io/login">Please click on this link to Login.</a></p> <br />


Thanks,<br>
{{ config('app.name') }} Team
@endcomponent

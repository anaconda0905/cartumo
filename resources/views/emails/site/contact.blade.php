@component('mail::message')
# Introduction

<h5>{{ $content['name'] }}</h5>
<p>{{ $content['email'] }}</p>
<p>{{ $content['phone'] }}</p> <br />
{{ $content['body'] }}


<br>Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# hi {{$content['name']}}

Diese Nachricht kommt von resources\views\emails\mailpdf.blade.php

Thanks,<br>
{{ config('app.name') }}
@endcomponent
@component('mail::layout')

{!!$message!!}

<br>
If you have any question, please contact us at 
<br>

Cheers,<br>
{{ config('app.name') }}

@slot('header')
    @component('mail::header', ['url' => 'https://celebshare.getslurp.com'])
        <img src="{{ asset('/img/project_logo.png') }}" width="200px" />
    @endcomponent
@endslot

@slot('footer')
    @component('mail::footer')
        © {{ date('Y') .  ' ' . config('app.name') }}. All rights reserved.
    @endcomponent
@endslot
@endcomponent
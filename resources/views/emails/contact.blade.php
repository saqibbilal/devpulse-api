@component('mail::message')
    # New Portfolio Message

    **From:** {{ $name }} ({{ $email }})

    **Message:** {{ $body }}

    @component('mail::button', ['url' => 'mailto:' . $email])
        Reply to {{ $name }}
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

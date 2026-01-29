<x-mail::message>
    # New Inquiry from {{ $name }}

    You have received a new message through your portfolio contact form.

    **From:** {{ $name }} ({{ $email }})

    **Message:**
<x-mail::panel>
{{ $message_body }}
</x-mail::panel>
<x-mail::button :url="'mailto:' . $email">
Reply to {{ $name }}
</x-mail::button>
Best regards,<br>
{{ config('app.name') }}
</x-mail::message>

@component('mail::message')
    # New Contact Form Submission

    **Name:** {{ $formData['name'] }}
    **Email:** {{ $formData['email'] }}

    **Message:** {{ $formData['message'] }}

@endcomponent

@component('mail::message')
# Reset Password

To reset your password, click this link.

@component('mail::button', ['url' => url('password/reset/'.$token)'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

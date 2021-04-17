@component('mail::message')
# Reset Password

To reset your password, click below link.

@component('mail::button', ['url' => url('password/reset/'.$token)])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

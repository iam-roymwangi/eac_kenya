<x-mail::message>
# Welcome to EAC Kenya, {{ $user->name }}

Your company account has been successfully registered on our platform. 

Here are your login credentials to access the client dashboard:

**Email Address:** {{ $user->email }}<br>
**Temporary Password:** {{ $password }}

*We strongly recommend changing this password upon your first login.*

<x-mail::button :url="url('/login')">
Login to Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

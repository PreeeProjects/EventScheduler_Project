<x-mail::message>
    {{-- Greeting --}}
    # 👋 Hello {{ $user->first_name ?? 'there' }}!

    {{-- Intro Lines --}}
    Thanks for signing up! To complete your registration, please verify your email address by clicking the button below.

    {{-- Action Button --}}
    @isset($actionText)
        <x-mail::button :url="$actionUrl" color="success">
            {{ $actionText }}
        </x-mail::button>
    @endisset

    {{-- Outro Lines --}}
    Once your email is verified, you’ll be able to log in and access your dashboard.

    If you didn’t create an account, no further action is required.

    {{-- Salutation --}}
    Thanks again!<br>
    {{ config('app.name') }} Team

    {{-- Subcopy --}}
    @isset($actionText)
        <x-slot:subcopy>
            If you're having trouble clicking the **"{{ $actionText }}"** button, copy and paste the URL below into your web
            browser:
            [{{ $displayableActionUrl }}]({{ $actionUrl }})
        </x-slot:subcopy>
    @endisset
</x-mail::message>

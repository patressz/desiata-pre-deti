@component('mail::message')
# Dobrý deň, {{ $user->name }}

Ďakujeme, že využívate naše služby. Toto je faktúra za váš nedávny nákup.

@component('mail::panel')
    Bolo Vám pridelených <strong>{{ $session->amount_total * 0.01 }}</strong> kreditov.
@endcomponent

@component('mail::table')
    | Číslo objednávky {{ $payment->id }} | {{ now()->format('d.m.Y H:i:s') }} |
    | :------------ |--------------:|
    | Kredit        | {{ $session->amount_total * 0.01 }} &euro; |
    ||Celkom <strong>{{ $session->amount_total * 0.01 }} &euro;</strong> |
@endcomponent

Ďakujeme,<br>
{{ config('app.name') }}
@endcomponent

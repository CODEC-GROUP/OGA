<x-mail::message>
# OGA-new contact request

<strong>you have been contacted by a user</strong>

- Name : {{ $data['name'] }}
- Email : {{ $data['email'] }}

**Message :**<br>
{{ $data['subject'] }}


</x-mail::message>

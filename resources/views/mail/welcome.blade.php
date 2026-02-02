<x-mail::message>
{{$message}}
<x-mail::button :url="route('mail')">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

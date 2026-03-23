@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@php $emailLogo = \App\Models\SiteSetting::getByKey('site_logo'); @endphp
@if ($emailLogo)
<img src="{{ url('storage/' . $emailLogo) }}" class="logo" alt="{{ config('app.name') }} Logo" style="max-height: 50px;">
@elseif (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo-v2.1.png" class="logo" alt="Laravel Logo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>

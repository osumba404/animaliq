<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">
@php $emailLogo = \App\Models\SiteSetting::getByKey('site_logo'); @endphp
@if ($emailLogo)
<div style="margin-bottom: 10px;">
<img src="{{ url('storage/' . $emailLogo) }}" alt="{{ config('app.name') }} Logo" style="max-height: 30px;">
</div>
@endif
{{ Illuminate\Mail\Markdown::parse($slot) }}
</td>
</tr>
</table>
</td>
</tr>

@extends('emails.layout')
@section('content')
<h2 style="color:#FF7518;margin:0 0 8px;">{{ $monthLabel }} Leaderboard</h2>
<p style="margin:0 0 16px;">Hi {{ $recipient->first_name }}, here are the most active Animal IQ members for <strong>{{ $monthLabel }}</strong>.</p>

<div style="background:#fff8f3;border-radius:10px;padding:16px;margin-bottom:20px;border:2px solid #FF7518;">
    <p style="margin:0 0 4px;font-size:12px;text-transform:uppercase;color:#888;letter-spacing:1px;">Most Active Member</p>
    <p style="margin:0;font-size:20px;font-weight:700;color:#FF7518;">{{ $winner->first_name }} {{ $winner->last_name }}</p>
    <p style="margin:4px 0 0;color:#555;">{{ $winnerPoints }} points</p>
</div>

<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin-bottom:24px;">
    <thead>
        <tr style="background:#FF7518;color:#fff;">
            <th style="padding:10px 12px;text-align:left;font-size:13px;">Rank</th>
            <th style="padding:10px 12px;text-align:left;font-size:13px;">Member</th>
            <th style="padding:10px 12px;text-align:right;font-size:13px;">Points</th>
        </tr>
    </thead>
    <tbody>
        @foreach($topUsers as $row)
        <tr style="background:{{ $loop->odd ? '#fff' : '#fdf6f0' }}">
            <td style="padding:10px 12px;font-weight:700;color:{{ $row['rank'] <= 3 ? '#FF7518' : '#333' }}">
                {{ $row['rank'] <= 3 ? ['🥇','🥈','🥉'][$row['rank']-1] : '#'.$row['rank'] }}
            </td>
            <td style="padding:10px 12px;">{{ $row['name'] }}</td>
            <td style="padding:10px 12px;text-align:right;font-weight:600;">{{ $row['points'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p style="color:#555;font-size:14px;">Keep engaging — reading articles, joining forum discussions, registering for events, and donating — to climb the leaderboard next month!</p>
<a href="{{ config('app.url') }}/leaderboard" style="display:inline-block;background:#FF7518;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;margin-top:8px;">View Full Leaderboard</a>
@endsection

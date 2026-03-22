<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /** Bell popup: 8 most recent, unread count */
    public function recent()
    {
        $user    = auth()->user();
        $recent  = Notification::where('user_id', $user->id)->latest()->take(8)->get();
        $unread  = Notification::where('user_id', $user->id)->whereNull('read_at')->count();
        return response()->json(['notifications' => $recent, 'unread' => $unread]);
    }

    /** Full notifications page */
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->paginate(20);
        return view('public.notifications.index', compact('notifications'));
    }

    /** Mark one as read */
    public function markRead(Notification $notification)
    {
        abort_if($notification->user_id !== auth()->id(), 403);
        $notification->update(['read_at' => now()]);
        return response()->json(['ok' => true]);
    }

    /** Mark all as read */
    public function markAllRead()
    {
        Notification::where('user_id', auth()->id())->whereNull('read_at')->update(['read_at' => now()]);
        return response()->json(['ok' => true]);
    }
}

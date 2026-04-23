<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumPost;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = ForumPost::with('user')->withCount(['likes', 'bookmarks', 'comments'])->latest();

        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('body', 'like', '%' . $search . '%');
            });
        }

        $posts = $query->paginate(25)->withQueryString();
        return view('admin.forum.index', compact('posts'));
    }

    public function destroy(ForumPost $forum)
    {
        if ($forum->image) \App\Services\ImageService::delete($forum->image);
        $forum->delete();
        return back()->with('success', 'Forum post deleted.');
    }
}

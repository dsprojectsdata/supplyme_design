<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CcgFeed;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function addlike(Request $request)
    {
        if ($request->type == 'comment') {
            $attach = Comment::find($request->id);
        } else {
            $attach = CcgFeed::find($request->id);
        }
        $like = $attach->likes()->where('user_id', Auth::id())->first();
        if ($like) {
            $like->likeable->decrement('like_count');
            $like->delete();
        } else {
            $like = $attach->likes()->create(['user_id' => Auth::id()]);
            $like->likeable->increment('like_count');
        }

        $attach = $attach->fresh();

        return response()->json(['message' => '', 'status' => SUCCESS, 'data' => convertCount($attach->like_count)]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CcgFeed;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CcgFeed $ccgFeed)
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        if (!empty($input['comment'])) {
            // Save Comment
            $latestCcgFeed = CcgFeed::find($input['ccg_feed_id']);
            if (!$latestCcgFeed) {
                return response(['status' => FAIL, 'message' => 'This feed does not exist'], 404);
            }
            $post_comment = new Comment();
            $post_comment->user_id = Auth::user()->id;
            $post_comment->comment = $input['comment'];
            $post_comment->parent_id = $input['comment_id'] ?? null;
            $post_comment->commentable()->associate($latestCcgFeed);
            $post_comment->company_id = Auth::user()->company_id;

            if ($post_comment->save()) {
                $comment = Comment::find($post_comment->id);
                $comment->commentable->increment('comment_count');
                $html = view('components.admin.comment.comment', compact('comment'))->render();

                return response(
                    [
                        'status' => SUCCESS,
                        'message' => 'Comment added successfully',
                        'data' => $html,
                        'count' => convertCount($comment->commentable->comment_count)
                    ],
                    200
                );
            } else {
                return response(['status' => FAIL, 'message' => 'Some error occurred in adding the comment'], 400);
            }
        } else {
            return response(['status' => FAIL, 'message' => 'Please add something'], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
        $comment->childComments()->delete();
        if ($comment->delete()) {
            return response()->json(['status' => SUCCESS, 'message' => 'Comment deleted successfully'], 200);
        }

        return response()->json(['status' => FAIL, 'message' => 'Comment could not be deleted'], 200);
    }
}

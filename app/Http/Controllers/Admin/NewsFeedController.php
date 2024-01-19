<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsFeed;
use App\Models\Follows;
use App\Models\FeedLike;
use App\Models\Company;
use App\Models\FeedComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class NewsFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
        // Auth User Post
        $user_id = Auth::user()->id;
        $user = Auth::user();
        $company = Company::with('user')->where('id', $user->company_id)->first();
        $posts = NewsFeed::where('user_id', $user_id)->where('company_id', $company->id)->get();

        // following Post
        $follow = Follows::where('user_id', $user_id)->where('company_id', $company->id)->where('status', '1')->pluck('follow_id')->toArray();
        $follow_companies = Company::whereIn('id', $follow)->with('user:id')->get();

        $follow_companyIds = [];
        $follow_userIds = [];

        foreach ($follow_companies as $follow_company) {
            $follow_companyIds[] = $follow_company->id;
            $follow_userIds[] = $follow_company->user->id;
        }

        $follow_posts = NewsFeed::whereIn('user_id', $follow_userIds)->whereIn('company_id', $follow_companyIds)->get();
        

        // Company Category Post
        $companyCategory = explode(',', $company->company_category);
        
        $sameCategoryCompanies = Company::with('user')->where('id', '!=', $company->id)
                ->where(function ($query) use ($companyCategory) {
                    foreach ($companyCategory as $category) {
                        $query->orWhere('company_category', 'like', '%' . $category . '%');
                    }
            })
            ->get();
            $follow_CategorycompanyIds = [];
            $follow_CategoryuserIds = [];

            foreach ($sameCategoryCompanies as $sameCategoryCompanie) {
                $follow_CategorycompanyIds[] = $sameCategoryCompanie->id;
                $follow_CategoryuserIds[] = $sameCategoryCompanie->user->id?? ' ';
            } 
            $followPostsCategoryCompanies = NewsFeed::whereIn('user_id',$follow_CategoryuserIds)->whereIn('company_id',$follow_CategorycompanyIds)->get();
            
            // All Posts 
            $towPosts = $posts->concat($follow_posts);
            $combined_posts = $towPosts->concat($followPostsCategoryCompanies);
            $sorted_posts = $combined_posts->unique('id')->sortByDesc('created_at');
            return view('Admin.newsfeed.index', compact('sorted_posts','follow_companies'));
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
        // dd($request->all());
        
        $request->validate([
            'image_files.*' => 'image|mimes:jpeg,png,gif',
            'video_files' => 'file|mimes:mp4,avi,mov,wmv',
            'event_files' => 'file|mimes:ics',
        ]);

        $allImages = [];
        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $imageFile) {
                $imagePath = $imageFile->store('images', 'public');
                $allImages[] = 'storage/' . $imagePath;
            }
        }

        $allVideos = [];
        if ($request->hasFile('video_files')) {
            foreach ($request->file('video_files') as $videoFile) {
                $videoPath = $videoFile->store('videos', 'public');
                $allVideos[] = 'storage/' . $videoPath;
           }
        }
        
        $allEvents = [];
        if ($request->hasFile('event_files')) {
            foreach ($request->file('event_files') as $eventFile) {
                $eventPath = $eventFile->store('events', 'public');
                $allEvents[] = 'storage/' . $eventPath;
            }
        }

        $user = Auth::user();
        $company = Company::with('user')->where('id', $user->company_id)->first();
        $post_data = new NewsFeed();
        $post_data->company_id = $company->id;
        $post_data->user_id = $user->id;
        $post_data->description = $request->description ?? NULL;
        $post_data->images = json_encode($allImages);
        $post_data->videos = json_encode($allVideos);
        $post_data->events = json_encode($allEvents);
        $post_data->save();

        return redirect()->route('newsfeed.index')->with('success', 'Post created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function post(Request $request){
        $user_id = Auth::user()->id;
        $user = Auth::user();
        $company = Company::with('user')->where('id', $user->company_id)->first();
        $posts = NewsFeed::where('user_id', $user_id)->where('company_id', $company->id)->get();
        // following Post
        $follow = Follows::where('user_id', $user_id)->where('company_id', $company->id)->where('status', '1')->pluck('follow_id')->toArray();
        $follow_companies = Company::whereIn('id', $follow)->with('user:id')->get();

        $follow_companyIds = [];
        $follow_userIds = [];

        foreach ($follow_companies as $follow_company) {
            $follow_companyIds[] = $follow_company->id;
            $follow_userIds[] = $follow_company->user->id;
        }

        $follow_posts = NewsFeed::whereIn('user_id', $follow_userIds)->whereIn('company_id', $follow_companyIds)->get();
        

        // Company Category Post
        $companyCategory = explode(',', $company->company_category);
        
        $sameCategoryCompanies = Company::with('user')->where('id', '!=', $company->id)
                ->where(function ($query) use ($companyCategory) {
                    foreach ($companyCategory as $category) {
                        $query->orWhere('company_category', 'like', '%' . $category . '%');
                    }
            })
            ->get();
            $follow_CategorycompanyIds = [];
            $follow_CategoryuserIds = [];

            foreach ($sameCategoryCompanies as $sameCategoryCompanie) {
                $follow_CategorycompanyIds[] = $sameCategoryCompanie->id;
                $follow_CategoryuserIds[] = $sameCategoryCompanie->user->id ?? ' ';
            } 
            $followPostsCategoryCompanies = NewsFeed::whereIn('user_id',$follow_CategoryuserIds)->whereIn('company_id',$follow_CategorycompanyIds)->get();
            
            // All Posts 
            $towPosts = $posts->concat($follow_posts);
            $combined_posts = $towPosts->concat($followPostsCategoryCompanies);
            $sorted_posts_data = $combined_posts->unique('id')->sortByDesc('created_at');

            $page = $request->input('page', 1);
            $perPage = 5; 

            $offset = ($page - 1) * $perPage;
            $items = $sorted_posts_data->slice($offset, $perPage);

            $sorted_posts = new LengthAwarePaginator(
                $items,
                count($sorted_posts_data),
                $perPage,
                $page
            );

            $sorted_posts->setPath($request->url());
            $html =  view('Admin.newsfeed.getpost', compact('sorted_posts','follow_companies'))->render();
            echo $html;
    }

    public function following(Request $request,$follow_id)
    {
       $user_id = Auth::user()->id;
       $company = Company::with('user')->where('user_id',$user_id)->first();
       $unFollow = Follows::where('user_id',$user_id)->where('company_id',$company->id)->where('follow_id',$follow_id)->first();
       if($unFollow){
          if($unFollow->status == '1'){
                $unFollow->status = '0';
                $unFollow->update();
                return  redirect()->back()->with('error', 'UnFollow successfully');;
          }
          else{
                $unFollow->status = '1';
                $unFollow->update();
                return  redirect()->back()->with('success', 'Follow successfully');;
          }
            
       }
       else{
            $follows = new Follows();
            $follows->user_id = $user_id;
            $follows->company_id = $company->id;
            $follows->follow_id = $follow_id;
            $follows->status = '1';
            $follows->save();
            return  redirect()->back()->with('success', 'Follow successfully');;
       }   
    }

    public function feedLike(Request $request){
       $feed_id = $request->like_id;
       $feed = NewsFeed::find($feed_id);
       if($feed){
        $user_id = Auth::user()->id;
          $unlike = FeedLike::where('news_feed_id',$feed->id) ->where('user_id',$feed->user_id)->where('company_id',$feed->company_id)->where('like_id',$user_id)->first();
          if($unlike){
                if($unlike->status == '1'){
                    $feed->likes--;
                    $unlike->status = '0';
                    $unlike->update();
                    $feed->update();
                    return response()->json(['status' => 'Unliked']);
                }
                else{
                    $feed->likes++;
                    $unlike->status = '1';
                    $unlike->update();
                    $feed->update();
                    return response()->json(['status' => 'liked']);
                }
          }
          else{
                $feed->likes++;
                $like = new FeedLike ();
                $like->user_id = $feed->user_id;
                $like->company_id = $feed->company_id;
                $like->news_feed_id = $feed->id;
                $like->like_id = $user_id;
                $like->status = '1';
                $like->save();
                $feed->update();
                return response()->json(['status' => 'liked']);
          }
            
       }
       else{
          return  redirect()->back()->with('error', 'Your Feed is Not Right');
       }

    }


    public function foodCommentSubmit(Request $request){
        $postId = $request->post_id;
        $user_id = Auth::user()->id;
        $feed = NewsFeed::find($postId);
        if($feed){
            $comment = new FeedComment ();
            $comment->user_id = $feed->user_id;
            $comment->company_id = $feed->company_id;
            $comment->news_feed_id = $feed->id;
            $comment->comment_id = $user_id;
            $comment->text  = $request->commentText;
            $feed->comment_count++;
            $comment->save();
            $feed->update();
        }

    }

    public function foodCommentGet(Request $request){
        $postId = $request->post_id;
        $user_id = Auth::user()->id;
        $feed = NewsFeed::find($postId);
        
        $comments = FeedComment::orderBy('created_at','Desc')->where('user_id',$feed->user_id)->where('company_id',$feed->company_id)->where('news_feed_id',$feed->id)->get();

        if($comments){
            $html = view('Admin.newsfeed.getComments',compact('comments'))->render();
            echo  $html;
        }
        else{
            $html = ' ';
        }
       

    }

    

    public function commentLike(Request $request){
        $comment_id = $request->comment_id;
        $user_id = Auth::user()->id;
    
        $comment = FeedComment::find($comment_id);
    
            if (!$comment) {
                return response()->json(['status' => 'error', 'message' => 'Comment not found']);
            }
    
        $likes = json_decode($comment->likes, true) ?: [];
    
            if (in_array($user_id, $likes)) {
                $likes = array_diff($likes, [$user_id]);
                $comment->likes = json_encode(array_values($likes));
                $comment->save();
                return response()->json(['status' => 'unliked']);
            } else {
                $likes[] = $user_id;
                $comment->likes = json_encode(array_values($likes));
                $comment->save();
                return response()->json(['status' => 'liked']);
            }
    }

    public function CommentReplySubmit(Request $request){
        $comment_id = $request->comment_id;
        $commentText = $request->commentText;
        $user_id = Auth::user()->id;
    
        $comment = FeedComment::find($comment_id);
        if (!$comment) {
            return response()->json(['status' => 'error', 'message' => 'Comment not found']);
        }
        $commentText2 = json_decode($comment->reply_text, true) ?: [];
        $commentText2 [] = $commentText;
        $likes = json_decode($comment->parent_id, true) ?: [];
        $likes[] = $user_id;
        $comment->parent_id = json_encode(array_values($likes));
        $comment->reply_text =  json_encode(array_values($commentText2)) ;
        $comment->save();
        return response()->json(['status' => 'comment']);

    }


    public function CommentReplyGet(Request $request){
        $comment_id = $request->comment_id;
        $user_id = Auth::user()->id;
        $comments = FeedComment::find($comment_id);
        $replys = json_decode($comments->parent_id);
        $reply_text = json_decode($comments->reply_text);
        $html = view('Admin.newsfeed.getreply',compact('replys','reply_text','comments'))->render();
         return $html;
        
    }


}



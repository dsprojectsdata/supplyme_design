<?php

namespace App\View\Components\Admin;

use App\Models\CcgFeed;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NewsFeed extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $ccg_feeds;

    public function __construct()
    {
        //
        $this->ccg_feeds = CcgFeed::latest('id')->where('user_id', Auth::id())->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.news-feed');
    }
}

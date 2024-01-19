<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class SingleGroupFeed extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $ccg_feed;

    public function __construct($singleGroupFeed)
    {
        //
        $this->ccg_feed = $singleGroupFeed ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.single-group-feed');
    }
}

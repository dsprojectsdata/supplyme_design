<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class SingleFeed extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $ccg_feed;
    public function __construct($feed)
    {
        //
        $this->ccg_feed = $feed ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.single-feed');
    }
}

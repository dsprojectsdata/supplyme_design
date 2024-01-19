<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class GroupDoc extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $conversation;
    
    public function __construct($conversation)
    {
        //
        $this->conversation = $conversation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.group-doc');
    }
}

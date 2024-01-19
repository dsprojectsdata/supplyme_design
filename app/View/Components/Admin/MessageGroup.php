<?php

namespace App\View\Components\Admin;

use App\Models\Group;
use App\Models\RfqDetail;
use Illuminate\View\Component;

class MessageGroup extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $chatGroups;
    public $toOthers;

    public function __construct($message=null, $type=null)
    {
        //
        $rfq = RfqDetail::find($message);
        $query = Group::query();
        if ($type == 'general') {
            $query = $query->whereNull('rfq_id');
        } else {
            $query = $query->whereNotNull('rfq_id');
        }
        if ($message && $type == 'rfq') {

            $query = $query->where('rfq_id', $message);
            if ($rfq->user_id != auth()->id()) {
                $query = $query->whereHas('users', function ($q) {
                    return $q->where('user_id', '=', auth()->id());
                });
            }
        } else {
            $query = $query->whereHas('users', function ($q) {
                return $q->where('user_id', '=', auth()->id());
            });
        }


        $this->chatGroups =$query->get();
        
        $this->toOthers = false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.message-group');
    }
}

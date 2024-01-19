<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use App\Models\QuestionnaireResponse;

class QuestionnairAnswer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $questionnaireResponse;

    public function __construct($questionnairId, $supplierId)
    {
        //
        $this->questionnaireResponse = QuestionnaireResponse::where(
            [
                'company_id' => $supplierId,
                'questionnaire_id' => $questionnairId
            ]
        )->first();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.questionnair-answer');
    }
}

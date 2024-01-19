<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CcgFeed;
use App\Models\Company;
use App\Traits\CommonTrait;
use App\Models\CompanyCollaboratorsGroup;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\Questionnair;
use App\Models\Questionnaire;
use App\Models\QuestionnaireResponse;
use App\View\Components\Admin\QuestionnairAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CcgFeedController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Admin.news-feed.index');
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
        $user = Auth::user();
        $input = $request->all();
        if (!$input['description'] && !$request->file('video') && !$request->file('files')) {
            return response(['status' => FAIL, 'message' => 'Please add something']);
        }
    
        $allImages = [];
        if ($request->file('files') && count($request->file('files')) > 0) {
        foreach ($request->file('files') as $key => $value) {
            $path = $this->file_upload($value, FEED_IMG_FILE);
            if ($path) {
                $allImages[] = $path;
            }
        }
        }
        if ($request->file('video')) {
            $path = $this->file_upload($request->file('video'), FEED_VIDEO_FILE);
            if ($path) {
                $video = $path;
            }
        }
        
        $post_data = new CcgFeed();
        $post_data->company_id = $user->company_id ?? null;
        $post_data->user_id = $user->id;
        $post_data->company_collaborator_group_id = $input['ccg_id'] ?? null;
        $post_data->description = $input['description'] ?? '';
        $post_data->primary_image = count($allImages) > 0 ? $allImages[0] : '';
        $post_data->images = count($allImages) > 0 ? json_encode($allImages, JSON_FORCE_OBJECT) : '{}';
        $post_data->video = $video ?? '';
        if ($post_data->save()) {
            if ($request->has('questionnaire')) {
                $this->addQuestionnaire($request, $post_data->id);
            }
            $ccg_feed = CcgFeed::find($post_data->id);
            if (!$ccg_feed->company_collaborator_group_id) {
                $html = view('components.admin.single-feed', compact('ccg_feed'))->render();
            } else {
                $html = view('components.admin.single-group-feed', compact('ccg_feed'))->render();
            }

            return response(
                [
                    'status' => SUCCESS,
                    'message' => 'Feed added successfully',
                    'data' => $html
                ],
                200
            );
        } else {
            return response(['status' => FAIL, 'message' => 'Some error occured in adding feeds']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CcgFeed  $ccgFeed
     * @return \Illuminate\Http\Response
     */
    public function show(CcgFeed $ccgFeed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CcgFeed  $ccgFeed
     * @return \Illuminate\Http\Response
     */
    public function edit(CcgFeed $ccgFeed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CcgFeed  $ccgFeed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CcgFeed $ccgFeed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CcgFeed  $ccgFeed
     * @return \Illuminate\Http\Response
     */
    public function destroy(CcgFeed $ccgFeed)
    {
        //
        // if ($ccgFeed->delete()) {
        //     return response()->json(['status' => SUCCESS, 'message' => 'Suucessfully deleted'], 200);
        // }
        
        if ($ccgFeed->delete()) {
            return response()->json(['status' => SUCCESS, 'message' => 'Suucessfully deleted'], 200);
        }

        return response()->json(['status' => SUCCESS, 'message' => 'Failed'], 200);
    }

    public function groupFeeds() {
        $ccgIds = count(Company::find(Auth::user()->company_id)->feedGroups())
            ? Company::find(Auth::user()->company_id)->feedGroups()->pluck('id')->toArray()
            : null;
        if (is_null($ccgIds)) {
            return response(['status' => FAIL, 'message' => 'Could not find'], 404);
        }
        $ccg_feeds = CcgFeed::whereIn('company_collaborator_group_id', $ccgIds)
            ->latest('id')
            ->get();
        $html = view('components.admin.group-feed', compact('ccg_feeds'))->render();
        return response(
            [
              'status' => SUCCESS,
              'message' => 'Feeds retrieved successfully',
              'data' => $html
            ],
            200
        );
    }
    
    public function addQuestionnaire($request, $id) {
        $questionair = new Questionnaire();
        $questionair->title = $request->form_name;
        $questionair->typeable()->associate(CcgFeed::find($id));
        $questionair->description = $request->questionair_description;
        $questionair->user_id = auth()->id();
        $questionair->save();
        $qId = $questionair->id;
        foreach ($request->questiona as $key=>$q) {
            $questionData = [
                'question' => $q,
                'response_type' => $request->answer_type[$key],
                'response_values' => isset($request->option_name[$key]) ? $request->option_name[$key] : null,
                'questionnaire_id' => $qId 
            ];
            Question::create($questionData);     
        }
    }

    public function fetchQuestionnaires($id)
    {
        $ccgFeed = CompanyCollaboratorsGroup::whereCompanyId(auth()->user()->company_id)->whereId($id)->first();
        if (!$ccgFeed) {
            abort(401, "You are not allowed to view this resource");
        } 
        $questionnaires = $ccgFeed->questionnaires;

        return view('Admin.company-group.group-questionnaire', compact('questionnaires'));
    }

    public function getQuestionnaire(Questionnaire $questionnaire)
    {
        $user = auth()->user();
        $html = view('Admin.company-group.questionnaire.answer-modal', compact('questionnaire'))->render();
        if ($user->company_id == $questionnaire->typeable->company_id) {
            $html = view('Admin.company-group.questionnaire.view-modal', compact('questionnaire'))->render();
        } else if ($user->company_id != $questionnaire->typeable->company_id && $questionnaire->isSubmittedBy($user->company_id)) {
            $obj = new QuestionnairAnswer($questionnaire->id, $user->company_id);
            $html = view('components.admin.questionnair-answer', ['questionnaireResponse' => $obj->questionnaireResponse])->render();
        }

        return response()->json(['status' => SUCCESS, 'data' => $html], 200);
    }

    public function submitQuestionnaireResponse(Request $request, Questionnaire $questionnaire)
    {
        $user = auth()->user();
        if ($questionnaire->isSubmittedBy($user->company_id)) {
            return response()->json(['status' => SUCCESS, 'message' => "Response Already Submitted."], 200);
        }
        $questions = $questionnaire->questions;
        $questionnaireResponse = QuestionnaireResponse::create([
            'questionnaire_id' => $questionnaire->id,
            'user_id' => $user->id,
            'company_id' => $user->company_id
        ]);
        foreach ($questions as $question) {
            // dd($request->response[8]);
            if (array_key_exists($question->id, $request->response) && $request->response[$question->id] !== null) {
                $data = [
                    'questionnaire_response_id' => $questionnaireResponse->id,
                    'question_id' => $question->id,
                    'response_type' => $question->response_type
                ];
                if ($question->response_type != 'file') {
                    $data['response'] = $request->response[$question->id];
                } else {
                    // dd($request->response[$question->id]);
                    $path = $this->file_upload($request->response[$question->id], FEED_IMG_FILE);
                    $data['response'] = $path;
                }
                QuestionAnswer::create($data);
            }

        }
        
        return response()->json(['status' => SUCCESS, 'message' => "Response successfully created."], 200);
    }
}

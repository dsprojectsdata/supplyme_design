<?php

namespace App\Http\Controllers;

use App\Events\DeleteConversation;
use App\Events\LoadOldMessage;
use App\Models\Conversation;
use App\Events\NewMessage;
use App\Models\Group;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;
use App\Models\ChatNode;
use App\Models\User;
use App\Traits\RfqTrait;

class ConversationController extends Controller
{
    use CommonTrait, RfqTrait;
    
    public function getChat($supplierId)
    {
        $initiaterId = auth()->user()->company_id;
        $dataValue = array($initiaterId, $supplierId);
        sort($dataValue);
        $identifier = "general-" . $dataValue[0] . "-" .$dataValue[1];
        $group = Group::where('identifier', $identifier)->first();
        if (is_null($group)) {
            $group = RfqTrait::createOpenGroup($supplierId);
            $chatGroups[] = $group;
            $html =  view('components.admin.message-group', compact('chatGroups'), ['toOthers' => false])->render();

            return response()->json(['status' => SUCCESS, 'message' => 'Chat Initiated', 'data' => $html], 200);
        } else {

            return response()->json(['status' => SUCCESS, 'message' => 'Chat alreasy exist', 'data' => $group], 422);
        }  
    }

    public function store(Request $request)
    {
        $allImages = $attachments = [];
        
        // print_r($request->file('attachments')); die;

        if ($request->file('files') && count($request->file('files')) > 0) {
                foreach ($request->file('files') as $key => $value) {
                    $path = $this->file_upload($value, CHAT_IMG_FILE);
                    // dd($path);
                    if ($path) {
                        $allImages[] = $this->file_upload($value, CHAT_IMG_FILE);
                    }
                }
            }
            if ($request->file('attachments')) {
                foreach ($request->file('attachments') as $key => $value ) {
                    $path = $this->file_upload($value, CHAT_ATTACH);
                    if ($path) {
                        $attachments[] = [
                            'path' => $path,
                            'original_filename' => $value->getClientOriginalName(),
                            'file_size' => $value->getSize(),
                            'display_size' => formatSizeUnits($value->getSize())
                        ];
                    }
                }
            }
        $conversation = Conversation::create([
            'message' => request('message'),
            'group_id' => request('group_id'),
            'images' => count($allImages) > 0 ? json_encode($allImages, JSON_FORCE_OBJECT) : null,
            'attachments' => count($attachments) > 0 ? json_encode($attachments, JSON_FORCE_OBJECT) : null,
            'user_id' => auth()->user()->id,
        ]);
        $conversations[] = $conversation;
        $message = view(
                    'components.chat.message-line',
                    [
                        'conversations' => $conversations,
                        'delete' => false,
                        'toOthers' => true   
                    ]
                )->render();
        $doc = view('components.admin.group-doc', compact('conversations'))->render();
        $toSelf = view(
                'components.chat.message-line',
                [
                    'conversations' => $conversations,
                    'delete' => false,
                    'toOthers' => false  
                ]
            )->render();
        $data = [
            'chat' => $toSelf,
            'doc' => $doc,
            'conversation_id' => $conversation->id,
            'delete_uri' => route('conversation.delete', $conversation->id)
        ];
        broadcast(new NewMessage($conversation, $message, $doc))->toOthers();

        return response()->json(['status' => SUCCESS, 'message' => 'Success', 'data' => $data], 200);
    }

    public function loadChat(Group $group, $offset = null)
    {
        if ($offset) {
            $conversations = $group->conversations()->where('id', '<', $offset)->latest('id')->take(15)->get()->reverse();
        } else {
            $conversations = $group->conversations()->latest('id')->take(15)->get()->reverse();
        }
        $chat = view(
            'components.chat.message-line',
            [
                'conversations' => $conversations,
                'delete' => true,
                'toOthers' => false
            ]
        )->render();

        $doc = view(
            'components.admin.group-doc',
            [
                'conversations' => $conversations
            ]
        )->render();

        $chat_info = view('components.chat.chat-info', compact('group'))->render();
        $data = [
            'chat' => $chat,
            'doc' => $doc,
            'info' => $chat_info
        ];

        return response()->json(['status' => SUCCESS, 'message' =>'chat retrieved successfully', 'data' => $data], 200);
    }
    
    public function destroy(Conversation $conversation) {
        if ($conversation->user_id == auth()->id()) {
            $id = $conversation->id;
            if($conversation->delete()) {
                broadcast(new DeleteConversation($id));

                return response()->json(['status' => SUCCESS, 'message' =>'Deleted conversation'], 200);
            }

            return response()->json(['status' => FAIL, 'message' => 'Failed to delete conversation'], 200);
        }

        return response()->json(['status' => FAIL, 'message' => 'Unauthorized'], 200);
    }
    
    public function getMessage(Conversation $conversation)
    {
        $conversations[] = $conversation; 
        $message = view(
            'components.chat.message-line',
            [
                'conversations' => $conversations,
                'delete' => true,
                'toOthers' => false 
            ]
        )->render();
        $doc = view('components.admin.group-doc', compact('conversations'))->render();
        $data = [
            'chat' => $message,
            'doc' => $doc,
            'conversation_id' => $conversation->id,
        ];
        if ($conversation->user_id == auth()->id()) {
            $data['delete_uri'] = route('conversation.delete', $conversation->id);
        }

        return response()->json(['status' => SUCCESS, 'message' => 'Success', 'data' => $data], 200);
    }
}

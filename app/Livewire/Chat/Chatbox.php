<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use Livewire\Component;

class Chatbox extends Component
{

    protected $listeners=['load_conversationDoctor','load_conversationPatient','pushMessage'];
    public $receiver;
    public $selected_conversation;
    public $receviverUser;
    public $messages;
    public $auth_email;

    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }


    public function load_conversationDoctor(Conversation $conversation, Doctor $receiver ){

        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id',$this->selected_conversation->id)->get();
    }

    public function load_conversationPatient(Conversation $conversation, Patient $receiver ){
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;
        $this->messages = Message::where('conversation_id',$this->selected_conversation->id)->get();
    }
    public function pushMessage($messageId){
        $newMessage = Message::find($messageId);
        $this->messages->push($newMessage);

    }


    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}
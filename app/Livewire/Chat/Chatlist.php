<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Doctor;
use App\Models\Patient;

class Chatlist extends Component
{
    public $conversations;
    public $auth_email;
    public $receiverUser;
    public $selected_conversation;



    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }
 
    public function getUser(Conversation $conversation ,$request){


        if($conversation->sender_email == $this->auth_email){
            $this->receiverUser =Doctor::firstwhere('email',$conversation->receiver_email);
        }

        else{
            $this->receiverUser = Patient::firstwhere('email',$conversation->sender_email);
        }

        if(isset($request)){
            return $this->receiverUser->$request;
        }

     }

     public function chatUserSelected(Conversation $conversation ,$receiver_id)
     {
         $this->selected_conversation = $conversation;
         $this->receiverUser = Doctor::find($receiver_id);
         $this->emitTo('chat.chatbox','load_conversationDoctor', $this->selected_conversation, $this->receiverUser);

     }


    public function render()
    {
        $this->conversations = Conversation::where('sender_email', $this->auth_email)->orwhere('receiver_email', $this->auth_email)->orderBy('created_at','DESC')->get();
        return view('livewire.chat.chatlist');
    }
}

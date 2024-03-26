<?php

namespace App\Livewire\Chat;
use App\Models\Conversation;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\Validate; 


class SendMessage extends Component
{
    public $selected_conversation;
    public $receviverUser;
    public $auth_email;
     #[Validate('required')] 
    public $body = '';
    protected $listeners=['updateMessage'];


    public function mount()
    {
        $this->auth_email = auth()->user()->email;
    }
    public function updateMessage(Conversation $conversation, Patient $receiver ){
        $this->selected_conversation = $conversation;
        $this->receviverUser = $receiver;


    }
  
    public function sendMessage(){
        if($this->body == null){
            return null;

        }
       $createMessage = Message::create([
           'conversation_id' =>$this->selected_conversation->id,
           'sender_email' => $this->auth_email,
           'receiver_email' => $this->receviverUser->email,
           'body' => $this->body,
        ]);
        $this->selected_conversation->last_time_message = $createMessage->created_at;
        $this->selected_conversation->save();
        $this->reset('body');
        $this->dispatch('pushMessage',$createMessage->id)->to('chat.chatbox');
        $this->dispatch('refresh')->to('chat.chatlist');
        $this->dispatch('dispatchSentMessage')->self();

    }

    public function dispatchSentMessage(){

    }
    public function render()
    {
        return view('livewire.chat.send-message');
    }
}

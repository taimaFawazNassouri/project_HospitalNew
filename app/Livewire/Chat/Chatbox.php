<?php

namespace App\Livewire\Chat;
use App\Models\Conversation;
use App\Models\Doctor;

use Livewire\Component;

class Chatbox extends Component
{
    protected $listeners = ['load_conversationDoctor'];
    public $reciver;

    public function load_conversationDoctor(Conversation $conversation, Doctor $reciver){
        dd($reciver);

    }
    public function render()
    {
        return view('livewire.chat.chatbox');
    }
}

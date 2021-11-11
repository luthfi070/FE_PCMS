<?php

namespace App\Http\Livewire;

use App\Message;
use Livewire\Component;

class Chat extends Component
{
    public $projectId;
    public $userId;
    public $messageText;
    public function render()
    {
        $messages = Message::where('project_id', session('ProjectID'))->latest()->take(10)->get()->sortBy('id');
        return view('livewire.chat', compact('messages'));
    }

    public function sendMessage(){
        Message::create([
            'project_id' => $this->projectId,
            'user_id' => $this->userId,
            'message_text' => $this->messageText,
        ]);
        $this->reset('messageText');
    }
}

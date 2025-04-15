<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TravelChatbot extends Component
{ 
    public $message;
    public $conversation = [];

     public function sendMessage(){
        $this->validate(['message' => 'required|string|max: 255']);

        $this->conversation[] = ['user' => 'You', 'text' => $this>message];

        $response = Http::post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4',
            'messages' => [['role' => 'user', 'content' => $this->message]],
        ])->json();

        $reply = $response['choices'][0]['message']['content'] ?? 'Sorry, I could not process that';

        $this->conversation[] = ['user' => 'AI', 'text' => $reply];
        $this->message = '';
     }
    public function render()
    {
        return view('livewire.travel-chatbot');
    }
}

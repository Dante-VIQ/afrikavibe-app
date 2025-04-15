<?php

namespace App\Livewire;

use Livewire\Component;
use Algoria\AlogoriaSearch\SearchClient;

class Search extends Component
{
    public $query;
    public $results = [];

    public function search(){
        $client = SearchClient::create(env('ALGORIA_APP_ID'), env('ALGORIA_API_KEY'));
        $index = $client->initIndex('afrikavibe');
        $response = $index->search($this->query);
        $this->results = $response['hits'];
    }
    public function render()
    {
        return view('livewire.search');
    }
}
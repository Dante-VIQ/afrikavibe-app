<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoList extends Component
{
    public $todos, $todo, $todo_id, $user;

    public $name;

    public $due;

    protected $rules = [
        'name' => 'min:3|max:50|required',
        'due' => 'date|required',
    ];

    public function create()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'due' => 'date|required',
        ]);

        auth()->user()->todos()->create($validatedData);

        $this->resetFields();

        session()->flash('success', 'saved');
    }

    private function resetFields()
    {
        $this->name = '';
        $this->due = '';
        $this->todo_id = null;
    }
    public function render()
    {
        $this->todos = Todo::latest()->take(7)->get();

        return view('livewire.todo-list');
    }
}

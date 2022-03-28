<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $users = User::Where("name", "LIKE", "%$this->search%")
                    ->orWhere("id", "LIKE", "%$this->search%")
                    ->orWhere("email", "LIKE", "%$this->search%")
                    ->orderBy('id', 'DESC')
                    ->paginate($this->perPage);

        return view('livewire.users', [
            "users" => $users,
        ]);
    }
}

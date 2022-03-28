<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class Payments extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $payments = Payment::Where("id", "LIKE", "%$this->search%")
                    ->orWhere("stripe_id", "LIKE", "%$this->search%")
                    ->orWhere("user_name", "LIKE", "%$this->search%")
                    ->orWhere("amount", "LIKE", "%$this->search%")
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->perPage);

        return view('livewire.payments', [
            "payments" => $payments,
        ]);
    }
}

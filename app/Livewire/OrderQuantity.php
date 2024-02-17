<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class OrderQuantity extends Component
{
    public $order = 'Desc';

    public function handleOrder() {
        if ($this->order === 'Desc') {
            $this->order = 'Asc';
        } else {
            $this->order = 'Desc';
        }
        Log::info($this->order);
    }
    public function render()
    {
        return view('livewire.order-quantity');
    }
}

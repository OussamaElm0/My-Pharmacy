<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class OrderQuantity extends Component
{
    public $order = 'Desc';
    public function render()
    {
        return view('livewire.order-quantity');
    }
}

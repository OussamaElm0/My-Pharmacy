<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Url;
use Livewire\Component;

class OrderQuantity extends Component
{
    #[Url(as: 'orderBy')]
    public $order ;

    public function handleOrder() {
        switch ($this->order) {
            case '':
                $this->order = 'Desc';
                break;
            case 'Desc':
                $this->order = 'Asc';
                break;
            case 'Asc':
                $this->order = '';
                break;
        }
        return redirect()->route('products.index', ['orderBy' => $this->order]);
    }
    public function render()
    {
        return view('livewire.order-quantity');
    }
}

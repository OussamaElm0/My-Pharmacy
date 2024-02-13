<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\ProductController;

class ProductQuantity extends Component
{
    public $quantity;
    public $id;

    public function mount($currentQuantity, $id)
    {
        $this->quantity = $currentQuantity;
        $this->id = $id;
    }
    public function updateInDb($newQuantity)
    {
        ProductController::updateQuantity($this->id, $this->quantity);
    }
    public function increment()
    {
        $this->updateInDb($this->quantity++);
    }
    public function decrement()
    {
        $this->updateInDb($this->quantity--);
    }
    public function render()
    {
        return view('livewire.product-quantity');
    }
}

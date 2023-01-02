<?php

namespace App\Http\Livewire\Detail;

use Livewire\Component;

class Roomdetail extends Component
{
    public $kamar_id;
    public function mount(){
        $this->kamar_id = $this->kamar_id;
    }
    public function render()
    {
        return view('livewire.detail.roomdetail');
    }
}

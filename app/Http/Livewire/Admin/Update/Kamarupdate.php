<?php

namespace App\Http\Livewire\Admin\Update;

use Livewire\Component;

class Kamarupdate extends Component
{
    public $kamar_id;

    public function mount(){
        $this->kamar_id = $this->kamar_id;
    }
    public function render()
    {
        return view('livewire.admin.update.kamarupdate');
    }
}

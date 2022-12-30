<?php

namespace App\Http\Livewire\Admin\Update;

use Livewire\Component;

class Galeriupdate extends Component
{
    public $picture_id;

    public function mount(){
        $this->picture_id = $this->picture_id;
    }
    public function render()
    {
        return view('livewire.admin.update.galeriupdate');
    }
}

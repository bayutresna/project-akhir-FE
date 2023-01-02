<?php

namespace App\Http\Livewire\Admin\Update;

use Livewire\Component;

class Fasilitaskamarupdate extends Component
{
    public $fasilitas_id;
    public function mount(){
        $this->fasilitas_id = $this->fasilitas_id;
    }
    public function render()
    {
        return view('livewire.admin.update.fasilitaskamarupdate');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TarifComp extends Component
{
    public function render()
    {
        return view('livewire.Tarifs.index')
            ->extends("layouts.master")
            ->section("contenu");
    }
}
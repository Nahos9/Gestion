<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Utilisateur extends Component
{
    use WithPagination;

    
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.utilisateurs.index',[
            "users"=>User::paginate(3)
        ])
                ->extends('layouts.master')
                ->section('contenu');
    }
}
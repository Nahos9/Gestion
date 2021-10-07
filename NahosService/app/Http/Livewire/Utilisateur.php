<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Utilisateur extends Component
{
    use WithPagination;

    public $btnAddClick = false;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.utilisateurs.index',[
            "users"=>User::paginate(3)
        ])
                ->extends('layouts.master')
                ->section('contenu');
    }

    public function goToAddUser()
    {
        return $this->btnAddClick = true;
    }

    public function goToUser()
    {
        return $this->btnAddClick = false;
    }
}

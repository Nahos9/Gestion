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

    public $userAdd = [];

    protected $rules = [
        "userAdd.nom"=>"required",
        "userAdd.prenom"=>"required",
        "userAdd.sexe"=>"required",
        "userAdd.telephone1"=>"required|number",
        "userAdd.pieceIdentite"=>"required",
        "userAdd.noPieceIdentite"=>"required",
    ];

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

    public function addUser()
    {   
        $this->validate();
        dump($this->userAdd);
    }
}

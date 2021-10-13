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

    // // public $userAdd = [];
    public $newUser = [];

    protected $rules = [
        'newUser.nom' => 'required',
        'newUser.prenom' => 'required',
        'newUser.sexe' => 'required',
        'newUser.email' => 'required|unique:users,email',
        'newUser.telephone1'=>'required|numeric|unique:users,telephone1',
        'newUser.pieceIdentite'=>'required',
        'newUser.noPieceIdentite'=>'required|unique:users,noPieceIdentite'
    ];

    public function render()
    {
        return view('livewire.utilisateurs.index',[
            "users"=>User::latest()->paginate(3)
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
    $validateAttribute = $this->validate();

    $validateAttribute["newUser"]["password"] = "password";

    User::create($validateAttribute["newUser"]);
        $this->newUser = [];
    $this->dispatchBrowserEvent("userCreatedSucces",["message"=>"Utilisateur crée avec succès!!"]);

    return redirect()->route('admin.habillitation.user.index');
   
    }

    // Supprission d'un utilisateur 
    public function confirmDelete($name,$id)
    {
        $this->dispatchBrowserEvent("confirmDelete",["message"=>[
            "title"=>"Continuer cette action?",
            "text"=>"Vous levez-vous supprimer $name de la liste des utilisateurs?",
            "type"=>"warning",
            "data"=>[
                "user_id" => $id
            ]
        ]]);
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        $this->dispatchBrowserEvent("userDeletedSucces",["message"=>"Utilisateur supprimer avec succès!!"]);
    }
}

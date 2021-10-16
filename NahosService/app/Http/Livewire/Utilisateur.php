<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class Utilisateur extends Component
{
    use WithPagination;

    public $btnAddClick = false;
    protected $paginationTheme = 'bootstrap';

    public $currentPage = PAGELISTE;

    // // public $userAdd = [];
    public $newUser = [];

    public $editUser = [];


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
        return $this->currentPage = PAGEUSERFORM;
    }

    public function goToUser()
    {
        return $this->currentPage = PAGELISTE;
    }

    public function addUser()
    {  
    $validateAttribute = $this->validate();

    $validateAttribute["newUser"]["password"] = "password";

    User::create($validateAttribute["newUser"]);

        $this->newUser = [];

    $this->dispatchBrowserEvent("showSuccesMessage",["message"=>"Utilisateur crée avec succès!!"]);

    // return redirect()->route('admin.habillitation.user.index');
   
    }

    // Supprission d'un utilisateur 
    public function confirmDelete($name,$id)
    {
        $this->dispatchBrowserEvent("showConfirmMessage",["message"=>[
            "title"=>"Continuer cette action?",
            "text"=>"Vous levez-vous supprimer $name de la liste des utilisateurs?",
            "type"=>"warning",
            "data"=>[
                "user_id" => $id
            ]
        ]]);
    }

    // fonction de suppression de l'utilisateur
    public function deleteUser($id)
    {
        User::destroy($id);
        $this->dispatchBrowserEvent("showSuccesMessage",["message"=>"Utilisateur supprimer avec succès!!"]);
    }

    //formulaire d'édition de l'utilisateur

    public function goToEdit($id)
    {
        $this->editUser = User::find($id)->toArray();
        return $this->currentPage = PAGEEDITFORM;
        $this->editUser = [];
    }

    //fonction roles de validation
    public function rules()
    {
        // 'required|unique:users,email'
        if($this->currentPage == PAGEEDITFORM)
        {
            return [
                'editUser.nom' => 'required',
                'editUser.prenom' => 'required',
                'editUser.sexe' => 'required',
                'editUser.email' => ['required','email', Rule::unique("users","email")->ignore($this->editUser["id"])],
                'editUser.telephone1'=>['required','numeric', Rule::unique("users","telephone1")->ignore($this->editUser["id"])],
                'editUser.pieceIdentite'=>'required',
                'editUser.noPieceIdentite'=>['required', Rule::unique("users","noPieceIdentite")->ignore($this->editUser["id"])]
            ];
        }

        return [
            'newUser.nom' => 'required',
            'newUser.prenom' => 'required',
            'newUser.sexe' => 'required',
            'newUser.email' => ['required'],
            'newUser.telephone1'=>'required|numeric|unique:users,telephone1',
            'newUser.pieceIdentite'=>'required',
            'newUser.noPieceIdentite'=>'required|unique:users,noPieceIdentite'
        ];
    }
    //fonction de l'édition du formulaire

    public function updateUser()
    {
       $validateAttribute =  $this->validate();
        User::find($this->editUser["id"])->update($validateAttribute["editUser"]);
    //    $this->editUser = [];

       $this->dispatchBrowserEvent("showSuccesMessage",["message"=>"Utilisateur modifié avec succès!!"]);
        
    }

    // Rénitilaiser le password

    public function confirmPwdReset()
    {
        $this->dispatchBrowserEvent("showConfirmMessage",["message"=>[
            "title"=>"Continuer cette action?",
            "text"=>"Vous levez-vous rénitialiser le mot de passe?",
            "type"=>"warning",
            // "data"=>[
            //     "user_id" => $id
            // ]
        ]]);
    }

    public function resetPassword()
    {
        
        User::find($this->editUser["id"])->update(["password" => Hash::make(DEFAULTPASSOWRD)]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Mot de passe utilisateur réinitialisé avec succès!"]);
    }
}

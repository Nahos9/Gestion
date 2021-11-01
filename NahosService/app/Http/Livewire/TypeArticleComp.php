<?php

namespace App\Http\Livewire;

use App\Models\ProprieteArticle;
use App\Models\TypeArticle;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

use Livewire\WithPagination;

class TypeArticleComp extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $search = "";
    public $newValueEdit = "";

    public $isAddType = false;

    public $newTypeArticleName = "";

    public $nameEdit;

    public $newPropModel = [];

    public $editPropModel = [];

    public function render()
    {
        Carbon::setLocale("fr");
       $serachCritere = "%". $this->search ."%";

        $data = [
            "typearticles"=>TypeArticle::where("nom","like",$serachCritere)->latest()->paginate(5),
            "proprietesarticles"=>ProprieteArticle::where("type_article_id",optional($this->nameEdit)->id)->get() ];
        return view('livewire.typearticles.index',$data)
                ->extends('layouts.master')
                ->section('contenu');
    }

    //afficher et retirer l'input d'ajout d'un type d'article
    public function toggleAddTypeArticle()
    {
        if($this->isAddType){
            $this->isAddType = false;
            $this->newTypeArticleName = "";
            $this->resetErrorBag();
        }else{
            $this->isAddType = true;
        }
    }

    //Ajout d'un type d'article

    public function addTypeArticle()
    {
        
        $validateAttribute = $this->validate([
            "newTypeArticleName"=>"required|max:50|unique:type_articles,nom"
        ]);

        TypeArticle::create(["nom"=>$validateAttribute['newTypeArticleName']]);

        $this->dispatchBrowserEvent("showSuccessMessage",["message"=>"Enregistrement effectué avec succès!!"]);
        $this->toggleAddTypeArticle();
    }

    // formulaire d'édition d'un type d'article
    public function editTypeArticle($id)
    {
        $typeArticle = TypeArticle::find($id);

        $this->dispatchBrowserEvent("showEditForm",["typearticle"=>$typeArticle]);
    }

    //fonction pour l'édition d'un type d'article

    public function updateTypeArticle(TypeArticle $typearticle, $newValueForJS)
    {
        $this->newValueEdit = $newValueForJS;

        $validated = $this->validate([
            "newValueEdit"=>["required","max:25",Rule::unique("type_articles","nom")->ignore($typearticle)]
        ]);

        $typearticle->update(["nom"=>$validated["newValueEdit"]]);

        $this->dispatchBrowserEvent("showSuccessMessage",["message","Modification réussis avec succès"]);
    }

    //confirmation de suppression
    public function deleteConfTypeArticle(TypeArticle $typearticle)
    {
        $this->dispatchBrowserEvent("showConfirmMessage",[
            "message"=>[
                "title"=>"Vous levez-vous continuer?",
                "text"=>"Vous êtes sur le point de supprimer $typearticle->nom de la liste",
                "type"=>"warning",
                "data"=>[
                    "type_article_id"=>$typearticle
                ]
            ]
            ]);
    }

    //fonction de suppression d'un type d'article
    public function deleteTypeArticle(TypeArticle $typearticle)
    {
       $typearticle->delete();

       $this->dispatchBrowserEvent("showSuccessMessage",["message","Suppression réussis avec succès"]);
    }

    //affichage de la fênetre modale
    public function showEditProp(TypeArticle $typearticle)
    {
        $this->nameEdit = $typearticle;
        $this->dispatchBrowserEvent("showModal",[]);
    }
    // ajoute d'une propriété d'article
    public function addProp()
    {
      
      $validateAttribute = $this->validate([
          "newPropModel.nomPropriete"=>[
              "required",
              Rule::unique("propriete_articles","nomPropriete")->where("type_article_id",$this->nameEdit->id)
          ],
          "newPropModel.estObligatoire"=>"required"
          ]);
          
          ProprieteArticle::create([
              "nomPropriete"=>$this->newPropModel["nomPropriete"],
              "estObligatoire"=>$this->newPropModel["estObligatoire"],
              "type_article_id"=>$this->nameEdit->id
          ]);

          $this->newPropModel = [];
          $this->resetErrorBag();
          $this->dispatchBrowserEvent("showSuccessMessage",["message"=>"Proprité ajoutée avec succès!!"]);
    }

    //confirmation de suppression d'une propriété
    public function showDeletePrompt($name, $id)
    {
       
        $this->dispatchBrowserEvent("showConfirmMessage",[
            "message"=>[
                "text"=>"Vous êtes sur le point de supprimer '$name' de la liste des propriétés",
                "title"=>"Suppression d'une propriété",
                "type"=>"warning",
                "data"=>[
                    "propriete_id"=>$id
                ]
            ],
            
            ]);
    }

    //supprimer une propriete

    public function deteleProprieteArticle(ProprieteArticle $propriete)
    {
        $propriete->delete();
        $this->dispatchBrowserEvent("showSuccessMessage",["message"=>"Proprité supprimée avec succès!!"]);
    }

    public function closeModal()
    {
        $this->editPropModel = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeModal", []);
    }

    //modal d'édition d'une propriété d'article
    public function showModalEditPror(ProprieteArticle $proprietearticle)
    {
        $this->editPropModel["nomPropriete"] = $proprietearticle->nomPropriete;
        $this->editPropModel["estObligatoire"] = $proprietearticle->estObligatoire;
        $this->editPropModel["id"] = $proprietearticle->id;
        $this->dispatchBrowserEvent("showEditModal",[]);
    }

    public function closeEditModal()
    {
        $this->dispatchBrowserEvent("closeEditModal", []);
    }

    public function updateProp(ProprieteArticle $proprietearticle)
    {
        $this->validate([
            "editPropModel.nomPropriete"=>[
                "required",
                Rule::unique("propriete_articles","nomPropriete")->ignore($this->editPropModel["id"])
            ],
            "editPropModel.estObligatoire"=>"required"
            ]);
        
            ProprieteArticle::find($this->editPropModel["id"])->update([
                "nomPropriete"=>$this->editPropModel["nomPropriete"],
                "estObligatoire"=>$this->editPropModel["estObligatoire"]
            ]);
            // $proprietearticle->update([
            //     "nomPropriete"=>$this->editPropModel["nomPropriete"],
            //     "estObligatoire"=>$this->editPropModel["estObligatoire"]
            // ]);

            $this->closeEditModal();
    
        
            $this->dispatchBrowserEvent("showSuccessMessage",["message"=>"Propriéte modifiée avec succès!!"]);
    }
}

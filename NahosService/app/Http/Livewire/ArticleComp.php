<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Article;
use App\Models\ArticlePropriete;
use App\Models\ProprieteArticle;
use App\Models\TypeArticle;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ArticleComp extends Component
{
    use WithPagination,WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = "";

    public $filtreEtat = "", $filtreType="";

    public $addArticle = [];

    public $proprieteArticles = [];

    public $images;
    public $imagesEdit;

    public $editArticle = [];

    protected $rules = [
        "editArticle.nom" => "required",
        "editArticle.noSerie" => "required",
        "editArticle.type_article_id" => "required",
        "editArticle.article_proprietes.*.valeur" => "required",
    ];
    
    public function render()
    {
        Carbon::setLocale("fr");
        $articleQuery = Article::query();

        if($this->search != "")
        {
            $articleQuery->where("nom","LIKE","%".$this->search."%")
                          ->orWhere("noSerie","LIKE","%".$this->search."%");
        }

        if($this->filtreType != "")
        {
            $articleQuery->where("type_article_id",$this->filtreType);
        }
        if($this->filtreEtat != "")
        {
            $articleQuery->where("estDisponible",$this->filtreEtat);
        }
        return view('livewire.articles.index',[
            "articles"=>$articleQuery->latest()->where("nom","LIKE","%".$this->search."%")
                                            ->paginate(5),
            "typearticles"=>TypeArticle::orderBy("nom","ASC")->get()
        ])
               ->extends('layouts.master')
               ->section('contenu');
    }

    public function comfirmDeleteArticle(Article $article)
    {
        $this->dispatchBrowserEvent("showConfirmMessage",[
            "message"=>[
                "title"=>"Continuer!!",
                "text"=>"Vous levez vous supprimer cet article",
                "type"=>"warning",
                "data"=>[
                    "article_id"=>$article
                ]
            ]
            ]);
    }

    public function updated($proprety)
    {
        if($proprety == "addArticle.type")
        {
            $this->proprieteArticles = TypeArticle::find($this->addArticle["type"])->proprietes;
        }
    }
    //suppression de l'article
    public function deleteArticle(Article $article)
    {
        $article->delete();

        $this->dispatchBrowserEvent("showSuccessMessage",["message"=>"Article supprimé avec success!!"]);
    }

    //formulaire d'ajout d'un article

    public function showAddForm()
    {
        $this->dispatchBrowserEvent("showModal");
    }

    public function closeModal()
    {
        $this->addArticle = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeModal", []);
       
    }

    //ajouter un article
    public function ajouterArticle()
    {

        // dump($this->addArticle);

        //reglès de validation des entrés satatiques de notre article
        $validateAttr = [
            "addArticle.nom"=>"string|min:3|required",
            "addArticle.noSerie"=>"string|max:50|min:3|required",
            "addArticle.type"=>"required",
            "images"=>"image|max:10240"
        ];

        $customErrMessage = [];
        $proIds = [];
        // reglès des validations des entrées dynamiques de notre article (le propritées du au type d'article choisi)
        foreach($this->proprieteArticles as $propriete){

            $Namefield = "addArticle.prop.".$propriete->nomPropriete;
            $proIds[$propriete->nomPropriete] = $propriete->id;

            if($propriete->estObligatoire == 1){
                $validateAttr[$Namefield] = "required";
                $customErrMessage["$Namefield.required"] = "Le champ  <<". $propriete->nomPropriete .">> est obligatoire";
            }else{
                $validateAttr[$Namefield] = "nullable";
            }
        }
        
        
       $data =  $this->validate($validateAttr,$customErrMessage);
       
            if($this->images != ""){

             $imagePath = $this->images->store('upload', 'public');

            }
        $article =  Article::create([
            "nom" => $data["addArticle"]["nom"],
            "noSerie" => $data["addArticle"]["noSerie"],
            "type_article_id" => $data["addArticle"]["type"],
            "imageUrl"=>$imagePath
        ]);

        foreach($data["addArticle"]["prop"]?: [] as $key=>$propriete){
            ArticlePropriete::create([
                "article_id"=>$article->id,
                "propriete_article_id"=>$proIds[$key],
                "valeur"=>$propriete
            ]);
        }
        $this->closeModal();
        $this->dispatchBrowserEvent("showSuccessMessage",["message"=>"Article ajouté avec succès!!"]);
    }

    //modification d'un article

 public function editArticle($articleId)
 {
    $this->editArticle = Article::with("type","article_proprietes.propriete")->find($articleId)->toArray();
    // dd($this->editArticle);
    $this->dispatchBrowserEvent("showEditModal",[]);
 }

 public function closeEditModal()
 {
     $this->dispatchBrowserEvent("closeEditModal");
 }
}
